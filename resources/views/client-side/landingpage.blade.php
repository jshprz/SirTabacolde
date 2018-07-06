@extends('index')
@push('after-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/landingpage.css')}}">
@endpush
@section('content')
<div id="app">
          <example-component>
          </example-component>
 </div>
@endsection

@push('after-scripts')
<script type="text/javascript" src="{{asset('js/landingpage.js')}}"></script>
@endpush