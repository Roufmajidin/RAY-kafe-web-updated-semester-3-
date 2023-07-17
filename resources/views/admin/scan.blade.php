@extends('admin.master.master')
@section('title', 'Data Menu')
@section('content')

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
<div class="row">
    <div class="col-md-5 pr-1">
        <div id="reader"></div>
    </div>
    <div class="col-md-5 pr-1">
        <div class="form-group">
            <label>Menu Id</label>
            <input id="result" type="text" class="form-control" placeholder="Nama Menu" value="" name="nama_menu">
        </div>
        <div class="form-group">
            <label>Nama Menu</label>
            <input id="nama_menu" type="text" class="form-control" placeholder="nama Menu" value="" name="Nama Menu">
        </div>
    </div>

</div>

<table id="table-list" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>pesanan_id</th>
            <th>jumlah Beli</th>
            <th>jumlah_harga</th>
            <th>bayar</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data akan ditampilkan di sini -->
    </tbody>
</table>
<script>
    // ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#result').val('test');
        ambilDataMasterItem();
        startQRCodeScanner(); // Panggil fungsi untuk memulai pembaca QR code
    });

    function onScanSuccess(decodedText, decodedResult) {
        console.log("response");
        var audio = new Audio('https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3');
        audio.play();
        $('#result').val(decodedText);

        let resultValue = $('#result').val();
        console.log(resultValue);
        toastr.options.timeOut = 100;
        let id = decodedText;
        var ur_id = $("#ur").val();
        var id_jadwal = $("#id_jadwal").val();
        html5QrcodeScanner.clear().then(_ => {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/postScan",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: CSRF_TOKEN,
                    qr_code: id,
                },
                success: function(response) {
                    ambilDataMasterItem(resultValue);
                    startQRCodeScanner(); // Panggil fungsi untuk memulai pembaca QR code kembali setelah pemindaian selesai
                }
            });
        }).catch(error => {
            alert('something wrong');
        });
        var data = response.data;
        $('#result').val(data.field1);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner("reader", {
        fps: 10,
        qrbox: {
            width: 250,
            height: 250
        }
    }, false);

    function startQRCodeScanner() {
        html5QrcodeScanner.render(onScanSuccess);
    }

    function ambilDataMasterItem() {
        let resultValue = $('#result').val();
        let data = [];
        const url = "{{ url('ambilData') }}/" + resultValue;
        $.ajax({
            url,
            success: function(ambilData) {
                console.log(ambilData)
                let tampilan = ``;
                $("#table-list tbody").children().remove()
                for (let i = 0; i < ambilData.length; i++) {
                    let isBayar = ambilData[i].is_bayar == 1 ? 'Sudah Bayar' : 'Belum Bayar';
                    tampilan += `
                        <tr>
                            <td>${i + 1 || '-'}</td>
                            <td>${ambilData[i].pesanan_id || '-'}</td>
                            <td>${ambilData[i].jumlah_beli || '-'}</td>
                            <td>${ambilData[i].jumlah_harga || '-'}</td>
                            <td>${isBayar}</td>
                        </tr>
                    `;
                }
                $("#table-list tbody").append(tampilan);
            },
            error: function(e) {
                console.log(e)
                alert("Terjadi Kesalahan")
            }
        });
    }

</script>







@endsection
