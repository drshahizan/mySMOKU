<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! printHtmlAttributes('html') !!}>
<!--begin::Head-->
<head>
    <title>{{ config('app.name', 'SistemBKOKU') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:type" content="article"/>
    <link rel="stylesheet" href="/assets/css/style.bundle.css">
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
</head>
<style>
    .nav, h3{
        margin: 10px!important;
    }
    body{
        margin: 10px;
    }
    .border{
        border: 1px solid black!important;
    }
</style>
    <body>
        <h3>Keputusan Peperiksaan Mengikut Sesi/Semester</h3>
         
        <div class="border">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($peperiksaan as $item)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="exam-tab-{{$item->id}}" data-toggle="tab" data-target="#exam-{{$item->id}}" type="button" role="tab" aria-controls="exam-{{$item->id}}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{$item->sesi}}-0{{$item->semester}}
                    </button>
                </li>
                @endforeach
            </ul>
        
            <div class="tab-content" id="myTabContent">
                @foreach($peperiksaan as $item)
                    @if($item->kepPeperiksaan)
                         <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="exam-{{$item->id}}" role="tabpanel" aria-labelledby="exam-tab-{{$item->id}}">
                            <div style="text-align: center">
                                <embed src="/assets/dokumen/peperiksaan/{{$item['kepPeperiksaan']}}#zoom=90" width="70%" height="605px"/>
                            </div>
                        </div>
                    @else
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="exam-{{$item->id}}" role="tabpanel" aria-labelledby="exam-tab-{{$item->id}}">
                            <div style="text-align: center; color: red;">
                                <p>-</p>
                            </div>
                        </div>
                    @endif    
                    
                @endforeach
            </div>
        </div>
    </body>
</html>
