<table width="100%">
    <tr>
        <td>
            <h3>{{ $emailTidakLulus->subjek }}</h3>
        </td>
    </tr>
    <tr>
        <td>
            <p>{{ $emailTidakLulus->pendahuluan }}</p>
        </td>
    </tr>
    <tr>
        <td>
            <p>Tuan/Puan,</p>
        </td>
    </tr>
    <tr>
        <td>
            <p>2.<span style="margin-left: 30px;">{{ $emailTidakLulus->isi_kandungan1 }}</span></p>
            <ol style="list-style: lower-roman; padding-left: 30px;">
                @foreach ($catatanArray as $catatanItem)
                    <li>{{ $catatanItem }}</li>
                @endforeach
            </ol>
        </td>
    </tr>
    <tr>
        <td>
            <p>3.<span style="margin-left: 30px;">{{ $emailTidakLulus->isi_kandungan2 }}</span></p>
        </td>
    </tr>
    <tr>
        <td>
            <br>
            <p>{{ $emailTidakLulus->penutup }}</p>
        </td>
    </tr>
    <tr>
        <td>
            <br>
            <p>{!! nl2br(e($emailTidakLulus->disediakan_oleh)) !!}</p>
        </td>
    </tr>
</table>
    