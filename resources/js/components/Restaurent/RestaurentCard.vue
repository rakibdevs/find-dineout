<template>
	<div class="restnt-card restaurant">
		<div class="restnt-main-wrap clearfix">
			<div class="img-wrap">
				<div class="img cursor">
					<img :src="restaurent.restaurent.cover_src">
				</div>
			</div>
			<div class="restnt-detail-wrap">
				<div class="restaurant-info-section restnt-detail" >
					<div class="restnt-info cursor" data-gatype="RestaurantNameClick">
						<a href="/kochi/" class="restnt-name ellipsis">
							{{restaurent.restaurent.name}}
						</a>
						<div class="restnt-loc ellipsis" data-w-onclick="stopClickPropagation|w1-restarant">
							{{restaurent.address}},
							<a href="/kochi-restaurants/north-kochi/kaloor" data-name="Kaloor" data-type="LocalityClick">{{restaurent.location.name}}</a>, 
							<a href="/kochi-restaurants/north-kochi" data-name="North Kochi" data-type="AreaClick">{{restaurent.location.zone.name}}</a>
						</div>
					</div>
					<div class="detail-info">
						<ul>
							<li>
								<span class="double-line-ellipsis">
									<span>৳ {{restaurent.restaurent.approx_cost}} for 2 (approx)</span>
									<span> | </span>

									<a v-for="(cuisine, index) in restaurent.restaurent.cuisines" href="/kochi-restaurants/continental-cuisine" data-w-onclick="stopClickPropagation|w1-restarant">{{cuisine.name}}</a> 
								</span>
							</li>
							<li class="ellipsis"></li>
						</ul>
					</div>
					<div class="add-new-section" style="white-space: nowrap; overflow-x: auto;">
						<div v-if="restaurent.restaurent.is_booking == 1" class="is-booking">Book</div>
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