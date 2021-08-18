<template>
	<div class="offer-cards grid grid-cols-5 gap-8 mt-10 mb-10">
        <div class="rounded img offer-image cursor" v-for="(offer, index) in offers" :key="offer.id">
			<img :src="offer.image_src">
        </div>
    </div>
</template>
<script type="text/javascript">

export default {
    props: {
        startPoint: {
            type: String,
            required: true
        }
    },

    data () {
        return {
            offers: [],
        }
    },

    created () {
        this.fetch(this.startPoint);
    },

    methods: {
        fetch (endpoint) {
            this.startUpdating();
            axios.get(endpoint).then(({data}) => {
                this.offers.push(...data);
                this.stopUpdating();
                //this.nooffersMessage = (this.offers.length == 0);
            });
        }
    }
}
</script>