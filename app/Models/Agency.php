<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    // Define the table if it's not the plural of the model name
    protected $table = 'agency';

    // Define the fields that are mass assignable
    protected $fillable = [
        'Agencies',
        'Acronym',
        'Agency_Group',
        'Contact',
        'Website',
    ];
}
