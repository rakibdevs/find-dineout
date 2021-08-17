@extends('app')
@section('title','Home')
@section('class','home')
@section('container')
	<div class="header-layer h-screen  text-white">
		<div class="relative h-full w-full top-52">
			<div class="container custom-shadow  mx-auto px-2 mt-10 sm:px-4 lg:px-8">
				<h1 class="banner-text font-bold w-auto">Find<br>........ Restaurents <br> in your town</h1>
				<div class="mt-4">
					<input type="text" class="form-control focus:outline-none rounded text-white   placeholder-white" placeholder="Search for restaurent, cuisines, location">
				</div>
			</div>
		</div>
	</div>
	<div class="container mx-auto px-2 mt-10 sm:px-4 lg:px-8">
		<offers start-point="{{ url('/api/fetch/offers/') }}"></offers>
	</div>
	<div class="featured-restaurents">
		<div class="container mx-auto px-2 pt-5 sm:px-4 lg:px-8">
			<h1 class="font-bold text-xl mb-3">Recommend to try</h1>
			<restaurents start-point="{{ url('/api/fetch/restaurents/') }}" show="4"></restaurents>
		</div>
	</div>
	<div class="bg-white">
		<div class="container mx-auto px-2 mt-10 sm:px-4 lg:px-8">
			<div class="flex items-center flex-wrap mb-20">
		        <div class="w-3/4 md:w-1/2">
		          <img class="h-300px w-300px object-fit mx-auto" 
		            src="{{asset('images/reservation.jpg')}}"
		            alt=""
		          />
		        </div>
		        <div class="w-1/4 md:w-1/2 pl-10">
		          <h4 class="text-3xl text-gray-800 font-bold mb-3">
		            Lorem Ipsum Dolor <br>
		            sit amet, consectetur adipiscing elit.
		          </h4>
		          <p class="text-gray-600 mb-8 pr-10">
		            Lorem ipsum dolor  Sed eu metus et velit tristique congue nec at enim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas tincidunt sed augue et imperdiet. Nam blandit tortor id nulla maximus, in consequat lorem ullamcorper. Vivamus venenatis viverra velit nec fermentum.
		          </p>
		        </div>
		    </div>
		    <div class="flex justify-center">
				<img class="w-400px mx-auto" src="{{asset('images/dotted-arrow-right.svg')}}"/>
		    </div>
			<div class="flex items-center flex-wrap mb-20">
				<div class="w-1/4 md:w-1/2 ">
		          <h4 class="text-3xl text-gray-800 font-bold mb-3 pl-10">
		            Lorem Ipsum Dolor <br>
		            sit amet, consectetur adipiscing elit.
		          </h4>
		          <p class="text-gray-600 mb-8 pl-10">
		            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu metus et velit tristique congue nec at enim. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas tincidunt sed augue et imperdiet. Nam blandit tortor id nulla maximus, in consequat lorem ullamcorper. Vivamus venenatis viverra velit nec fermentum.
		          </p>
		        </div>
		        <div class="w-3/4 md:w-1/2 pl-10">
		          <img class="h-300px w-300px object-fit mx-auto" 
		            src="{{asset('images/restaurent.png')}}"
		            alt=""
		          />
		        </div>
		        
		    </div>
		    
		</div>
	</div>
@endsection