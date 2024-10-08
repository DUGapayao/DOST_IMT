<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sdg extends Model
{
    use HasFactory;

    protected $table = 'sdg'; // Define your table name if it's not pluralized by Laravel

    protected $fillable = [
        'Title',
        'Description',
    ];
}
