<html>
    <body>
        <h3>{{ $emailLulus->subjek }}</h3>
        <p>{{ $emailLulus->pendahuluan }}</p>
        <br>
        <p>Tuan/Puan,</p>
        <br>
        <p>
            2.<span style="margin-left: 30px;">{{ $emailLulus->isi_kandungan1 }}</span>
        </p>
        <br>
        <p>{{ $emailLulus->penutup }}</p>
        <br>
        <p>{!! nl2br(e($emailLulus->disediakan_oleh)) !!}</p>
    </body>
</html>