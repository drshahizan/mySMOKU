<!DOCTYPE html>
<html>
<head>
    <title>SistemBKOKU: Lupa Kata Laluan</title>
</head>
<body>
    <h3>TUKAR KATA LALUAN PENDAFTARAN SISTEM BANTUAN KEWANGAN ORANG KURANG UPAYA (BKOKU)/ PROGRAM PENDIDIKAN KHAS (PPK)</h3>
    <p>Assalamualaikum WBT & Salam Sejahtera,</p>
    <br>
    <p>Tuan/Puan,</p>
    <br>    
    <p>Permohonan lupa kata laluan telah diterima.</p>
    <p>
        Set semula kata laluan anda dengan mengklik pautan berikut:
        <a href="{{ route('password.reset', ['token' => $token]) }}">Set Semula Kata Laluan</a>
        {{-- {{ route('password.reset', ['token' => $token]) }} --}}
    </p>
    <p>Jika anda tidak meminta set semula kata laluan, tiada tindakan lanjut diperlukan.</p>
    <br>
    <br>
    <p>Sekian, terima kasih.</p>
    <br>
    <p><b>Unit Bantuan Kewangan OKU/Program Pendidikan Khas</b></p>
    <p><b>Bahagian Biasiswa</b></p>
    <p><b>Kementerian Pendidikan Tinggi</b></p>
</body>
</html>