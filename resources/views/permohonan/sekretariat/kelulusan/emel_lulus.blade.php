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
        <h3>{{ $emailLulus->subjek }}</h3>
        <p>{{ $emailLulus->pendahuluan }}</p>
        <p>Tuan/Puan,</p>
        <br>
        <p>
            <span class="number">2.</span>
            <span class="content">{{ $emailLulus->isi_kandungan1 }}</span>
        </p>
        <br>
        <p>{{ $emailLulus->penutup }}</p>
        <br>
        <p>{!! nl2br(e($emailLulus->disediakan_oleh)) !!}</p>
    </body>
</html>