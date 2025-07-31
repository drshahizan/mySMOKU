 <x-default-layout><body>
    <br>
    <h3>Salinan Dokumen Pemohon</h3>
    <br>
    <!--begin::Accordion-->
    <div class="accordion" id="accordionPanelsStayOpenExample">
        @php
            $i = 1; $n = 1;
        @endphp
        @foreach($dokumen as $item)
            @php
                $dokumen_path = "/assets/dokumen/permohonan/" . $item['dokumen'];
                $ext = pathinfo($dokumen_path, PATHINFO_EXTENSION);

                if ($item['id_dokumen'] == 1) {
                    $dokumen_name = "No. Akaun Bank Islam";
                } elseif ($item['id_dokumen'] == 2) {
                    $dokumen_name = "Surat Tawaran";
                } elseif ($item['id_dokumen'] == 3) {
                    $dokumen_name = "Invois/Resit";
                } elseif ($item['id_dokumen'] == 4) {
                    $dokumen_name = "Dokumen Tambahan " . $n;
                    $n++;
                }

                $i++;
            @endphp

            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-heading{{$i}}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$i}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{$i}}">
                        <b style="color: black!important">{{ $dokumen_name }}</b>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{$i}}">
                    <div class="accordion-body" style="text-align: center">
                        <p>Catatan: {{ $item['catatan'] }}</p>

                        @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif']))
                            <a href="{{ $dokumen_path }}" download>
                                <img src="{{ $dokumen_path }}" style="max-width: 50%; height: auto; cursor: pointer;" alt="Dokumen Gambar">
                            </a>
                        @else
                            <embed src="{{ $dokumen_path }}" width="100%" height="650px" type="application/pdf"/>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <!--end::Accordion-->
</x-default-layout>





