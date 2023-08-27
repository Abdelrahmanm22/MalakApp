<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatawasection extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = "fatawasections";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'user_id',
    ];
}
