@extends('admin.master.master')
@section('title', 'Data Menu')
@section('content')

<div class="col-12 md-6">
    <div class="card">





            <table class="table table-striped">




                <tr>

                    <th>#</th>
                    <th>Nama Menu</th>
                    <th>Jumlah Pesan</th>


                    <th>Meja</th>
                    <th>Faktur</th>
                    <th>Aksi</th>

                </tr>

                <?php
                                        $no = 1
                                        ?>

                @foreach($pesanan_detail as $data)



                <tr>

                    <td>{{$data->menu->nama_menu}}</td>
                    <td><img src="{{ asset($data->menu->foto) }}" style='width:100px'></td>


                    <td>{{$data->jumlah_beli}}</td>
                    <td>{{$data->no_meja}}</td>
                    @if( $data->is_bayar == 0)

                    <td>Belum Bayar</td>
                    @else
                    <td>Sudah Bayar</td>

                    @endif








                    @if($data->status == 1)

                    <td><a href="/kirim_pesan/{{ $data->id }}" class="btn btn-success"><i class="fas fa-check"></td>
                    @else
                    <td><a href="/kirim_pesan/{{ $data->id }}" class="btn btn-danger"><i class="fas fa-check"></td>

                    @endif












                </tr>

                @endforeach










            </table>







        </div>
    </div>

</div>
</div>












@stop
