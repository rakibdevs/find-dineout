@extends('admin.layout')
@section('title', 'Features')
@section('container')
	<div  class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
		<feature-list  startpoint="{{url('admin/fetch/features')}}"></feature-list>
	</div>

@endsection