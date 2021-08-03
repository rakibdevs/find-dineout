@extends('admin.layout')
@section('title', 'Locations')
@section('container')
	<div  class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
		<location-list  startpoint="{{url('admin/fetch/locations')}}"></location-list>
	</div>
@endsection