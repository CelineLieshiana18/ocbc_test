


<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
@extends('template.layout')
<div class="relative items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0" >

    <div class="wrapper">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0" style="padding-top: 5%;">
            <img align="center" src="{{ asset('img/ocbc_logo.png') }}" style="display:block;margin-left:auto;margin-right:auto;width:40%;height:10%;"/>
        </div>

        <div class="card" style="width: 50%; margin-left: 25%; margin-top:3%;">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Input Data Perubahan Bunga</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('storeBunga') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="class">Nomor Rekening</label>
                            <input type="text" class="form-control" name="noRekening" id="noRekening" required placeholder="ex. 123456789" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="class">Tanggal Perubahan Bunga</label>
                            <input id="tanggalPerubahanBunga" name="tanggalPerubahanBunga" type="datetime-local" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="end_time">Persen Bunga : <input style="border: 2px solid gray;"  name="persenBunga" type="text" size="10" id="persenBunga" required/> %(Dalam Setahun) </label>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button style="width:100%" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <div class="card-footer">
                    <a href="{{ route('/') }}" style="width:100%" type="submit" class="btn btn-warning" data-toggle="modal">Back to Menu</a>
                </div>
            </div>
        </div>
        <div class="card" style="margin-left:3%;margin-right:3%;margin-top:3%">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Perubahan Bunga</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Rekening</th>
                                <th>Tanggal Perubahan Bunga</th>
                                <th>Persen Bunga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;?>
                            @foreach ($data as $bunga)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $bunga->no_rekening }}</td>
                                <td>{{ $bunga->tanggal_perubahan_bunga }}</td>
                                <td>{{ $bunga->persen_bunga }}</td>
                            </tr>
                            <?php $i++;?>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nomor Rekening</th>
                                <th>Tanggal Perubahan Bunga</th>
                                <th>Persen Bunga</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

