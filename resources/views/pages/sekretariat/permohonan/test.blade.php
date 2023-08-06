
<!doctype html>
<html lang="en">

<head>
<title>Penyelaras IPT | Utama</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Bantuan Kewangan Pelajar Orang Kurang Upaya(OKU) Di Institusi Pengajian Tinggi (IPT)">
<meta name="author" content="Prototype Mockup">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/vendor/animate-css/vivify.min.css">

<link rel="stylesheet" href="assets/vendor/chartist/css/chartist.min.css">
<link rel="stylesheet" href="assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
<link rel="stylesheet" href="assets/vendor/c3/c3.min.css"/>
<link rel="stylesheet" href="assets/vendor/toastr/toastr.min.css">
<link rel="stylesheet" href="assets/vendor/jvectormap/jquery-jvectormap-2.0.3.min.css"/>

<link rel="stylesheet" href="assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>
<!-- MAIN CSS -->
<link rel="stylesheet" href="assets/css/mooli.min.css">

</head>
<body>
    
<div id="body" class="theme-cyan">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="assets/images/icon.svg" width="40" height="40" alt="Mooli"></div>
            <p>Please wait...</p>        
        </div>
    </div>

    <!-- Theme Setting -->
    <div class="themesetting">
        <a href="javascript:void(0);" class="theme_btn"><i class="fa fa-gear fa-spin"></i></a>
        <ul class="list-group">
            <li class="list-group-item">
                <ul class="choose-skin list-unstyled mb-0">
                    <li data-theme="green"><div class="green"></div></li>
                    <li data-theme="orange"><div class="orange"></div></li>
                    <li data-theme="blush"><div class="blush"></div></li>
                    <li data-theme="cyan" class="active"><div class="cyan"></div></li>
                    <li data-theme="timber"><div class="timber"></div></li>
                    <li data-theme="blue"><div class="blue"></div></li>
                    <li data-theme="amethyst"><div class="amethyst"></div></li>
                </ul>
            </li>
            <li class="list-group-item d-flex align-items-center justify-content-between">
                <span>Light Sidebar</span>
                <label class="switch sidebar_light">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </li>
            <li class="list-group-item d-flex align-items-center justify-content-between">
                <span>Gradient</span>
                <label class="switch gradient_mode">
                    <input type="checkbox" checked="">
                    <span class="slider round"></span>
                </label>
            </li>
            <li class="list-group-item d-flex align-items-center justify-content-between">
                <span>Dark Mode</span>
                <label class="switch dark_mode">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </li>
            <li class="list-group-item d-flex align-items-center justify-content-between">
                <span>RTL version</span>
                <label class="switch rtl_mode">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </li>
        </ul>
        <hr>
        <div>
            <a href="javascript:void(0);" class="btn btn-dark btn-block" target="_blank">Buy this item</a>
            <a href="javascript:void(0);" target="_blank" class="btn btn-primary theme-bg gradient btn-block">View Portfolio</a>
        </div>
    </div>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">

        <!-- Page top navbar -->
        <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-left">
                    <div class="navbar-btn">
                        <a href="index.html"><img src="assets/images/icon.svg" alt="Mooli Logo" class="img-fluid logo"></a>
                        <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-align-left"></i></button>
                    </div>
                    
                </div>
                <div class="navbar-right">
                    <div id="navbar-menu">
                        <ul class="nav navbar-nav">
                            
                            <li class="dropdown hidden-xs">
                                <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="notification-dot msg">4</span>
                                </a>

                            </li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="notification-dot info">4</span>
                                </a>
                                <ul class="dropdown-menu feeds_widget mt-0 animation-li-delay">
                                    <li class="header theme-bg gradient mt-0 text-light">You have 4 New Notifications</li>
                                    <li>
                                        <a href="#">
                                            <div class="mr-4"><i class="fa fa-check text-red"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">Issue Fixed <small class="float-right text-muted font-12">9:10 AM</small></h4>
                                                <small>WE have fix all Design bug with Responsive</small>
                                            </div>
                                        </a>
                                    </li>                               
                                    <li>
                                        <a href="#">
                                            <div class="mr-4"><i class="fa fa-user text-info"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-info">New User <small class="float-right text-muted font-12">9:15 AM</small></h4>
                                                <small>I feel great! Thanks team</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="mr-4"><i class="fa fa-question-circle text-warning"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-warning">Server Warning <small class="float-right text-muted font-12">9:17 AM</small></h4>
                                                <small>Your connection is not private</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="mr-4"><i class="fa fa-thumbs-o-up text-success"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-success">2 New Feedback <small class="float-right text-muted font-12">9:22 AM</small></h4>
                                                <small>It will give a smart finishing to your site</small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li><a href="javascript:void(0);" class="right_toggle icon-menu" title="Right Menu"><i class="fa fa-comments-o"></i></a></li>
                            <li class="hidden-xs"><a href="javascript:void(0);" id="btnFullscreen" class="icon-menu"><i class="fa fa-arrows-alt"></i></a></li>
                            <li><a href="page-login.html" class="icon-menu"><i class="fa fa-power-off"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="recent_searche" style="display: none;">
                    <div class="card mb-0">
                        <div class="header">
                            <h2>Recent search result</h2>
                            <ul class="header-dropdown dropdown">
                                <li><a href="javascript:void(0);">Clear data</a></li>
                                <li><a href="page-search-results.html"><i class="fa fa-external-link"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item p-l-0 p-r-0">
                                    <h6><a href="#">Crush it - Bootstrap Admin Application Template &amp; Ui Kit</a></h6>
                                    <p class="text-muted">It is a long established fact that a reader will be distracted.</p>
                                    <div class="text-muted font-13">
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><span class="badge badge-secondary margin-0">React</span></li>
                                            <li class="list-inline-item">Dec 27 2020</li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="list-group-item p-l-0 p-r-0">
                                    <h6><a href="#">Epic Pro - HR &amp; Project Management Admin Template and UI Kit</a></h6>
                                    <p class="text-muted">he point of using Lorem Ipsum is that it has a more-or-less English.</p>
                                    <div class="text-muted font-13">
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><span class="badge badge-success margin-0">HTML</span></li>
                                            <li class="list-inline-item">Oct 13 2020</li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="list-group-item p-l-0 p-r-0">
                                    <h6><a href="#">Qubes - Responsive Admin Dashboard Template</a></h6>
                                    <p class="text-muted">Commodo excepteur non ut aliqua ex qui velit sed esse consequat in </p>
                                    <div class="text-muted font-13">
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><span class="badge badge-danger margin-0">Bootstrap</span></li>
                                            <li class="list-inline-item">Sep 27 2020</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Main left sidebar menu -->
        <div id="left-sidebar" class="sidebar">
            <a href="#" class="menu_toggle"><i class="fa fa-angle-left"></i></a>
            <div class="navbar-brand">
                <a href="index.html"><img src="assets/images/icon.svg" alt="Mooli Logo" class="img-fluid logo"><span>Sistem BKOKU</span></a>
                <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="fa fa-close"></i></button>
            </div>
            <div class="sidebar-scroll">
                <div class="user-account">
                    <div class="user_div">
                        <img src="assets/images/hr2.png" class="user-photo" alt="User Profile Picture">
                    </div>
                    <div class="dropdown">
                        <span>Penyelaras BKOKU IPT,</span>
                        <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>Julia Binti Syamsul</strong></a>
                        <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                            <!--<li><a href="page-profile.html"><i class="fa fa-user"></i>My Profile</a></li>-->
                            <li><a href="app-inbox.html"><i class="fa fa-envelope"></i>Messages</a></li>
                            <li><a href="setting.html"><i class="fa fa-gear"></i>Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="page-login.html"><i class="fa fa-power-off"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>  
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul id="main-menu" class="metismenu animation-li-delay">
                        <li class="header">Main</li>
                        <li><a href="index.html"><i class="fa fa-dashboard"></i> <span>Utama</span></a></li>
                        <li class="header">Permohonan</li>
                        <li><a href="status-mohon-bkoku.html"><i class="fa fa-tasks"></i> <span>Status Permohonan BKOKU</span></a></li>
                        <!--<li><a href="status-mohon-ppk.html"><i class="fa fa-tasks"></i> <span>Status Permohonan PPK</span></a></li>-->
                        <li><a href="mohon-baru.html"><i class="fa fa-folder"></i> <span>Permohonan Baru</span></a></li>
                        <li class="active"><a href="pembaharuan-mohon.html"><i class="fa fa-address-book"></i> <span>Pembaharuan Permohonan</span></a></li>     
                        <li><a href="kptsn-mohon.html"><i class="fa fa-list-alt"></i> <span>Keputusan Permohonan</span></a></li>              
                        <li class="header">Tuntutan</li>
                        <li ><a href="status-tuntut.html"><i class="fa fa-money"></i> <span>Status Tuntutan</span></a></li>
                        <li><a href="tuntut-baru.html"><i class="fa fa-folder"></i> <span>Tuntutan Baru</span></a></li>
                        <li><a href="kptsn-tuntut.html"><i class="fa fa-list-alt"></i> <span>Keputusan Tuntutan</span></a></li>
                        <li class="header">Laporan</li>
                        <li><a href="laporan-mohon.html"><i class="fa fa-file"></i> <span>Laporan Permohonan</span></a></li>
                        <li><a href="laporan-tuntut.html"><i class="fa fa-file-text"></i> <span>Laporan Tuntutan</span></a></li>    
                    </ul>
                </nav>      
            </div>
        </div>
        <!-- Right bar chat  -->
        <div id="rightbar" class="rightbar">
            <div class="slim_scroll">
                <div class="chat_list">
                    <form>
                        <div class="input-group c_input_group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-magnifier"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                    <div class="body">
                        <ul class="nav nav-tabs3 white mt-3 d-flex text-center">
                            <li class="nav-item flex-fill"><a class="nav-link active show" data-toggle="tab" href="#chat-Users">Chat</a></li>
                            <li class="nav-item flex-fill"><a class="nav-link" data-toggle="tab" href="#chat-Groups">Groups</a></li>
                            <li class="nav-item flex-fill"><a class="nav-link mr-0" data-toggle="tab" href="#chat-Contact">Contact</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane vivify fadeIn active show" id="chat-Users">
                                <ul class="right_chat list-unstyled mb-0 animation-li-delay">
                                    <li class="online">
                                        <a href="javascript:void(0);" class="media">
                                            <img class="media-object" src="assets/images/xs/avatar4.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Louis Henry <small class="text-muted font-12">10 min</small></span>
                                                <span class="message">How do you do?</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="online">
                                        <a href="javascript:void(0);" class="media">
                                            <img class="media-object " src="assets/images/xs/avatar5.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Debra Stewart <small class="text-muted font-12">15 min</small></span>
                                                <span class="message">I was wondering...</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="offline">
                                        <a href="javascript:void(0);" class="media">
                                            <img class="media-object " src="assets/images/xs/avatar2.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Lisa Garett <small class="text-muted font-12">18 min</small></span>
                                                <span class="message">I've forgotten how it felt before</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="offline">
                                        <a href="javascript:void(0);" class="media">
                                            <img class="media-object " src="assets/images/xs/avatar1.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Folisise Chosielie <small class="text-muted font-12">23 min</small></span>
                                                <span class="message">Wasup for the third time like...</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="online">
                                        <a href="javascript:void(0);" class="media">
                                            <img class="media-object " src="assets/images/xs/avatar3.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Marshall Nichols <small class="text-muted font-12">27 min</small></span>
                                                <span class="message">But we’re probably gonna need a new carpet.</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="online">
                                        <a href="javascript:void(0);" class="media">
                                            <img class="media-object " src="assets/images/xs/avatar5.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Debra Stewart <small class="text-muted font-12">38 min</small></span>
                                                <span class="message">It’s not that bad...</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="offline">
                                        <a href="javascript:void(0);" class="media">
                                            <img class="media-object " src="assets/images/xs/avatar2.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Lisa Garett <small class="text-muted font-12">45 min</small></span>
                                                <span class="message">How do you do?</span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <!-- Stiky note div  -->
        <div class="sticky-note">
            <a href="javascript:void(0);" class="right_note"><i class="fa fa-close"></i></a>
            <div class="form-group c_form_group">
                <label>Write your note here</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter here...">
                    <div class="input-group-append"><button class="btn btn-dark btn-sm" type="button">Add</button></div>
                </div>
            </div>
            <div class="note-body">
                <div class="card note-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="font-10 text-muted">12 Apr 2020</span>
                        </div>
                        <div>
                            <a href="javascript:void(0);" class="star"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0);" class="delete"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                    <div class="note-detail">
                        <span>Commit code on github branch development</span>
                    </div>
                </div>
                <div class="card note-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="font-10 text-muted">12 Apr 2020</span>
                        </div>
                        <div>
                            <a href="javascript:void(0);" class="star active"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0);" class="delete"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                    <div class="note-detail">
                        <span>Meeting with client for new project.</span>
                    </div>
                </div>
                <div class="card note-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="font-10 text-muted">12 Apr 2020</span>
                        </div>
                        <div>
                            <a href="javascript:void(0);" class="star"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0);" class="delete"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                    <div class="note-detail">
                        <span>making this the first true generator on the Internet</span>
                    </div>
                </div>
                <div class="card note-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="font-10 text-muted">12 Apr 2020</span>
                        </div>
                        <div>
                            <a href="javascript:void(0);" class="star"><i class="fa fa-star-o"></i></a>
                            <a href="javascript:void(0);" class="delete"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                    <div class="note-detail">
                        <span>it look like readable English. Many desktop publishing</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <!-- Page header section  -->
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <h1>Pembaharuan Permohonan</h1>
                          
                        </div>
                    </div>
                    <br>
                    <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2>Jumlah Keseluruhan Permohonan</h2>
                            </div>
                            <div class="body">
                                <div id="chart-pie" style="height: 380px"></div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2>Jumlah Keseluruhan Permohonan Terkini</h2>
                                <!--<small class="text-muted">Sales Performance for Online and Offline Revenue <a href="">Learn more</a></small>-->
                                <ul class="header-dropdown dropdown">
                                    <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                        <ul class="dropdown-menu theme-bg gradient">
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-eye"></i> View Details</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-share-alt"></i> Share</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-copy"></i> Copy to</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-folder"></i> Move to</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-edit"></i> Rename</a></li>
                                            <li><a href="javascript:void(0);"><i class="dropdown-icon fa fa-trash"></i> Delete</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="d-flex flex-row">
                                    <div class="pb-3">
                                        <h5 class="mb-0">50</h5>
                                        <small class="text-muted font-11">Jumlah Didaftarkan</small>
                                    </div>
                                    <div class="pb-3 pl-4 pr-4">
                                        <h5 class="mb-0">45</h5>
                                        <small class="text-muted font-11">Permohonan Aktif</small>
                                    </div>
                                    <div class="pb-3">
                                        <h5 class="mb-0">48</h5>
                                        <small class="text-muted font-11">Permohonan Tidak Aktif</small>
                                    </div>
                                    <div class="ml-auto">
                                        <select class="form-control">
                                            <option selected="selected">Bulan</option>
                                            <option>Hari</option>
                                            <option>Tahun</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="bar-chart" style="height: 300px"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light page_menu">
                            <!--<a class="navbar-brand" href="#">M.</a>-->
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars text-muted"></i>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item vivify swoopInTop delay-150 active"><a class="nav-link" href="">Senarai Keseluruhan Permohonan</a></li>
                                   
                                </ul>
                               
                            </div>
                        </nav>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="body">
                                <div class="table-responsive invoice_list">
                                    <table class="table table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr> 
                                                <th style="width: 20px;">Bil</th>
                                                <th>Nama Pelajar</th>
                                                <th style="width: 80px;">ID Permohonan</th>
                                                <th style="width: 80px;">Tarikh Lulus Permohonan</th>
                                                <th style="width: 80px;">Tarikh Akhir Pengajian</th>
                                                <th style="width: 80px;">Status Permohonan</th>
                                                <th style="width: 80px;">Status Perbaharui Permohonan</th>
                                                <th style="width: 80px;">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span>01</span>
                                                </td>
                                                <td>
                                                    <span>Ali Bin Abu</span>                                              
                                                </td>
                                                <td>SARJANABKOKU000011</td>
                                                <td>6/7/2023</td>
                                                <td>8/7/2027</td>
                                                <td>Aktif</td>
                                                <td> <button type="button" class="btn btn-info ">Belum Perbaharui</button></td>
                                                <td>
                                                    <a href="baharui-Ali.html" class="btn btn-warning btn-round"><i class="icon-plus"></i> Perbaharui</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span>02</span>
                                                </td>
                                                <td>
                                                    <span>Zoe Baker</span>
                                                        
                                                           
                                                                                          
                                                </td>
                                                <td>DIPLOMABKOKU002011</td>
                                                <td>5/7/2022</td>
                                                <td>4/7/2023</td>
                                                <td>Tidak Aktif</td>
                                                <td> <button type="button" class="btn btn-danger ">Tamat</button></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger ">Tamat</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span>03</span>
                                                </td>
                                                <td>   
                                                    <span>Sarah Binti Hashim</span>                                  
                                                                                              
                                                </td>
                                                <td>PHDBKOKU202011</td>
                                                <td>3/7/2021</td>
                                                <td>4/7/2024</td>
                                                <td> Aktif</td>
                                                <td> <button type="button" class="btn btn-default ">Edit</button></td>
                                                <td>
                                                    <a href="baharui-sarah.html" class="btn btn-primary btn-round"><i class="icon-pencil"></i> Edit</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span>04</span>
                                                </td>
                                                <td>
                                                    <span>Akmal Bin Mahmod</span>   
                                                  
                                                          
                                                </td>
                                                <td>SARJANABKOKU12011</td>
                                                <td>1/6/2022</td>
                                                <td>4/7/2024</td>
                                                <td> Aktif</td>
                                                <td> <button type="button" class="btn btn-success ">Telah Dihantar</button></td>
                                                <td>
                                                    <a href="permohonan-baharui.html" class="btn btn-success"><i class="icon-check"></i> Menunggu Keputusan</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- Javascript -->
<script src="assets/bundles/libscripts.bundle.js"></script>    
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<!-- Vedor js file and create bundle with grunt  --> 
<script src="assets/bundles/flotscripts.bundle.js"></script><!-- flot charts Plugin Js -->
<script src="assets/bundles/c3.bundle.js"></script>
<script src="assets/bundles/apexcharts.bundle.js"></script>
<script src="assets/bundles/jvectormap.bundle.js"></script>
<script src="assets/vendor/toastr/toastr.js"></script>
<script src="assets/bundles/chartist.bundle.js"></script>
<!-- Project core js file minify with grunt --> 
<script src="assets/bundles/mainscripts.bundle.js"></script>




<!-- Vedor js file and create bundle with grunt  --> 

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js --> 

<script src="../js/pages/forms/form-wizard.js"></script>
<script src="../js/pages/tables/jquery-datatable.js"></script>
<script src="../js/pages/charts/c3.js"></script>
<script src="../js/pages/charts/chartjs.js"></script>
</body>
</html>
