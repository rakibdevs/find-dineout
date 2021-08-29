@extends('admin.layout')
@section('title', 'Offers')
@section('container')
	<div  class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
		<offer-list  startpoint="{{url('admin/fetch/offers')}}"></offer-list>
	</div>

@endsection