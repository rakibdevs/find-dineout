@extends('admin.layout')
@section('title', 'Restaurents')
@section('container')
	<div  class="px-6 py-4 mt-6 lg:mt-0 rounded shadow bg-white">
		<restaurent-edit :restaurent="{{$restaurent}}"></restaurent-edit>
	</div>

@endsection