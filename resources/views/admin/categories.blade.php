@extends('admin.layout')
@section('title', 'Categories')
@section('container')
	<div  class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
		<category-list  startpoint="{{url('admin/fetch/categories')}}"></category-list>
	</div>

@endsection