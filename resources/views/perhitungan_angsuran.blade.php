


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
                    <h3 class="card-title">Perhitungan Angsuran</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('lihatAngsuran') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="class">Nomor Rekening</label>
                            <input type="text" class="form-control" name="noRekening" id="noRekening" required placeholder="ex. 123456789" autofocus>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button style="width:100%" type="submit" class="btn btn-primary">Lihat Angsuran</button>
                    </div>
                </form>
                <div class="card-footer">
                    <a href="{{ route('/') }}" style="width:100%" type="submit" class="btn btn-warning" data-toggle="modal">Back to Menu</a>
                </div>
            </div>
        </div>
        <?php
        if($data != 0){
        ?>
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
                                    <th>Bulan</th>
                                    <th>Tanggal Angsuran</th>
                                    <th>Saldo Pokok</th>
                                    <th>Angsuran Pokok</th>
                                    <th>Angsuran Bunga</th>
                                    <th>Angsuran Total</th>
                                    <th>% Bunga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0;
                                    $time = strtotime($tanggalRealisasi);
                                    $stringDate = date("d-M-Y", $time);
                                    $datenow = date("d-m-Y", $time);
                                    $saldoSebelumnya = $plafond;
                                    $bungaPerBulan = ($persenBunga/100)/12;
                                    $o = 0;
                                    $j = -1;
                                    $check = false;
                                    $perubahanBunga = 0;
                                    if($bunga != null){
                                        $perubahanBunga = date('m-Y',strtotime($bunga[0]->tanggal_perubahan_bunga));
                                    }
                                    $tanggalSekarang = date('m-Y',strtotime($datenow));
                                ?>
                                @while($i <= $jangkaWaktu)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $stringDate }}</td>
                                        @if ($perubahanBunga != $tanggalSekarang && $perubahanBunga != 0 && !$check)
                                            @if($i==0)
                                                <td>{{ $saldoSebelumnya }}</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>{{ $persenBunga }}</td>
                                            @else
                                                <?php
                                                    $angsuranBunga = round($saldoSebelumnya*$bungaPerBulan,0);
                                                    $waktu = $jangkaWaktu-($i-1);
                                                    $bawah = 1 - pow(($bungaPerBulan+1),-$waktu);
                                                    $angsuranTotal = round($saldoSebelumnya*($bungaPerBulan/$bawah),0);
                                                    $angsuranPokok = round($angsuranTotal - $angsuranBunga,0);
                                                    $saldoSebelumnya = $saldoSebelumnya - $angsuranPokok;
                                                ?>
                                                <td>{{ $saldoSebelumnya }}</td>
                                                <td>{{ $angsuranPokok }}</td>
                                                <td>{{ $angsuranBunga }}</td>
                                                <td>{{ $angsuranTotal }}</td>
                                                <td>{{ $persenBunga }}</td>
                                            @endif
                                        @else
                                            @if ($bunga == null)
                                                <?php
                                                    $angsuranBunga = round($saldoSebelumnya*$bungaPerBulan,0);
                                                    $waktu = $jangkaWaktu-($i-1);
                                                    $bawah = 1 - pow(($bungaPerBulan+1),-$waktu);
                                                    $angsuranTotal = round($saldoSebelumnya*($bungaPerBulan/$bawah),0);
                                                    $angsuranPokok = round($angsuranTotal - $angsuranBunga,0);
                                                    $saldoSebelumnya = $saldoSebelumnya - $angsuranPokok;
                                                ?>
                                                <td>{{ $saldoSebelumnya }}</td>
                                                <td>{{ $angsuranPokok }}</td>
                                                <td>{{ $angsuranBunga }}</td>
                                                <td>{{ $angsuranTotal }}</td>
                                                <td>{{ $persenBunga }}</td>
                                            @else
                                                <?php
                                                    $check = true;
                                                    $tanggalSekarang = date('m-Y',strtotime($datenow));
                                                    if($perubahanBunga == $tanggalSekarang){
                                                        $j+=1;
                                                        if($j < count($bunga) -1){
                                                            $perubahanBunga = date('m-Y',strtotime($bunga[$j+1]->tanggal_perubahan_bunga));
                                                        }else{
                                                            $perubahanBunga = date('m-Y',strtotime($bunga[$j]->tanggal_perubahan_bunga));
                                                        }
                                                    }
                                                ?> 
                                                <?php 
                                                    if($perubahanBunga == $tanggalSekarang){
                                                        $persenBunga = $bunga[$j]->persen_bunga;
                                                        $bungaPerBulan = (($persenBunga/100)/12);
                                                    }
                                                ?>
                                                <?php
                                                    $angsuranBunga = round($saldoSebelumnya*$bungaPerBulan,0);
                                                    $waktu = $jangkaWaktu-($i-1);
                                                    $bawah = 1 - pow(($bungaPerBulan+1),-$waktu);
                                                    $angsuranTotal = round($saldoSebelumnya*($bungaPerBulan/$bawah),0);
                                                    $angsuranPokok = round($angsuranTotal - $angsuranBunga,0);
                                                    $saldoSebelumnya = $saldoSebelumnya - $angsuranPokok;
                                                ?>
                                                <td>{{ $saldoSebelumnya }}</td>
                                                <td>{{ $angsuranPokok }}</td>
                                                <td>{{ $angsuranBunga }}</td>
                                                <td>{{ $angsuranTotal }}</td>
                                                @if ($perubahanBunga == $tanggalSekarang)
                                                    <td>{{ $persenBunga }}</td>
                                                @else
                                                    <td>{{ $j == -1 ? $bunga[$j +1]->persen_bunga : $bunga[$j]->persen_bunga }}</td>
                                                @endif
                                            @endif 
                                        @endif

                                    </tr>
                                    <?php
                                        $string = "+".($i+1)." month";
                                        $stringDate = date("d-M-Y", strtotime($string, $time));
                                        $datenow = date("d-m-Y", strtotime($string, $time));
                                        $i++;
                                        $tanggalSekarang = date('m-Y',strtotime($datenow));
                                    ?>
                                @endwhile
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Tanggal Angsuran</th>
                                    <th>Saldo Pokok</th>
                                    <th>Angsuran Pokok</th>
                                    <th>Angsuran Bunga</th>
                                    <th>Angsuran Total</th>
                                    <th>% Bunga</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        <?php }?>
    </div>
</div>

