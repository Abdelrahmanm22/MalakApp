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
        'section_id',
        'user_id',
    ];
}
