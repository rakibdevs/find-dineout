@extends('app')
@section('title','Restaurents')
@section('container')
	<div class="featured-restaurents">
		<div class="container mx-auto px-2 pt-5 sm:px-4 lg:px-8">
			<restaurent-filter start-point="{{ '/api/fetch/restaurents/' }}" type="{{'categories'}}" ></restaurent-filter>		
		</div>
	</div>
@endsection