@extends('master.master')
@section('content')
    <!-- ***** Features Big Item Start ***** -->
    <section class="section" id="about">
        <div class="container">
        <div class="right-image-decor"></div>


            <div class="row">
            <?php
                $no = 1
            ?>

            @foreach($menu as $data)
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">

                    <div class="features-item">
                        <div class="features-icon">
                            <h2>{{ $no++ }}</h2>
                            <img src="{{asset($data->foto) }}" alt="">
                            <h4>{{ $data->nama_menu }}</h4>
                            <p>Rp. {{ number_format($data->harga) }}</p>
                            <p>{{ $data->keterangan }}</p>
                            <a href="/pesan_barang/{{$data->id}}" class="main-button">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>

    </section>
    <!-- ***** Features Big Item End ***** -->

@stop
