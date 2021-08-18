@extends('admin.layout')
@section('title', 'Bookings')
@section('container')
	<div  class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
		<booking-list  startpoint="{{url('admin/fetch/bookings')}}"></booking-list>
	</div>

@endsection