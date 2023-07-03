<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voice extends Model
{
    use HasFactory;
    protected $primaryKey = 'voice_id';
    protected $table = "voices";
    protected $fillable = [
        'voice_id',
        'audio',
        'title',
        'count',
        'position',
        'section_id',
        'user_id',
    ];
    protected static function boot()
    {
        parent::boot();
        Voice::creating(function($model){
            $model->position = Voice::max('position')+1;
        });
    }
}
