<template>
	<div class="zone-list grid grid-cols-5 gap-4 mt-5 mb-10">
        <div class="" v-for="(zone, index) in zones" :key="zone.id">
			<span>{{zone.name}} ({{zone.restaurents_count}})</span>
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
            zones: [],
        }
    },

    created () {
        this.fetch(this.startPoint);
    },

    methods: {
        fetch (endpoint) {
            this.startUpdating();
            axios.get(endpoint).then(({data}) => {
                this.zones.push(...data);
                this.stopUpdating();
                //this.nozonesMessage = (this.zones.length == 0);
            });
        }
    }
}
</script>