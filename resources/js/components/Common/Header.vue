<template>
	<nav class="header  bg-white shadow z-30 fixed top-0 w-full">
  		<div class="container mx-auto px-2 sm:px-4 lg:px-8">
    		<div class="flex justify-between h-16 md:h-18">
      			<div class="flex px-2 lg:px-0">
        			<div class="flex-shrink-0 flex items-center">
          				<a class="inline-flex items-center font-black font-display text-cool-indigo-800 text-xl" href="/">
          					<span class="ml-3 hidden xl:inline-block"> <span class="text-cool-indigo-600"> foodmoy </span></span>
          				</a>  
          				<div class="header-searchable-location mx-3">
          					<select v-model="selectedZone" class="mt-1 block w-full h-8 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
							    <option  value="">Select Location</option>
							    <option v-for="(zone, z) in zones" :key="z" :value="zone.name.toLowerCase()">{{zone.name}}</option>
							</select>
          				</div>      		
          			</div>
		        	<div class="hidden lg:ml-6 xl:ml-8 lg:flex lg:space-x-8">
						<!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
						<a class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" href="/">Home</a>
						<a class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" href="/restaurents">Restaurents</a>
						<a class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" href="/privacy-policy">Privacy Policy</a>
						<a class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" href="/blog">Blog</a>
		        	</div>
      			</div>
      			

      			<div class="flex items-center lg:hidden">
			        <!-- Mobile menu button -->
			        <button type="button" class="inline-flex items-center justify-center p-2 rounded-full text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cool-indigo-500" aria-controls="mobile-menu" aria-expanded="false" data-controller="toggle" data-toggle-remote="#mobile-menu" data-action="click->toggle#toggleRemote">
			          	<span class="sr-only">Open main menu</span>
			          	<svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" data-toggle-target="toggleable">
			            	<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
			          	</svg>
			 
			          	<svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" data-toggle-target="toggleable">
			            	<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
			          	</svg>
			        </button>
			    </div>
    		</div>
  		</div>

  		<!-- Mobile menu, show/hide based on menu state. -->
  		<div class="hidden lg:hidden" id="mobile-menu" data-controller="toggle" data-toggle-target="toggleable">
    		<div class="px-2 pt-2 pb-3">
				<a class="block px-3 py-2 rounded-xl text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" href="/">Home</a>
				<a class="block px-3 py-2 rounded-xl text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" href="/restaurents">Book a Table</a>
				<a class="block px-3 py-2 rounded-xl text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" href="/privacy-policy">Privacy Policy</a>
				<a class="block px-3 py-2 rounded-xl text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" href="/blog">Blog</a>
			</div> 
		</div>
	</nav>
</template>

<script>
	import queryString from 'query-string';
	export default{
		data(){
			return {
				zones:[],
				selectedZone: '',
			}
		},
		created(){
			this.checkQueryString()
			this.fetchZones()
		},
		methods:{
			checkQueryString(){
				let parsed = queryString.parse(location.search);
				this.selectedZone = parsed.location != undefined?parsed.location.toLowerCase():""
			},
			handleChange()
			{
			},
			fetchZones(){
				axios.get('/api/fetch/zones/').then(({data}) => {
	                this.zones = data;

	            });
			}
		}
	}

</script>