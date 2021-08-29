<template>
	<div class="grid sm:grid-cols-1 md:grid-cols-7 gap-4">
		<div class="md:col-span-5">
			
			<div class="restnt-single-item restaurant mb-3">
				<div class="restnt-main-wrap bg-white rounded my-2 ">
					<div class="img-wrap">
						<div class="img cursor restaurent-cover">
							<img :src="restaurent.cover_src">
						</div>
					</div>
					<div class="restnt-detail-wrap p-4">
						<div class="restaurant-info-section restnt-detail" >
							<div class="restnt-info cursor " >
								<h3 class="font-bold text-xl">{{restaurent.name}}</h3>

							</div>
							<div class="detail-info">
								<ul>
									<li>
										<span class="double-line-ellipsis">
											<span>৳ {{restaurent.approx_cost}} for 2 </span>
											<span> | </span>
											<span v-if="restaurent.cuisines">
												<a v-for="(cuisine, index) in restaurent.cuisines.slice(0,5)" :href="cuisine.public_uri">{{cuisine.name}},&nbsp;</a> 
											</span>
										</span>
									</li>
									<li class="ellipsis"></li>
								</ul>

								<div class="restnt-loc ellipsis text-xs text-gray-700" data-w-onclick="stopClickPropagation|w1-restarant">
									<i class="text-xs text-gray-700 las la-map-marker"></i> {{restaurent.address}},
									<a class="text-xs text-gray-700" v-if="restaurent.location" :href="'/restaurents/location/'+restaurent.location.slug">{{restaurent.location.name}}</a>, 
									<a class="text-xs text-gray-700" v-if="restaurent.location" :href="'/restaurents/zone/'+restaurent.location.zone.slug" data-name="North Kochi" data-type="AreaClick">{{restaurent.location.zone.name}}</a>
									<span class="text-xs text-gray-700 ml-4"><i class="las la-eye"></i> {{restaurent.view}}</span>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="bg-white rounded mt-3 p-4">
					<h2 class="text-gray-700 font-bold">About</h2>
					<p v-html="restaurent.description"></p>
					<div class="flex space-x-2 pt-3">
						<i class="h-10 pt-2 w-10 text-4xl text-indigo-700 las la-hamburger align-bottom"></i>
						<div class="min-w-0 relative flex-auto sm:pr-20 lg:pr-0 xl:pr-20">
							<h5 class="font-bold">Cuisines</h5>
							<p>
								<a v-for="(cuisine, index) in restaurent.cuisines" :href="cuisine.public_uri">{{cuisine.name}},&nbsp;</a> 
							</p>
						</div>
					</div>
					<div class="flex space-x-2 pt-3">
						<i class="h-10 pt-2 w-10 text-4xl text-indigo-700 las la-file-invoice-dollar align-bottom"></i>
						<div class="min-w-0 relative flex-auto sm:pr-20 lg:pr-0 xl:pr-20">
							<h5 class="font-bold">Average Cost</h5>
							<p>৳ {{restaurent.approx_cost}} for two people</p>
						</div>
					</div>
					<div class="flex space-x-2 pt-3">
						<i class="h-10 pt-2 w-10 text-4xl text-indigo-700 las la-coffee align-bottom"></i>
						<div class="min-w-0 relative flex-auto sm:pr-20 lg:pr-0 xl:pr-20">
							<h5 class="font-bold">Categories</h5>
							<p>
								<a v-for="(category, index) in restaurent.categories" :href="category.public_uri">{{category.name}},&nbsp;</a> 
							</p>
						</div>
					</div>
					<div class="flex space-x-2 pt-3">
						<i class="h-10 pt-2 w-10 text-4xl text-indigo-700 lab la-cc-mastercard align-bottom"></i>
						<div class="min-w-0 relative flex-auto sm:pr-20 lg:pr-0 xl:pr-20">
							<h5 class="font-bold">Features</h5>
							<p>
								<a v-for="(feature, index) in restaurent.features" :href="feature.public_uri">{{feature.name}},&nbsp;</a> 
							</p>
						</div>
					</div>
					
				</div>
			</div>

			<!-- show similiar restaurents -->
			<div class="bg-white block w-full p-3 mb-3">
				
				<h2 class="text-gray-700 font-bold">Restaurents you may like</h2>
			</div>
			<div class="restaurent-cards grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 mb-3">
				<restaurent-card
	                v-for="(resItem, ik) in similiar.slice(0,3)"
	                :key="resItem.id"
	                :restaurent="resItem">
	            </restaurent-card>
	        </div>
	        <div class="bg-white  w-full p-3 mb-3">
	        	<h1 class="font-bold mb-3">We're always here to help</h1>
	        	<div class="grid grid-cols-2">
		        	<div class="flex">
		        		<i class="font-bold text-4xl las la-phone-volume mr-3 mt-2 text-indigo-700"></i>
		        		<div>
		        			<h1 class="font-bold">Call Us</h1>
		        			+880 160000000000
		        		</div>
		        	</div>
		        	<div class="flex">
		        		<i class="font-bold text-4xl las la-phone-volume mr-3 mt-2 text-indigo-700"></i>
		        		<div>
		        			<h1 class="font-bold">Call the Restaurent</h1>
		        			{{restaurent.mobile_no}}
		        		</div>
		        	</div>
	        	</div>
	        </div>

		</div>
		<div class="md:col-span-2">
			<booking :restaurent_id="restaurent.id"></booking>
		</div>
	</div>
</template>


<script>

export default {
	props: {
        restaurent: {
            type: Object,
            required: true
        },
        similiar: {
            type: Object,
            required: false
        }
    }
}
</script>