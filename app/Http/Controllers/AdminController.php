<?php

namespace App\Http\Controllers;
use Auth;
use Str;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\PesananDetail;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menu = Menu::all();
        $user = User::all();
        $pesanan_detail = PesananDetail::orderBy('no_meja','desc')->get();
        $pesanan = Pesanan::all();

        return view('admin.index', compact( 'user', 'pesanan_detail', 'pesanan','menu'));
    }
    public function user()
    {

        $user = User::all();


        return view('admin.user-data', compact( 'user'));
    }

    public function pesanan_pelanggan()
    {

        return view('admin.index', compact('pesanan'));
    }
    public function scan()
    {

        return view('admin.scan');
    }
    public function postScan(Request $request)
    {
        $p = PesananDetail::find($request->qr_code);
        // $pp = $p->menu_id;

        // dd($p);
        // return view('admin.scan');
        $p->is_bayar = 1;

        $p->update();
        // $p = PesananDetail::find($id)->get();
        return response()->json([]);


    }
    public function ambil($id)
    {
        $p = PesananDetail::with('pesanan', 'menu')->find($id)->get();
// dd($p);
        return response()->json($p);

        // return view('admin.scan', compact('p'));
    }
    public function kirim_pesan($id)
    {
        $penerima = PesananDetail::where('status', 0)->where('id', $id)->get();
        return view('admin.kirim_pesan', compact('penerima'));
    }

    public function kirim_pesan_user(Request $request, $id)
    {
        $pesanan_detail = PesananDetail::where('id', $id)->first();
        $pesanan_detail->status = $request->isi_pesan;

        $pesanan_detail->update();
        Toastr::success(' Sukes melakukan Approve', 'Title', ["positionClass" => "toast-top-right"]);

        return redirect('/data-pesanan');
    }

    public function data_pesanan()
    {
        $pesanan_details = PesananDetail::where('status', 0)->get();

    $nama_menus = [];

    foreach ($pesanan_details as $pesanan_detail) {
        $menu = Menu::find($pesanan_detail->menu_id);

        $nama_menu = $menu->nama_menu;
        $harga_menu = $menu->harga;
        $jumlah_beli = $pesanan_detail->jumlah_beli;
        $no_meja = $pesanan_detail->no_meja;

        if (!isset($nama_menus[$no_meja])) {
            $nama_menus[$no_meja] = [];
        }

        $nama_menus[$no_meja][] = [
            'nama_menu' => $nama_menu,
            'harga_menu' => $harga_menu,
            'jumlah_beli' => $jumlah_beli,
            'no_meja' => $no_meja
        ];
    }

    // dd($nama_m   enus);

    // dd($nama_menus);
        return view('admin.pesanan_pelanggan', compact('nama_menus'));
    }

    public function store_menu(Request $request)
    {
        //storage/app

        $file_nm = $request->foto->getClientOriginalName();
        $image = $request->foto->storeAs('foto_produk', $file_nm);

        // dd('berhasil');
        $menu = new Menu;
        $menu->nama_menu = $request->nama_menu;
        $menu->harga = $request->harga;
        $menu->keterangan = $request->keterangan_menu;
        $menu->kategori = $request->kategori;
        $menu->foto = $image;


        $menu->save();

        Toastr::success('menambahkan menu ', 'sukses', ["positionClass" => "toast-top-right"]);

        return redirect('data-produk');
        // dd($request->all());

        // return view('admin.pesanan_pelanggan', compact( 'user', 'pesanan_detail', 'pesanan'));
    }
    public function c()
    {
        // $pesanan = \App\Models\Pesanan::get();
        // $user = User::all();

        // $user = \App\Models\User::get();

        // $notif = \App\Models\PesananDetail::sum('jumlah_harga');
        // $notif = \App\Models\Pesanan::sum('jumlah_pesan');

        // $notif = \App\Models\PesananDetail::where('user_id', $pesanan->id)->count();

        // dd($notif);
        return view('admin.laporan-badge');


    }

    public function edit($id)
    {
        $menu = Menu::where('id', $id)->first();
        // dd($menu);
        return view('admin.edit',compact('menu'));



    }
    public function edit_proses(Request $request, $id)
    {

        $file_nm = $request->foto->getClientOriginalName();
        $image = $request->foto->move('foto_produk', $file_nm);


        $menu = Menu::where('id', $id)->first();
        $menu->nama_menu = $request->nama_menu;
        $menu->harga = $request->harga;
        $menu->keterangan = $request->keterangan;
        $menu->kategori = $request->kategori;
        $menu->foto = $image;


        $menu->update();



        Toastr::success('Mengedit menu ', 'sukses', ["positionClass" => "toast-top-right"]);

        return redirect('/data-produk');


    }
    public function delete($id)
    {

        $menu = Menu::where('id', $id);
        $menu->delete();

        Toastr::success('Sukses Mengahpus Menu', 'sukses', ["positionClass" => "toast-top-right"]);

        return redirect('/data-produk');


    }


    public function req(){
        // $user = new User;
        // $user->name = 'Arif';
        // $user->email = 'arif@mail.com';
        // $user->level = 'admin';
        // $user->password = bcrypt('arifarif');

        // $user->save();

        // return "ok";
        $pesanan = Pesanan::all();
        $menu = Menu::all();
        return view('admin.test', compact('pesanan'));
    }




}
