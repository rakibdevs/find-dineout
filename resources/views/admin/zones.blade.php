@extends('admin.layout')
@section('title', 'Zones')
@section('container')
	<div  class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
		<zones-list  startpoint="{{url('admin/fetch/zones')}}"></zones-list>
	</div>

@endsection