<!DOCTYPE html>
<html>
<head>
    <title>{!! nl2br(str_replace(" ", '&nbsp;',$emel->subjek)) !!}</title>
</head>
<body>

<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->pendahuluan)) !!}</p>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->isi_kandungan1)) !!}</p>
<ol type="i">
    @foreach ($tuntutan_item as $item)
        @if($item['kep_saringan']=="Tidak lengkap")
            <li>{{$item['jenis_yuran']}} ({{$item['no_resit']}}) tidak lengkap. </li>
        @endif
    @endforeach
    @if($saringan->saringan_kep_peperiksaan=="Tidak Lengkap")
        <li>Keputusan peperiksaan tidak lengkap.</li>
    @endif
        <li>{{$saringan->catatan}}</li>
</ol>
<br>

<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->isi_kandungan2)) !!}</p>
<br>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->penutup)) !!}</p>
<br>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->disediakan_oleh)) !!}</p>
</body>
</html>
