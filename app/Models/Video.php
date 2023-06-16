<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $primaryKey = 'video_id';
    protected $table = "videos";
    protected $fillable = [
        'video_id',
        'title',
        'iframe',
        'description',
        'section_id',
        'user_id',
    ];
}
