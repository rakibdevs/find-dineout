<template>
	<div class="restnt-card restaurant rounded ">
		<div class="restnt-main-wrap clearfix">
			<div class="img-wrap">
				<a :href="restaurent.public_uri" class="img cursor">
					<img :src="restaurent.cover_src">
				</a>
			</div>
			<div class="restnt-detail-wrap">
				<div class="restaurant-info-section restnt-detail" >
					<a :href="restaurent.public_uri" class="restnt-name ellipsis font-bold">
						{{restaurent.name}}
					</a>
					<p class="text-sm" v-html="restaurent.description"></p>
					<div class="restnt-info cursor" data-gatype="RestaurantNameClick">
						<div class="restnt-loc ellipsis" data-w-onclick="stopClickPropagation|w1-restarant">
							{{restaurent.address}},
							<a href="#">{{restaurent.location.name}}</a>, 
							<a href="#">{{restaurent.location.zone.name}}</a>
						</div>
					</div>
					<div class="detail-info text-sm">
						<ul>
							<li>
								<span class="double-line-ellipsis">
									<span>৳ {{restaurent.approx_cost}} for 2 (approx)</span>
								</span>
							</li>
							<li class="ellipsis">
								Cuisines: <a v-for="(cuisine, index) in restaurent.cuisines" :href="cuisine.public_uri" data-w-onclick="stopClickPropagation|w1-restarant">{{cuisine.name}},&nbsp;</a> 
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>


<script type="text/javascript">

export default {
	props: {
        restaurent: {
            type: Object,
            required: true
        }
    }
}
</script>