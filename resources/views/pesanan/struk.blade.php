@extends('master.master')
@section('title', 'cekout Barang')
@section('content')

            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    
           
             
                  </div>
                </div>
                
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="section-title">Total Belanja</div>
                    <p class="section-lead">Menu Pesananmu</p>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
                          <th data-width="40">#</th>
                          <th>Menu</th>
                          <th class="text-center">Harga</th>
                          <th class="text-center">total beli</th>
                          <th class="text-right">total</th>
                        </tr>
                        <tr>
                        @foreach($pesanan_details as  $data)
                          <td></td>
                          <td>{{ $data->menu->nama_menu }}</td>
                          <td class="text-center">Rp. {{ number_format($data->menu->harga) }}</td>
                          <td class="text-center">{{ $data->jumlah_beli }}</td>
                          <td class="text-right">Rp.{{ number_format($data->jumlah_harga) }}</td>
                        </tr>
                       @endforeach
                      </table>
                    </div>
                    <div class="row mt-4" style="color:#ffff">
                      <div class="col-lg-8">
                        <div class="section-title">Payment Method</div>
                        <p class="section-lead" style="color:#ffff">The payment method that we provide is to make it easier for you to pay invoices.</p>
                        <div class="images">
                          <img src="" alt="">
                          <img src="" alt="">
                          <img src="" alt="">
                          <img src="" alt="">
                        </div>
                      </div>
                      <div class="col-lg-4 text-right">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Total</div>
                          <?php
                                $pesanan = \App\Models\Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

                                
                                $notif = \App\Models\PesananDetail::where('pesanan_id', $pesanan->id)->sum('jumlah_harga');


                               
                            ?>
                          <div class="invoice-detail-value">Rp. {{ number_format($notif) }}</div>
                        </div>
                     
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="text-md-right">
                
                <button class="btn btn-warning btn-icon icon-left"><i class="ios icon-user"></i> Print</button>
              </div>
            </div>
          </div>



        @stop