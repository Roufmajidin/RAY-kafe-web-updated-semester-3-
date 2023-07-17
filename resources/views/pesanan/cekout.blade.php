@extends('master.master')
@section('title', 'cekout Barang')
@section('content')
<div class="invoice" style="margin-bottom:80px;">
    <div class="row text-center mb-2" style="margin-top:80px;">
        <div class="col-8 col col-lg-12 ">
            <h4 style="margin-bottom: 20px;"><b>Anda Memesan</b></h4>
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>#</th>
                                <th>Pesanan</th>
                                <th>jumlah</th>
                                <th>/satuan</th>
                                <th>Status</th>
                                <th>Qr Trans</th>

                            </tr>
                            <?php
                        $no = 1
                        ?>
                            {{-- @foreach($pesanan_details as $data) --}}
                            @foreach ($nama_menus as $data)

                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$data['nama_menu']}}</td>
                                <td>x {{$data['jumlah_beli']}}</td>
                                <td>{{number_format($data['harga_menu'])}} </td>

                                @if($data['status'] == 0)
                                <td style="color:red" ;><i class="ion-ios-timer" style="color:black"> sedang
                                        diproses</i> </td>
                                @else
                                <td><i class="ion-android-done-all"> segera diantar</i></td>
                                @endif
                                <td> {!!$data['qr']!!}</td>

                                @endforeach
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-12 text-right">
                        <div class="invoice-detail-item">
                            <div class="invoice-detail-name">Total</div>
                            @php
                            $total_harga = 0; // Variabel untuk mengakumulasikan total harga

                            foreach ($nama_menus as $menu) {
                            $total_harga += $menu['harga_menu'] * $menu['jumlah_beli'];
                            }
                            @endphp
                            <div class="invoice-detail-value">Rp. {{ number_format($total_harga) }}</div>
                            {{-- <p style=" justify-content: flex-end;display: flex; font-weight:900" class="">Total
                                Harga: Rp {{number_format($total_harga)}} --}}

                        </div>
                    </div>
                </div>


                @endsection
                {{-- @foreach ($nama_menus as $menu)
                <p>{{ $menu['nama_menu'] }} - Harga: {{ $menu['harga_menu'] }} - jumlah beli: {{ $menu['jumlah_beli'] }}
                </p>

                @endforeach
                @php
                $total_harga = 0; // Variabel untuk mengakumulasikan total harga

                foreach ($nama_menus as $menu) {
                $total_harga += $menu['harga_menu'] * $menu['jumlah_beli'];
                }
                echo "Total Harga: " . $total_harga;
                @endphp --}}
