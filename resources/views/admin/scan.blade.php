@extends('admin.master.master')
@section('title', 'Data Menu')
@section('content')

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
<div id="reader" width="100px" class="form-group ml-3 col-md-3"></div>
<input type="text" id="result">

    <!-- Menampilkan data jika ditemukan -->


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

    $('#result').val('test');



    function onScanSuccess(decodedText, decodedResult) {
        console.log("response");


        var audio = new Audio(
            'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3');

                        audio.play();

        // handle the scanned code as you like, for example:
        // var audio = $("#chatAudio").val();
        let timerInterval;

         var audio = new Audio(
            'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3');
        $('#result').val(decodedText);



    // Mengambil nilai dari elemen dengan ID "result"
    let resultValue = $('#result').val();
    console.log(resultValue);
        toastr.options.timeOut = 100;
        let id = decodedText;
        var ur_id = $("#ur").val();
        var id_jadwal = $("#id_jadwal").val();
        html5QrcodeScanner.clear().then(_ => {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url : "/postScan",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    // _methode: "POST",
                    _token: CSRF_TOKEN,
                    qr_code: id,

                },
                success: function(response) {
                    ambilDataMasterItem(resultValue);
                }



            });
        }).catch(error => {
            alert('something wrong');
        });
        var data = response.data;
        $('#result').val(data.field1);




    // function onScanFailure(error) {
    //     // handle scan failure, usually better to ignore and keep scanning.
    //     // for example:
    //     console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        },
        /* verbose= */
        false);

    html5QrcodeScanner.render(onScanSuccess);
    html5QrcodeScanner;

    function ambilDataMasterItem() {
    let resultValue = $('#result').val();

        let data = []
        const url = "{{ url('ambilData') }}/" + resultValue;
        $.ajax({
            url,
            success: function(ambilData) {
                console.log(ambilData)
                // console.log("list_master_item")
                //variabel utk nampugn nilai
                let tampilan = ``;
                $("#table-list tbody").children().remove()

                //looping
                for (let i = 0; i < ambilData.length; i++) {

                    let isBayar = ambilData[i].is_bayar == 1 ? 'Sudah Bayar' : 'Belum Bayar';
                    tampilan += `
                    <tr>
                        <td>${ambilData[i]. i++||'-'} </td>
                        <td>${ambilData[i]. pesanan_id||'-'} </td>
                        <td>${ambilData[i]. jumlah_beli||'-'} </td>
                        <td>${ambilData[i]. jumlah_harga||'-'} </td>
                        <td>${isBayar}</td>
                    </tr>
                    `
                }
                //panggil
                $("#table-list tbody").append(tampilan)


            },
            // error:function(e){
            //     console.log(e)
            //     alert("Terjadi Kesalahan")
            // }
        })
    }

    ambilDataMasterItem();

</script>







@endsection
