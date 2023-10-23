
  <head>
  
  <!-- MAIN CSS -->
  <link rel="stylesheet" href="/assets/css/saringan.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
  
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
            <form class="form" action="http://espbstg.mohe.gov.my/api/studentsStatus.php" method="post">
              @csrf
                
                <textarea name="data" id="data" rows="10" cols="50">
[
  {
    "noic": "950623031212",
    "id_permohonan": "B/2/950623031212",
    "id_tuntutan": ""
  }
]
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
