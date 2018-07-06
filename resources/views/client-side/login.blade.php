@extends('index')
@push('after-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
@endpush
@section('content')
<div id="app">
	<login-form>
	</login-form>
</div>

@endsection
@push('after-scripts')
<script type="text/javascript" src="{{asset('js/login.js')}}"></script>
@endpush