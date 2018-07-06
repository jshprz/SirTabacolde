@extends('index')

@push('after-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/registration.css')}}">
<link href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css' rel="stylesheet" type="text/css">
@endpush
@section('content')
<div id="app">
	<registration-form>
	</registration-form>
</div>

@endsection
@push('after-scripts')

<script type="text/javascript" src="{{asset('js/registration.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endpush