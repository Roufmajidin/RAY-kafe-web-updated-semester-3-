<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['
    harga'	,
    'keterangan',
    'nama_menu'	,
    'foto'	,
    'kategori',
    'is_bayar',
    'created_at',
   ' updated_at	'];
    public function pesanan_detail()
    {
        return $this->hasMany('App\Models\PesananDetail', 'menu_id', 'id');
    }
}
