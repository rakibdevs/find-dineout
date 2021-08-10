@extends('admin.layout')
@section('title', 'Restaurents')
@section('container')
	<div  class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
		<restaurent-list  startpoint="{{url('admin/fetch/restaurents')}}"></restaurent-list>
	</div>

@endsection