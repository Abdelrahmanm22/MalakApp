<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;
    protected $primaryKey = 'rule_id';
    protected $table = "rules";
    protected $fillable = [
        'rule_id',
        'question',
        'questionDetails',
        'answer',
        'user_id',
    ];
}
