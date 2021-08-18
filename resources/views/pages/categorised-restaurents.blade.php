@extends('app')
@section('title', $pageTitle)
@section('container')
	<div class="featured-restaurents">
		<div class="container mx-auto px-2 pt-5 sm:px-4 lg:px-8">
			<restaurent-filter start-point="{{ $fetchUrl}}" ignore="{{$type}}" findSlug="{{$slug}}"></restaurent-filter>
		</div>
	</div>
@endsection