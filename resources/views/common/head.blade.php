<!DOCTYPE html>
<html class="js csstransforms csstransforms3d csstransitions" lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Metas For sharing property in social media -->
    <meta property="og:url"                content="{{ @$shareLink }}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ @$title }}" />
    <meta property="og:description"        content="{{ @$result->property_description->summary }}" />
    <meta property="og:image"              content="{{ url('public/images/property/'.@$property_id.'/'.@$property_photos[0]->photo) }}" />
    

    @if (!empty($favicon))
        <link rel="shortcut icon" href="{{ $favicon }}">
    @endif


    <title>{{ $title or Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'title') }} {{ $additional_title or '' }} </title>
    
    <meta property="og:image" content="">
    <meta name="mobile-web-app-capable" content="yes">

    <link href="{{ url('public/front/css/css.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/front/css/glyphicon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/front/css/awsome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/front/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/front/css/cs-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/front/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/front/css/styles.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ url('public/front/js/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/front/js/ninja/ninja-slider.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/front/css/bootstrap-slider.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/front/css/jquery.sidr.dark.css') }}" rel="stylesheet" type="text/css" />
    <!-- AnythingSlider -->
    <link rel="stylesheet" type="text/css" href="{{url('public/front/anything/css/anythingslider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/front/anything/css/theme-metallic.css') }}">
    <link rel="stylesheet" type="text/css" href="{{url('public/front/anything/css/theme-minimalist-round.css') }}">
    <link rel="stylesheet" type="text/css" href="{{url('public/front/anything/css/theme-minimalist-square.css') }}">
    <link rel="stylesheet" type="text/css" href="{{url('public/front/anything/css/theme-construction.css') }}">
    <link rel="stylesheet" type="text/css" href="{{url('public/front/anything/css/theme-cs-portfolio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/front/plugins/intl-tel-input-13.0.0/build/css/intlTelInput.css')}}">

    <style type="text/css">

      label.error {
        color:red !important;
      }

      .error-tag {
        color:red !important;
        font-weight: bold !important;
        font-size: 13px !important;
      }

      .errorTxt_p{
        color: red !important;
        font-weight: bold !important;
        font-size: 14px !important;
      }

  </style>

  </head>
  <body>
