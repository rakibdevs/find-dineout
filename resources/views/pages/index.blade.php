@extends('app')
@section('title','Home | FoodMoy')
@section('container')
	<div class="header-layer">
		
	</div>
	<div class="container mx-auto px-2 mt-10 sm:px-4 lg:px-8">
		<offers start-point="{{ '/fetch/offers/' }}"></offers>
	</div>
	<div class="featured-restaurents">
		<div class="container mx-auto px-2 pt-5 sm:px-4 lg:px-8">
			<h4 class="bar-title mb-3">Find the best dine in your location</h4>
			<restaurent-list start-point="{{ '/fetch/restaurents/' }}"></restaurent-list>
		</div>
	</div>
@endsection