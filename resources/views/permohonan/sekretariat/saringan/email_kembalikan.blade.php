<!DOCTYPE html>
<html>
<head>
    <title>{!! nl2br(str_replace(" ", '&nbsp;',$emel->subjek)) !!}</title>
</head>
<body>
    <p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->pendahuluan)) !!}</p>
    <p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->isi_kandungan1)) !!}</p>
    <ol type="i">
        @for ($i = 0; $i < count($catatan); $i++)
            <li>{{$catatan[$i]}}</li>
        @endfor
    </ol>

    <p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->isi_kandungan2)) !!}</p>
    <br>
    <p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->penutup)) !!}</p>
    <br>
    <p>{!! nl2br(str_replace(" ", '&nbsp;',$emel->disediakan_oleh)) !!}</p>
</body>
</html>
