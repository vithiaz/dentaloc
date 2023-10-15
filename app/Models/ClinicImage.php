<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicImage extends Model
{
    use HasFactory;

    protected $table = 'clinic_images';
    protected $fillable = [
        'image',
        'clinic_id',
    ];
}
