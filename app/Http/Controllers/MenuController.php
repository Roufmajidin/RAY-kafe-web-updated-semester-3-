<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Auth;

use App\Models\Pesanan;
use App\Models\PesananDetail;

use App\Models\User;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MenuController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $menu = Menu::all();
        return view('pesanan.menu', compact('menu'));
    }
    public function detail_menu($id)
    {
        $detail = Menu::where('id', $id)->first();
        // dd($detail);
        return view('pesanan.pdetail', compact('detail'));
    }

    public function store(Request $request, $id)
    {
        // dd($request->all());

        //cek valiadasi
        $tanggal = Carbon::now();
        $pesan = Menu::where('id', $id)->first();
        $cek = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if(empty($cek)){


        // return view('penjualan.pesanan', compact('barang'));
         // dd($request->all());
         $input = new Pesanan;
         $input->user_id = Auth::user()->id;
         $input->tanggal = $tanggal;
         $input->jumlah_pesan = $request->jumlah_pesan;
         $input->status = 0;
         $input->is_bayar = 0;
         $input->save();


        }
        else{

        $input = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $input->jumlah_pesan = $request->jumlah_pesan + $input->jumlah_pesan;
        $input->is_bayar = $input->is_bayar;

        $input->update();

        }


        //simpan ke database pesanan detail
    	$pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status',0)->first();
        $menu = Menu::where('id', $id)->first();

    	//cek pesanan detail
    	$cek_pesanan_detail = PesananDetail::where('menu_id', $menu->id)->where('pesanan_id', $pesanan_baru->id)->first();
    	if(empty($cek_pesanan_detail))
    	{
            $uniq_id = random_int(100000, 999999);
            $qr = QrCode::Size(200)->generate($uniq_id);
            // dd($qr);
    		$pesanan_detail = new PesananDetail;

	    	$pesanan_detail->id = $uniq_id;
	    	$pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->user_id = Auth::user()->id;
            $pesanan_detail->menu_id = $menu->id;
            $pesanan_detail->no_meja = Auth::user()->name;
            $pesanan_detail->status = 0;
            $input->is_bayar = 0;


            $pesanan_detail->jumlah_beli = $request->jumlah_pesan;
	    	// $pesanan_detail->jumlah = $request->jumlah_pesan;
	    	$pesanan_detail->jumlah_harga = $menu->harga*$request->jumlah_pesan;
	    	$pesanan_detail->qr_code = $qr;
	    	$pesanan_detail->save();


    	}
        else {
            $pesanan_detail = PesananDetail::where('menu_id', $menu->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $pesanan_detail->jumlah_harga = $request->jumlah_pesan + $pesanan_detail->jumlah_harga;
            $pesanan_detail->jumlah_beli = $request->jumlah_pesan + $pesanan_detail->jumlah_beli;
            $pesanan_detail_baru = $menu->harga * $request->jumlah_pesan;
            $pesanan_detail->status = 0;
            $input->is_bayar = $pesanan_detail->is_bayar;

            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $pesanan_detail_baru;
            $pesanan_detail->update();

        }
        Toastr::success('Sukses Memesan Menu'.$menu->nama_menu, 'silahkan tunggu dan cek riwayat pesan', ["positionClass" => "toast-top-right"]);

        return redirect('/pesan');


    }
    public function cekout()
    {
        // $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_details = PesananDetail::where('user_id', Auth::user()->id)->get();

        // $pesanan_details = [];
        foreach ($pesanan_details as $pesanan) {
            $pesanan_details = PesananDetail::where('user_id',  Auth::user()->id)->where('status', 0)->get();
            $nama_menus = [];
            foreach ($pesanan_details as $pesanan_detail) {
                $menu = Menu::find($pesanan_detail->menu_id);
                $nama_menu = $menu->nama_menu;
                $harga_menu = $menu->harga;
                $jumlah_beli = $pesanan_detail->jumlah_beli;
                $nama_menus[] = [
                    'nama_menu' => $nama_menu,
                    'harga_menu' => $harga_menu,
                    'jumlah_beli' => $jumlah_beli
                ];
                // dd($nama_menu);
            }
        }
        // dd($pesanan_details);

        Toastr::info('Tunggu Beberapa saat yak ..', 'Hi ..', ["positionClass" => "toast-top-right"]);

        // return view ('pesanan.cekout', compact('pesananpesanan', 'pesanan_details'));
        return view ('pesanan.cekout', compact('nama_menus'));
    }
    public function struk()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        // $pesanan_details = [];

        // Toastr::info('Tunggu Beberapa saat yak ..', 'Hi ..', ["positionClass" => "toast-top-right"]);

        return view ('pesanan.struk', compact('pesanan', 'pesanan_details'));
    }

    public function about()
    {


        // Toastr::success('data ok:)', 'success');
        Toastr::success(' in here', 'Title', ["positionClass" => "toast-top-right"]);
        Toastr::clear();
        return view ('master.about-kita');
    }
}
