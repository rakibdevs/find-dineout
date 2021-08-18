<template>
	<div class="location-list grid grid-cols-5 gap-4 mt-5 mb-10">
        <div class="" v-for="(location, index) in locations" :key="location.id">
			<span><span class="">{{location.name}}, {{location.zone.name}}</span> <span class="text-gray-400">({{location.restaurents_count}})</span></span>
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
            locations: [],
        }
    },

    created () {
        this.fetch(this.startPoint);
    },

    methods: {
        fetch (endpoint) {
            this.startUpdating();
            axios.get(endpoint).then(({data}) => {
                this.locations.push(...data);
                this.stopUpdating();
                //this.nolocationsMessage = (this.locations.length == 0);
            });
        }
    }
}
</script>