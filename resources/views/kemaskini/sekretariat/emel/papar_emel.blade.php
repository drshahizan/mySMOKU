<!DOCTYPE html>
<html>
<head>
    <title>{{$emel->subjek}}</title>
</head>
<body>
<h3>{{$emel->subjek}}</h3>
<p>{{$emel->pendahuluan}}</p>
<p>{{$emel->isi_kandungan}}</p>

<br>
<p>{{$emel->penutup}}</p>
<br>
{!!$emel->disediakan_oleh!!}
</body>
</html>
