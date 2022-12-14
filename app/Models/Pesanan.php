<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    public $timestamps = false;
    protected $fillable = ['ticket', 'nama', 'no_wa', 'alamat', 'pesanan_diambil', 'pesanan', 'status_admin', 'status', 'order_id', 'status_code', 'gross_amount'];
}
