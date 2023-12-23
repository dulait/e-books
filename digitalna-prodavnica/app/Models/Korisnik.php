<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korisnik extends Model
{
    use HasFactory;

    protected $table = 'korisnik';
    protected $primarniKljuc = 'korisnikId';

    protected $fillable = [
        'email',
        'password',
        'ime',
        'prezime',
    ];

    public $timestamps = true;
}
