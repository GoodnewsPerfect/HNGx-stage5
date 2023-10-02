<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $table = "records";

    protected $fillable = [
        'name',
        'url',
        'thumbnail',
        'size',
        'duration',
        'extension',
        'transcribe_text'
    ];
}
