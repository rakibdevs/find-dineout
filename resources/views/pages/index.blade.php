@extends('app')
@section('title','Home')
@section('container')
	<div class="header-layer">
		
	</div>
	<div class="container mx-auto px-2 mt-10 sm:px-4 lg:px-8">
		<restaurent-list start-point="{{ '/fetch/restaurents/' }}"></restaurent-list>
	</div>
@endsection