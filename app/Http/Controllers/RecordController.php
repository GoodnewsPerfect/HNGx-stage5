<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Media;
use App\Models\Record;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class RecordController extends Controller
{
    public function uploadRecord(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'record' => 'required|file|mimetypes:video/*|max:20480',
                'thumbnail' => 'file|mimetypes:image/*|max:20480'
            ]);

            if ($validate->fails()) {
                return response()->json(['message' => $validate->errors()->all()], 400);
            }
            DB::beginTransaction();

            if ($request->hasFile('record')) {
                $data = Media::store($request);
                $path = Storage::disk('public')->path("records/".$data['filename']);

                $apiURL = 'https://transcribe.whisperapi.com';
                $headers = [
                    'Authorization' => 'Bearer ' . "UC8HUM43DUH1F3ED75JDK2FSMYTDZUI8"
                ];

                $video = fopen($path, 'r');
                $response = Http::withHeaders($headers)->attach('file', $video)->post($apiURL, [
                    'diarization' => 'false',
                    'fileType' => 'mp4',
                    'task' => 'transcribe',
                ]);
                if ($response->failed()) {
                    throw new \Exception('Transcription request failed.');

                }

                $d = $response->json();
                if ($response->successful()) {
                    $transcription = $d['text']; 
                    $thumbnail = Media::storeThumbnail($request);
                    $thumbnail_url = $thumbnail != null ? 'hngx-stage-five.onrender.com' . '/storage/thumbnails/' . $thumbnail : null;
    
                    $record = Record::create([
                        'name' => $data['filename'],
                        'url' => 'hngx-stage-five.onrender.com' . '/storage/records/' . $data['filename'],
                        'size' => $data['size'],
                        'extension' => $data['extension'],
                        'duration' => $data['duration'],
                        'thumbnail' => $thumbnail_url,
                        'transcribe_text' => $transcription
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Transcription failed.',
                        'data' => $record
                    ], 500);
                }

                DB::commit();

                return response()->json([
                    'message' => 'Record uploaded successfully.',
                    'data' => $record
                ], 201);
            } else {
                throw new \Exception('No video file provided.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 500); 
        }
    }

    public function getRecord($name)
    {
        try {
          
            $record = Record::where('name', $name)->first();
            if (!$record) {
                return response()->json(['message' => 'record not found.'], 404);
            }

            return response()->json([
                'message' => "record retrieved successfully.",
                'data' =>  $record 
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(),], 503);
        }
    }


    public function getAllRecord()
    {
        try {
            $records = Record::all();
            return response()->json([
                'message' => "records retrieved successfully.",
                'data' => $records
            ], 200);

        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(),], 503);
        }
    }

    public function deleteRecord(Request $request)
    {
        try {
            $record = Record::where('name', $request->name)->first();
            if (!$record) {
                return response()->json(['message' => 'no content.'], 204);
            }
            DB::beginTransaction();
           $deteled = $record->delete();
           if ($deteled) {
               Media::deleteRecord($request);
           }
            DB::commit();
            return response()->json([
                'message' => "record delete successfully.",
            ], 202);
          
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(),], 503);
        }
    }

}
