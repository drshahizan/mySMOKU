
  <head>
  
  <!-- MAIN CSS -->
  <link rel="stylesheet" href="/assets/css/saringan.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
  
  </head>
      <!--begin::Page title-->
  <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
    <!--begin::Title-->
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Maklumat ESP</h1>
    <!--end::Title-->
    
  </div>
  <br>
  <!--end::Page title-->
  <div class="table-responsive">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
      <!--begin::Content container-->
      <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Card-->
        <div class="card">
          <!--begin::Card header-->
          <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
              <!--begin::Search-->
              <div class="d-flex align-items-center position-relative my-1">
                <i>
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
                
              </div>
              <!--end::Search-->
            </div>
            <!--begin::Card title-->
          </div>
          <!--end::Card header-->
          <!--begin::Card body-->
          <div class="card-body pt-0">
            <!--begin::Form-->
            <form class="form" action="http://bkokudev.mohe.gov.my/statusESP" method="post">
                
                <textarea name="data" id="data" rows="10" cols="50">              
{
    "nokp" : "930623015673",
    "id_permohonan" : "B/3/930623015673",
    "tarikh_transaksi" : "23/10/2023",
    "id_tuntutan" : "B/3/930623015673/1",
    "yuran_dibayar" : "800.70",
    "wang_saku_dibayar" : "999.30"
  },
  {
    "nokp" : "920623011673",
    "id_permohonan" : "B/2/920623011673",
    "tarikh_transaksi" : "23/10/2023",
    "id_tuntutan" : "B/2/920623011673/1",
    "yuran_dibayar" : "600.70",
    "wang_saku_dibayar" : "599.30"
  }
                   
                     
  
                  
                </textarea>
                <!--begin::action-->
                <div class="footer">
                  <!--begin::Button-->
                  <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                    <span class="indicator-label">Hantar</span>
                    
                  </button>
                  <!--end::Button-->
                </div>
                <!--end::action-->
            </form>
            <!--end::Form-->
          </div>
          <!--end::Card body-->
        </div>
        <!--end::Card-->	
      </div>
      <!--end::Content container-->
    </div>
    <!--end::Content-->
  </div>
  <script>
    fetch('http://bkokudev.mohe.gov.my/statusESP', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        data: JSON.parse(document.getElementById('data').value)
    })
})
.then(response => response.json())
.then(data => {
    console.log(data);
})
.catch(error => {
    console.error('Error:', error);
});

</script>