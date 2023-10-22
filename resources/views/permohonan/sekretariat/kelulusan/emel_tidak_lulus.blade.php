<html>
    <head>
        <title>BKOKU: Keputusan Permohonan</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
    
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
            }
    
            .content {
                padding-left: 40px;
            }
    
            .number {
                font-weight: bold;
            }
    
            ol {
                list-style: lower-roman;
                padding-left: 20px;
            }
        </style>      
    </head>

    <body>
        <div class="container">
            <h3>{{ $emailTidakLulus->subjek }}</h3>
            <p>{{ $emailTidakLulus->pendahuluan }}</p>
            <p>Tuan/Puan,</p>

            <p class="number">2.</p>
            <div class="content">
                <p>{{ $emailTidakLulus->isi_kandungan1 }}</p>
                <ol>
                    @foreach ($catatanArray as $catatanItem)
                        <li>{{ $catatanItem }}</li>
                    @endforeach
                </ol>
            </div>

            <p class="number">3.</p>
            <div class="content">
                <p>{{ $emailTidakLulus->isi_kandungan2 }}</p>
            </div>

            <p>{{ $emailTidakLulus->penutup }}</p>
            <p>{!! nl2br(e($emailTidakLulus->disediakan_oleh)) !!}</p>
        </div>
    </body>
</html>