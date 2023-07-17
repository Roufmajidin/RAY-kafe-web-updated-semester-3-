@extends('admin.master.master')
@section('title', 'Data Menu')
@section('content')

<div class="col-12 md-6">
    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Meja</th>
                    <th>Nama Menu</th>
                    <th>Jumlah Pesan</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach($nama_menus as $meja => $pesanan_details)
                    <?php $totalHarga = 0; ?>
                    @foreach($pesanan_details as $key => $data)
                        <tr>
                            @if($key === 0)
                                <td rowspan="{{ count($pesanan_details) }}">{{ $no++ }}</td>
                                <td rowspan="{{ count($pesanan_details) }}">{{ $meja }}</td>
                            @endif
                            <td>{{ $data['nama_menu'] }}</td>
                            <td>{{ $data['jumlah_beli'] }}</td>
                            <td>{{ $data['harga_menu'] }}</td>
                            <td><!-- Tambahkan kode untuk kolom faktur --></td>
                            <td><!-- Tambahkan kode untuk kolom aksi --></td>
                        </tr>
                        <?php $totalHarga += $data['jumlah_beli'] * $data['harga_menu']; ?>
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                        <td><strong>Total Harga:</strong></td>
                        <td>{{ $totalHarga }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
