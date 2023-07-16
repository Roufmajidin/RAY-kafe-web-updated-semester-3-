<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    protected $fillable = [

        'user_id',
        'pesanan_id',
        'id',
        'menu_id',
        'jumlah_beli',
        'jumlah_harga',
        'status',
        'is_bayar',
        'qr_code',
        'created_at',
        'no_meja',
        'updated_at'];
    public function menu()
    {
        return $this->belongsTo('App\Models\Menu', 'menu_id', 'id');
    }
    public function pesanan()
    {

        return $this->belongsTo('App\Models\Pesanan', ' pesanan_id', 'id');
    }


}
