@extends('master.master')
@section('title', 'cekout Barang')
@section('content')
<div class="container" style="margin-bottom:80px;">
<div class="row text-center mb-2" style="margin-top:80px;">
              <div class="col-8 col col-lg-12 ">
              <h4 style="margin-bottom: 20px;"><b>Anda Memesan</b></h4>
                <div class="card">

                  <div class="card-body">
                    <div class="table-responsive" >
                      <table class="table table-striped table-md" >
                        <tr>
                          <th>#</th>
                          <th>Pesanan</th>
                          <th>jumlah</th>
                          <th>Total</th>
                          <th>Status</th>
                          <th>Qr Trans</th>

                        </tr>
                        <?php
                        $no = 1
                        ?>
                        @foreach($pesanan_details as  $data)
                        <tr>
                          <td>{{$no++}}</td>
                          <td>{{$data->menu->nama_menu}}</td>
                        <td>{{$data->jumlah_beli}} Pcs</td>

                          <td>Rp. {{number_format($data->jumlah_harga)}}, -</td>
                          @if($data->status == 0)
                          <td style="color:red";><i class="ion-ios-timer" style="color:black"> sedang diproses</i> </td>
                          @else
                          <td><i class="ion-android-done-all"> segera diantar</i></td>
                          @endif
                          <td style="">{!!$data->qr_code!!}<br>scan here in Cashier</td>



                        @endforeach

                        </tr>



                      </table>


                    </div>


                  </div>






@endsection
