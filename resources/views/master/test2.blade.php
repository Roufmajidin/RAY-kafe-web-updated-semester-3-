@extends('master.master')
@section('content')
<div class="welcome-area">
<section class="section" id="promotion">
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        
          <!-- /.card-header -->
          <div class="card-body">
            <form class="row" method="POST" action="/tambah_menu" >
              <div class="col-md-4">
                <div class="form-group">
                  <label>Nama menu</label>
                    <input type="text" class="form-control" placeholder="menus">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Kateogri</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">--</option>
                    <option>Makanan</option>
                    <option>Minuman</option>
                    <option>Makanan Ringan</option>
                    <option>--</option>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label>Harga</label>
                  <div class="form-group">
                  
                    <input type="text" class="form-control" placeholder="Harga">
                </div>
                <!-- /.form-group -->
              </div>
              <div class="form-group">
                  <label>Keterangan</label>
                  <div class="form-group">
                  
                    <input type="text" class="form-control" placeholder="Keterangan">
                </div>
                <div class="form-group">
                  <label>Foto Menu</label>
                  <div class="form-group">
                  
                    <input type="file" class="form-control" style="width: 60%;">
                    
                </div>
                <br>
                <button type="submit" id="form-submit" class="btn btn-primary">Simpan Menu</button>

             

                  
                
                
                </div>
              </div>
              
              
              <!-- /.col -->
              
               
              
                
                <!-- /.form-group -->
         
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

           
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div>
        </div>
        <!-- /.card -->
@stop