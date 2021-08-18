@extends('app')
@section('title', 'Restaurents')
@section('container')
	<div class="container mx-auto px-2 pt-5 sm:px-4 lg:px-8">
		<restaurent :restaurent="{{$restaurent}}"></restaurent>
	</div>

@endsection