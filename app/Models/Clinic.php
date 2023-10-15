<?php

namespace App\Models;

use App\Models\ClinicImage;
use App\Models\ClinicDoctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clinic extends Model
{
    use HasFactory;

    protected $table = 'clinics';
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'long',
        'lat',
        'open_time',
        'closed_time',
        'description',
    ];


    public function images()
    {
        return $this->hasMany(ClinicImage::class, 'clinic_id', 'id');
    }

    public function clinic_doctors()
    {
        return $this->hasMany(ClinicDoctor::class, 'clinic_id', 'id');
    }




}
