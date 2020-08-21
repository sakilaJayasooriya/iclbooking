<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> {{ @SITE_NAME }} | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/dist/css/AdminLTE.css">
  <!-- Custom css -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/dist/css/custom.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/dist/css/skins/_all-skins.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!--datatable style-->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/plugins/datatables/jquery.dataTables.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/plugins/DataTables-1.10.18/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/plugins/Responsive-2.2.2/css/responsive.dataTables.min.css">
  {{-- <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/dist/css/jquery.dataTables.min.css"> --}}
{{--   <link rel="stylesheet" href="{{URL::to('/')}}/public/backend/dist/css/dataTables.bootstrap.css"> --}}
  {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"> --}}
    <!--Select2-->
  <link rel="stylesheet" type="text/css" href="{{ asset('public/front/plugins/intl-tel-input-13.0.0/build/css/intlTelInput.css')}}">  
  <link href="{{ url('public/backend/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ url('public/backend/css/style2.css') }}" rel="stylesheet" type="text/css" /> 
  <link href="{{ url('public/backend/css/style.css') }}" rel="stylesheet" type="text/css" /> 
 

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
 

  <style type="text/css">
    tr.strikeout td:before {
      content: " ";
      position: absolute;
      display: inline-block;
      padding: 5px 10px;
      left:0;
      margin-left:20px;
      border-bottom: 1px solid black;
      width:82%;

    }
      .select2Custom{
        color: #000 !important;
      }

      label.error{
        color:red !important;
      }

      /*For datatables export button and length style*/
      #dataTableBuilder_length{
        margin-top:5px; 
        margin-left: 5px;
        float: left;          
      }
      #dataTableBuilder_length select{
        width: 45px;
        height: 34px;
        border: 1px solid #ccc;
        float: left;
      }
      #dataTableBuilder_length label {
       
        display:inline;
        margin-left: 15px;
      }
    

      @media only screen and (min-width: 420px) and (max-width: 570px){
        #exportArea{
          float: right;
        }      
      }

      @media only screen and (min-width: 320px) and (max-width: 420px){
          #exportArea{         
            float: right;
          }
      }

    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
      padding: 8px 8px 8px 8px !important;
    }

    .fixedScrollBox {
        position:fixed;
        top:50%;
        width:100%;
        z-index:100;
        left: 50%;
        right: 50%;
        bottom: 50%;
      
    }

     @media only screen and (min-width: 320px) and (max-width: 420px){
          .fixedScrollBox {
            position:fixed;
            top:50%;
            width:100%;
            z-index:100;
            left: 20%;
            right: 50%;
            bottom: 50%;
          
        }
      }



  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">