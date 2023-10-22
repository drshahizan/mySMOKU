<html>
    <head>
        <title>BKOKU: Keputusan Permohonan</title>
        <style>
            .number {
                display: inline-block;
                width: 2em;
                text-align: right;
            }
        
            .content {
                display: inline-block;
                margin-left: 1em;
            }
        </style>        
    </head>

    <body>
        <h3>{{ $emailTidakLulus->subjek }}</h3>
        <p>{{ $emailTidakLulus->pendahuluan }}</p>
        <p>Tuan/Puan,</p>
        <br>
        <p>
            <span class="number">2.</span>
            <span class="content">{{ $emailTidakLulus->isi_kandungan1 }}</span>
        </p>
        <p>
            <span class="number">3.</span>
            <span class="content">{{ $emailTidakLulus->isi_kandungan2 }}</span>
        </p>
        <br>
        <p>{{ $emailTidakLulus->penutup }}</p>
        <br>
        <p>{!! nl2br(e($emailTidakLulus->disediakan_oleh)) !!}</p>
    </body>
</html>