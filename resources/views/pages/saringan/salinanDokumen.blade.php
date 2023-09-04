<x-default-layout><body>
    <br>
    <h3>Salinan Dokumen Pemohon</h3>
    <br>
    @php
      $str = $permohonan->id_permohonan;
      $id_permohonan = str_replace('/', '-', $str);
      $suratTawaran = "/assets/dokumen/permohonan/salinan_suratTawaran_".$id_permohonan.".pdf";
      $akaunBankIslam = "/assets/dokumen/permohonan/salinan_akaunBankIslam_".$id_permohonan.".pdf";
      $keputusanPeperiksaan = "/assets/dokumen/permohonan/salinan_keputusanPeperiksaan_".$id_permohonan.".pdf";
      $invoisResit = "/assets/dokumen/permohonan/salinan_invoisResit_".$id_permohonan.".pdf";
      $maklumatBankIPT = "/assets/dokumen/permohonan/salinan_maklumatBankIPT_".$id_permohonan.".pdf";
    @endphp
<!--begin::Accordion-->
<div class="accordion" id="accordionPanelsStayOpenExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
          <b style="color: black!important">Surat Tawaran</b> 
        </button>
      </h2>
      <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
        <div class="accordion-body" style="text-align: center">
            <embed src="{{$suratTawaran}}" width="90%" height="650px"/>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
          <b style="color: black!important">No. Akaun Bank Islam</b> 
        </button>
      </h2>
      <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
        <div class="accordion-body" style="text-align: center">
            <embed src="{{$suratTawaran}}" width="90%" height="650px"/>
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
          <b style="color: black!important">Keputusan Peperiksaan</b> 
        </button>
      </h2>
      <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
        <div class="accordion-body" style="text-align: center">
            <embed src="{{$suratTawaran}}" width="90%" height="650px"/>
        </div>
      </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingFour">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
            <b style="color: black!important">Invois/Resit</b> 
          </button>
        </h2>
        <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
          <div class="accordion-body" style="text-align: center">
            <embed src="{{$suratTawaran}}" width="90%" height="650px"/>
          </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingFive">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
            <b style="color: black!important">Maklumat Bank IPTA/IPTS/Kolej Komuniti/Politeknik Atau Pengesahan Semester Pengajian</b> 
          </button>
        </h2>
        <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFive">
          <div class="accordion-body" style="text-align: center">
            <embed src="{{$suratTawaran}}" width="90%" height="650px"/>
          </div>
        </div>
    </div>
</div>
<!--end::Accordion-->
</x-default-layout>