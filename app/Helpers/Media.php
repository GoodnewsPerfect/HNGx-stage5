<?php

namespace App\Helpers;

use getID3;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use Illuminate\Support\Facades\Storage;

class Media
{

    public static function store($request)
    {
        $file = $request->file('record');
        $extension = $file->getClientOriginalExtension();
        $filename = 'record_' . random_int(000000, 999999) . '_' . $file->getClientOriginalName();
        $file->storeAs('public/records', $filename);
        $fileSize = $file->getSize();

        $data['filename'] = $filename;
        $data['size'] = self::formatSizeUnits($fileSize);
        $data['duration'] = self::formatVideoDuration($file);
        $data['extension'] = $extension;

        return $data;
    }


    public static function storeThumbnail($request)
    {
        $thumbnail = null;
        $file = $request->file('thumbnail');
        if (!empty($file)) {
            $extension = $file->getClientOriginalExtension();
            $filename = 'thumbnail_' . random_int(000000, 999999) . '_' . $file->getClientOriginalName();
            $file->storeAs('public/thumbnails', $filename);
            $thumbnail = $filename;
        }
        return $thumbnail;
    }

    public static function deleteRecord($record)
    {

        $path = Storage::disk('public')->path("records/{$record->name}");
        if (file_exists($path)) {
            Storage::disk('public')->delete("records/{$record->name}");
            self::deleteThumbnail($record);
        }
    }

    public static function deleteThumbnail($record)
    {
        $path = Storage::disk('public')->path("thumbnails/{$record->name}");
        if (file_exists($path)) {
            return  Storage::disk('public')->delete("thumbnails/{$record->name}");
        }
    }

    protected static function formatVideoDuration($video_path)
    {
        $getID3 = new getID3;
        $file = $getID3->analyze($video_path);
        $duration = date('H:i:s.v', $file['playtime_seconds']);
        return $duration;
    }
    protected static function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    // Add more helper methods as needed
}
