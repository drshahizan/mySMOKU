<!DOCTYPE html>
<html>
<head>
    <title>{!! nl2br(str_replace(" ", '&nbsp;',$emel->subjek)) !!}</title>
</head>
<body>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->pendahuluan)) !!}</p>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->isi_kandungan1)) !!}</p>
<ol>
    @for ($i = 0; $i < count($tuntutan_item); $i++)
        @if($tuntutan_item['kep_saringan']!="Lengkap")
            <li>{{$tuntutan_item['jenis_yuran']}} ({{$tuntutan_item['no_resit']}}) tidak lengkap. </li>
        @endif
    @endfor
    @if($saringan['saringan_kep_peperiksaan']!="Lengkap")
        <li>Keputusan peperiksaan tidak lengkap.</li>
    @endif
</ol>
<br>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->isi_kandungan2)) !!}</p>
<br>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->penutup)) !!}</p>
<br>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->disediakan_oleh)) !!}</p>
</body>
</html>
