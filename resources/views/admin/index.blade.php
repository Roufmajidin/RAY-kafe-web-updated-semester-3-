@extends('admin.master.master')
@section('title', 'Data Menu')


@section('content')




                <a href="/tambah-produk" class="btn btn-secondary mb-3">Tambah Data</a>

                    <div class="card">




                            <table class="table">

                                <tr>
                                    <th>nama menu<th>
                                    <th>Harga</th>
                                    <th>keterangan</th>
                                    <th>Faktur</th>
                                    <th>Aksi</th>



                                        @foreach($menu as $data)
                                    <tr style="font-size:12px;">
                                        <td>{{$data->nama_menu}}</td>
                                        <td><img src="{{ asset($data->foto) }}" style='width:40px'></td>
                                        <td>Rp. {{number_format($data->harga)}}</td>
                                        <td>{{$data->keterangan}}</td>
                                        <td>
                                            <a href="/edit/{{ $data->id }}" class="btn-sm btn-success"><i class="fa fa-edit" style="font-size:10px;"></i></a>
                                            <a href="/hapus/{{ $data->id }}" class="btn-sm btn-success"><i class="fa fa-trash" style="font-size:10px;"></i></a>


                                        </td>

                                    </tr>

                                        @endforeach
                            </table>
                        </div>

















@stop
