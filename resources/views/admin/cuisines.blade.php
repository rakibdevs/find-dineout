@extends('admin.layout')
@section('title', 'Cuisines')
@section('container')
	<div  class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
		<cuisine-list  startpoint="{{url('admin/fetch/cuisines')}}"></cuisine-list>
	</div>

@endsection