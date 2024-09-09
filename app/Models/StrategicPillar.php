<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrategicPillar extends Model
{
    use HasFactory;

    protected $table = 'strategic_pillar';

    protected $fillable = [
        'Title',
    ];
    
}
