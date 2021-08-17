<template>
	<nav class="header flex  bg-white shadow z-30 fixed top-0 w-full">
  		<div class="container m-auto px-2 sm:px-4 lg:px-8">
    		<div class="flex justify-between h-14 md:h-18">
      			<div class="flex px-2 lg:px-0">
        			<div class="flex-shrink-0 flex items-center">
          				<a class="inline-flex items-center font-black font-display text-cool-indigo-800 text-xl" href="/">
          					<span class="ml-3 hidden xl:inline-block"> <span class="text-indigo-600"> foodmoy </span></span>
          				</a>  
          				     		
          			</div>
      			</div>
	        	<div class="hidden lg:ml-6 xl:ml-8 lg:flex lg:space-x-8 nav-menu">
					<!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
					<a class="border-transparent text-gray-900 hover:border-red-300 hover:text-red-700 inline-flex items-center px-1 pt-1 border-b-2 text-base font-medium active" href="/">Home</a>
					<a class="border-transparent text-gray-900 hover:border-red-300 hover:text-red-700 inline-flex items-center px-1 pt-1 border-b-2 text-base font-medium" href="/restaurents">Find Restaurents</a>
					<a class="border-transparent text-gray-900 hover:border-red-300 hover:text-red-700 inline-flex items-center px-1 pt-1 border-b-2 text-base font-medium" href="/privacy-policy">Privacy Policy</a>
					<!-- <a class="border-transparent text-gray-900 hover:border-red-300 hover:text-red-700 inline-flex items-center px-1 pt-1 border-b-2 text-base font-medium" href="/blog">Blog</a> -->
	        	</div>
      			

      			<div class="flex items-center justify-right ">

      				<div class="location-search mr-3 relative">
						<div class="relative">
							<i class="las la-map-marker-alt absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
							<input type="text" class="block w-full pl-6 h-8 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:outline-none"  placeholder="search a location" v-model="keyword" @keyup="fetchLocations">
						</div>
						<div v-if="fetch" class="location-results absolute top-8 bg-white w-full rounded">
							<ul v-if="locations.length > 0" class="p-3">
								<li class="cursor-pointer mb-2 leading-4" v-for="(location, z) in locations" :key="z" @click="setLocation(location.name)">
									{{location.name}}, 
									<span class="font-medium">{{location.zone.name}}</span><br>
									<span v-if="location.restaurents_count > 0" class="text-xs text-gray-500">{{location.restaurents_count}} restaurents found</span>
								</li>
							</ul>
							<p v-else>No results found</p>
							
						</div>
					</div>

      				<a href="/login" class=" px-3 py-1 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Login</a>
			    </div>
    		</div>
  		</div>

  		<!-- Mobile menu, show/hide based on menu state. -->
  		<div class="hidden lg:hidden" id="mobile-menu" data-controller="toggle" data-toggle-target="toggleable">
    		<div class="px-2 pt-2 pb-3">
				<a class="block px-3 py-2 rounded-xl text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" href="/">Home</a>
				<a class="block px-3 py-2 rounded-xl text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" href="/restaurents">Book a Table</a>
				<a class="block px-3 py-2 rounded-xl text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" href="/privacy-policy">Privacy Policy</a>
				<!-- <a class="block px-3 py-2 rounded-xl text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" href="/blog">Blog</a> -->
			</div> 
		</div>
	</nav>
</template>

<script>
	import queryString from 'query-string';
	export default{
		data(){
			return {
				keyword:'',
				locations:[],
				selectedLocation: '',
				fetch: false
			}
		},
		created(){
			this.getCurrentLocation()
		},
		methods:{
			getCurrentLocation(){
				this.keyword = localStorage.getItem('current_location')
			},
			setLocation(current_location){
				localStorage.setItem('current_location', current_location)
				window.location.reload()
			},
			fetchLocations(){
	            if(this.keyword != ''){
					this.fetch = true;
					axios.get('/api/fetch/locations?keyword='+this.keyword).then(({data}) => {
		                this.locations = data;
		            });
	            }else{
	            	this.fetch = false;
	            	this.locations = [];
	            }

			}
		}
	}

</script>