<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordCode extends Model
{
    use HasFactory;
    protected $table = 'wordcode'; 
    protected $fillable = ['word', 'hint', 'second_hint'];
}
