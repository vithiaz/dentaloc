<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $primaryKey = 'id';

    public $incrementing = false;


    protected $fillable = [
        'id',
        'title',
        'title_slug',
        'body',
        'image',
    ];

}
