<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hnrda extends Model
{
    use HasFactory;

    protected $table = 'hnrda';

    protected $fillable = [
        'title'
    ];
}
