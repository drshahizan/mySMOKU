<x-default-layout>
  <body>
    <br>
    <h3>Salinan Dokumen SPPB</h3>
    <br>
    <!--begin::Accordion-->
    <div class="accordion" id="accordionPanelsStayOpenExample">
        @php $i=1; $n=1;@endphp
        @foreach($dokumen as $item)
            @php
              $dokumen_path = "/assets/dokumen/permohonan/".$item['dokumen'];
              if ($item['id_dokumen'] == $n){
                $dokumen_name = "SPPB" . $n;
                $n++;
              }

              $i++;
            @endphp
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-heading{{$i}}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$i}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse{{$i}}">
                            <b style="color: black!important">{{$dokumen_name}}</b>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{$i}}">
                        <div class="accordion-body" style="text-align: center">
                            <p>Catatan: {{$item['catatan']}}</p>
                            <embed src="{{$dokumen_path}}" width="90%" height="650px"/>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
    <!--end::Accordion-->
  </body>
</x-default-layout>





