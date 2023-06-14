<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $primaryKey = 'section_id';
    protected $table = "sections";
    protected $fillable = [
        'section_id',
        'title',
        'count',
        'book_id',
        'user_id',
    ];
}
