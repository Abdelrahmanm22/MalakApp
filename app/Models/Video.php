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
        'position',
        'section_id',
        'user_id',
    ];
    protected static function boot()
    {
        parent::boot();
        Video::creating(function($model){
            $model->position = Video::max('position')+1;
        });
    }
}
