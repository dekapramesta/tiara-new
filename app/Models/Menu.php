<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 't_menu';
    protected $fillable = ['nama', 'harga', 'deskripsi', 'gambar', 'id_jenis'];

    public function GetJenis()
    {
        # code...
        return $this->belongsTo(JenisMenu::class, 'id_jenis');
    }
}
