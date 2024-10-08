<!DOCTYPE html>
<html>
<head>
    <title>SisPO: Daftar Pengguna Sistem</title>
</head>
<body>
    <h3>PENDAFTARAN AKAUN PENGGUNA SISTEM PENAJAAN OKU (SisPO)</h3>
    <p>Assalamualaikum WBT & Salam Sejahtera,</p>
    <br>
    <p>Tuan/Puan,</p>
    <br>
    <p>Dimaklumkan bahawa pendaftaran akaun tuan/puan telah diterima. 
        Maklumat untuk mendaftar masuk ke dalam Sistem Penajaan OKU (SisPO) adalah seperti berikut:</p>
    
    <br>
    <p>Nombor Kad Pengenalan : {{$no_kp}}
    <p>Alamat E-mel : {{$email}}
    @if($password)
    <p>Kata Laluan : {{$password}}
    @endif
    <br>
    <p>Sila klik <a href="{{$verificationUrl}}">disini</a> untuk mengaktifkan akaun anda</p>
    <br>
    <p>Jika mempunyai sebarang pertanyaan, sila hubungi <i>hotline</i> BKOKU di talian 03-8888 1616 atau e-mel ke bkoku@mohe.gov.my. </p>
   
    <p>Untuk maklumat lanjut, sila layari https://biasiswa.mohe.gov.my/ </p>
    <br>
    <p>Sekian, terima kasih.</p>
    <br>
    <p><b>Unit Bantuan Kewangan OKU/Program Pendidikan Khas</b></p>
    <p><b>Bahagian Biasiswa</b></p>
    <p><b>Kementerian Pendidikan Tinggi</b></p>
</body>
</html>