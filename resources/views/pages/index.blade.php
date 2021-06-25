@extends('app')
@section('title','Home')
@section('container')
	<div class="header-layer">
		
	</div>

	<restaurent-list start-point="{{ '/fetch/restaurents/' }}"></restaurent-list>
@endsection