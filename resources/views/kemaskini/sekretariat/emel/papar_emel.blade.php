<!DOCTYPE html>
<html>
<head>
    <title>{{$emel->subjek}}</title>
</head>
<body>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->pendahuluan)) !!}</p>
<p>{!! nl2br(str_replace(" ", '&nbsp;', $emel->isi_kandungan1)) !!}</p>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->isi_kandungan2)) !!}</p>

<br>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->penutup)) !!}</p>
<br>
{!! nl2br(str_replace(" ", '&nbsp;',$emel->disediakan_oleh)) !!}
</body>
</html>
