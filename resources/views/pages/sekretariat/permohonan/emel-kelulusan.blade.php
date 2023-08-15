<!DOCTYPE html>
<html>
<head>
    <title>BKOUKU: Permohonan Dikembalikan</title>
</head>
<body>
    <h3>BKOKU: PERMOHONAN DIKEMBALIKAN</h3>
    <p>Assalammualaikum W.R.T & Salam Sejahtera.</p>
    <p>Sukacita dimaklumkan bahawa permohonan anda telah diluluskan dan sila imbas QR di bawah untuk memuat turun surat tawaran anda.</p>
    @php
        $i=0;    
    @endphp

    @if ($catatan['catatan1']!=null)
    @php
        $i++;    
    @endphp 
        <p>
            {{$i}}.{{$catatan['catatan1']}}
        </p>
    @endif

    @if ($catatan['catatan2']!=null)
    @php
        $i++;    
    @endphp
        <p>{{$i}}. Terdapat butiran yang tidak benar dalam Maklumat Akademik</p>
    @endif

    @if ($catatan['catatan3']!=null)
    @php
        $i++;    
    @endphp
    <p>{{$i}}. Terdapat butiran yang tidak benar dalam Salinan Dokumen</p>
    @endif    

    <br>
    <p>Sekian, Terima Kasih</p>
    <br>
    <p>Yang Benar,</p>
    <p><b>Mohd Yusuf Bin Sabri Az-Zain</b></p>
    <p><b>014-56789394</b></p>
</body>
</html>