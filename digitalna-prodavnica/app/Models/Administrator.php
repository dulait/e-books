<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $table = 'administrator';
    protected $primaryKey = 'administratorId';
    protected $fillable = [
        'adminUsername',
        'adminPassword',
    ];

    public $timestamps = true;
}