@extends('master.master')
@section('content')
<div class="left-image-decor"></div>

<!-- ***** Features Big Item Start ***** -->
<section class="section" id="promotion">
    <div class="container">
        <div class="row">
            <div class="left-image col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix-big"
                data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                <img src="{{asset($detail->foto)}} " class="img ml-4" alt=""
                style="width:300px;">
            </div>
            <div class="right-text offset-lg-1 col-lg-6 col-md-12 col-sm-12 mobile-bottom-fix">
                <ul>
                    <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                        <img src=""  alt="">
                        <div class="text">
                            <h3><strong>{{$detail->nama_menu}}</strong></h3>
                            <h4>Harga <span style='font-size: 0.7em'>{{number_format($detail->harga)}}</span></h4>
                            <P class='mb-3'>{{$detail->keterangan}}</P>
                            <form class="form-group col-12" method="POST" action="/pesan/{{$detail->id}}">
                                @csrf
                                <input class="form-control" name='jumlah_pesan' type="text" placeholder="Masukan Jumlah">
                                <button type="submit" class="btn btn-primary mt-3">Pesan Sekarang</button>
                            </form>

                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@stop
