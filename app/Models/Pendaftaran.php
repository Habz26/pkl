<?php

// app/Models/Pendaftaran.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Pendaftaran extends Model
{
    protected $table = 'pendaftaran'; // SESUAIKAN dengan nama tabelmu // hapus/baris ini kalau tabel punya created_at/updated_at
    public $timestamps = false;
}
