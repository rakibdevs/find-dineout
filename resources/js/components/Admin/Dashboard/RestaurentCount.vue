<template>
	<div>
		<p class="bar-title mb-3">Top Restaurents</p>
		<div class="" v-if="!isLoading">
			<div v-for="(restaurent,index) in restaurents" :key="index" class="flex mb-2 w-full">
				<img :src="restaurent.cover_src" class="h-12 w-14 object-cover mr-2">
				<div class="flex justify-between w-full">
					<div>
						<a  :href="restaurent.public_uri"  class="font-bold mb-1 block">{{restaurent.name}}</a>
						<p class="mb-0 text-xs text-gray-700">
							<span class="text-green-600 text-xs">View:</span> {{restaurent.view}}
							<i class=" las la-map-marker"></i> 
							{{restaurent.location.name}}, {{restaurent.location.zone.name}}
						</p>
					</div>					
					<p class=" pr-2 text-xs"><i class="las la-calendar-check"></i><span class="inline-block w-8"> {{restaurent.bookings_count}}</span></p>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data(){
			return {
				restaurents: [],
				isLoading: false
			}
		},
		created () {
	        this.fetchTopRestaurents();
	    },
	    methods: {
	        fetchTopRestaurents ( ) {
	        	this.isLoading = true;
	            axios.get('/admin/fetch/top-restaurents').then(({data}) => {
	                this.restaurents = data;
	                this.isLoading = false;
	                
	            });
	        },
	    }
	}
</script>