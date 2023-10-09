<!DOCTYPE html>
<html>
<head>
    <title>{{$emel->subjek}}</title>
</head>
<body>
<h3>{!! nl2br(e($emel->subjek)) !!}</h3>
<p>{!! nl2br(e($emel->pendahuluan)) !!}</p>
<p>{!! nl2br(e($emel->isi_kandungan)) !!}</p>

<br>
<p>{!! nl2br(e($emel->penutup)) !!}</p>
<br>
{!! nl2br(e($emel->disediakan_oleh)) !!}
</body>
</html>
