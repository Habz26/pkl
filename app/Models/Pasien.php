<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien'; // SESUAIKAN dengan nama tabelmu // hapus/baris ini kalau tabel punya created_at/updated_at
}

class Bpjs extends Model
{
    protected $connection = 'bpjs'; // Gunakan koneksi database 'bpjs'
    protected $table = 'klaim'; 
    public $timestamps = false; // Jika tabel tidak memiliki kolom created_at dan updated_at
}
    
class Pembayaran extends Model
{
    protected $connection = 'bpjs'; // Gunakan koneksi database 'bpjs'
    protected $table = 'pembayaran'; 
    public $timestamps = false; // Jika tabel tidak memiliki kolom created_at dan updated_at
}