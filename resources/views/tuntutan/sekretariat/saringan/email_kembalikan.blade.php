<!DOCTYPE html>
<html>
<head>
    <title>{!! nl2br(str_replace(" ", '&nbsp;',$emel->subjek)) !!}</title>
</head>
<body>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->pendahuluan)) !!}</p>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->isi_kandungan)) !!}</p>

<br>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->penutup)) !!}</p>
<br>
<p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->disediakan_oleh)) !!}</p>
</body>
</html>
