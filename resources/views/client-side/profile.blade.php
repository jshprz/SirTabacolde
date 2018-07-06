@extends('index')
@push('after-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
@endpush
@section('content')
<div id="app">
	<profile-content>
	</profile-content>
</div>
@endsection
@push('after-scripts')
<script type="text/javascript" src="{{asset('js/profile.js')}}"></script>
@endpush