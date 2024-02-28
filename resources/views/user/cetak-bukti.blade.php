<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tiket # {{ $kodeBooking }}</title>
    
   <style>
    body{
    font-family: "Poppins", sans-serif;
    }
        hr {
          display: block;
          height: 1px;
          background: transparent;
          width: 100%;
          border: none;
          border-top: solid 1px #aaa;
      }
      table {
        font-size: 15px;
      }
      </style>
</head>
<body>
    <table align="center">
        <tr>
            <td style="text-align: left">
                <img src="assets/img/auth/logo-cimahi.svg" alt="logo" width="50" height="50">
            </td>
            <td style="text-align: left">
            <center>
              <font size="4" style="text-align: left">
                PEMERINTAH KOTA CIMAHI
              </font><br />
              <font size="5">
                <b>Mal Pelayanan Publik Kota Cimahi</b>
              </font> <br />
              <font size="2">
                <i>Jl. Raden Demang Hardjakusumah No.1, Cibabat, Kec. Cimahi Utara, Kota Cimahi</i>
              </font> <br />
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <hr />
          </td>
        </tr>
      </table>
      <table align="center">
        <tr>
          <td>
            <font size="5"> <b>Tanda Terima Dokumen</b> </font>
        </tr>
      </table>
      
      <table align="center">
        <tr>
          <td>
            Kode Booking : {{ $kodeBooking }}
          </td>
        </tr>
        <tr>
          <td height="7"></td>
        </tr>
      </table>

      <table align="center">
        <tr>
          <td>
          <center>
            <img width="150" height="150" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{ $kodeBooking }}&choe=UTF-8" />
            <br />
            <font size="2">
              Scan untuk melihat detail permohonan
            </font>
            </center>
          </td>
        </tr>
        <tr>
          <td height="10"></td>
        </tr>
      </table>

      <table align="center">
        <tr>
          <td>
            Telah terima permohonan dari :
          </td>
        </tr>
      </table>
      <table>
        <tr><td>Nama Pemohon</td><td>:</td><td>{{ $data->name }}</td></tr>
        <tr><td>SKPD</td><td>:</td><td>{{ $data->skpd }}</td></tr>
        <tr><td>Nama Instansi</td><td>:</td><td>{{ $data->nama_instansi }}</td></tr>
        <tr><td>Nama Kegiatan</td><td>:</td><td>{{ $data->nama_kegiatan }}</td></tr>
        <tr><td>Jumlah Peserta</td><td>:</td><td>{{ $data->jumlah_peserta }} Orang</td></tr>
        <tr><td>Narasumber</td><td>:</td><td>{{ $data->narasumber }}</td></tr>
        <tr><td>Tanggal</td><td>:</td><td>{{ \Carbon\Carbon::parse($data->tgl_mulai)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($data->tgl_selesai)->format('d M Y') }}</td></tr>
        <tr><td>Jam</td><td>:</td><td>{{ sprintf("%02d", $data->jam_mulai) }}:00 s/d {{ sprintf("%02d", $data->jam_selesai) }}:00</td></tr>
        <tr><td>Fasilitas</td><td>:</td><td>
            @php
                                    $inputUser = $data->id_fasilitas;
                                    $arrayFasilitas = explode(",", $inputUser);
                                    $fasilitas = \App\Models\Fasilitas::whereIn('id_fasilitas', $arrayFasilitas)->pluck('nama_fasilitas');
                                    $arrayNamaFasilitas = $fasilitas->toArray();
                                    $stringNamaFasilitas = implode(", ", $arrayNamaFasilitas);
                                    echo $stringNamaFasilitas;
                                @endphp
            </td></tr>
        
            <tr><td>Tambahan Alat</td><td>:</td><td>{{ $data->nama_alat }}</td></tr>
      </table>
      <hr>
      <table>
        <tr><td>Tanggal Pengajuan Permohonan</td><td>:</td><td>{{ \Carbon\Carbon::parse($data
            ->created_at)->format('d M Y - H:i') }}</td></tr>
        <tr><td>Status Pengajuan</td><td>:</td><td style="color: green"><b>{{ $data->status_permohonan }}</b></td></tr>

      </table>
      <hr>
      <center><p><i>* Gunakan Tanda Terima diatas untuk bukti bahwa Anda sudah melakukan Booking pada Aplikasi SIPIRANG dengan status <b>"DITERIMA"<b></p></i>
      </center>      
    <br><br><br><br>       
    <center>
        <p>copyright by :</p>
        <br><br>
        <img src="assets/img/auth/logo.png" alt="logo" width="200" height="71">
        <img src="assets/img/auth/logo-dpmptsp.png" alt="logo" width="200" height="75">
    </center>
</body>
</html>