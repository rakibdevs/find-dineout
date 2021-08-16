<template>
	<div class="mt-3">
		<div class="grid grid-cols-4 gap-4">
			<div>
				<h4 class="bar-title">About</h4>
				<p>Foodmoy is lorem ipsum dolor sit amet for booking restaurents</p>
			</div>
			<div>
				<h4 class="bar-title">Top Cuisine</h4>
				<div class="footer-list-items">
					<a v-for="(item, index) in libCuisines" :href="item.public_uri" class="block">
						{{item.name}} 
						<span class="text-xs text-gray-500">({{item.restaurents_count}})</span>
					</a>
				</div>
			</div>
			<div>
				<h4 class="bar-title">Top Features</h4>
				<div class="footer-list-items">
					<a v-for="(item, index) in libFeatures" :href="item.public_uri" class="block">
						{{item.name}} 
						<span class="text-xs text-gray-500">({{item.restaurents_count}})</span>
					</a>
				</div>
			</div>
			<div>
				<h4 class="bar-title">Top Categories</h4>
				<div class="footer-list-items">
					<a v-for="(item, index) in libCategories" :href="item.public_uri" class="block">
						{{item.name}} 
						<span class="text-xs text-gray-500">({{item.restaurents_count}})</span>
					</a>
				</div>
			</div>
		</div>
		<div class="footer-section pt-3 pb-3 text-center">
			<div class="social-media flex justify-center">
				<a class=" mx-2 curson-pointer hover:text-red-600" href=""><i class="text-2xl lab la-facebook"></i></a>
				<a class=" mx-2 curson-pointer hover:text-red-600" href=""><i class="text-2xl lab la-instagram"></i></a>
				<a class=" mx-2 curson-pointer hover:text-red-600" href=""><i class="text-2xl lab la-twitter"></i></a>
				<a class=" mx-2 curson-pointer hover:text-red-600" href=""><i class="text-2xl lab la-youtube"></i></a>
			</div>
			<p class="my-2">
				© 2021, foodmoy. All Rights Reserved.
			</p>
		</div>
	</div>
</template>
<script>
	export default{
		 data () {
	        return {
	            libCuisines: [],
	            libCategories: [],
	            libFeatures: [],
	        }
    	},
    	created () {
	        this.fetchLibrary();
	    },
	    methods: {
			fetchLibrary(){
		        // fetch cuisine
		        if(this.ignore !='cuisine'){
		            axios.get('/api/fetch/cuisines').then(({data}) => {
		                this.libCuisines = data.slice(0,5);
		            });
		        }
		        // fetch cuisine
		        if(this.ignore !='category'){
		            axios.get('/api/fetch/categories').then(({data}) => {
		                this.libCategories = data.slice(0,5);
		            });
		        }
		        // fetch cuisine
		        if(this.ignore !='feature'){
		            axios.get('/api/fetch/features').then(({data}) => {
		                this.libFeatures = data.slice(0,5);
		            });
		        }
		    },
	    }
	}
</script>