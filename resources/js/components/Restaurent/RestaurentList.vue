<template>
	<div>
        <restaurent-item
            v-for="(restaurent, index) in restaurents"
            :key="restaurent.id"
            :restaurent="restaurent">
        </restaurent-item>
        <div v-if="nextUrl && !isUpdating" class="text-center my-3">
            <button @click.prevent="fetch(nextUrl)" class="btn btn-sm btn-outline-secondary">
                {{ __('View more restaurents') }}
            </button>
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
            restaurents: [],
        }
    },

    created () {
        this.fetch(this.startPoint);
    },

    methods: {
        fetch (endpoint) {
            this.startUpdating();
            axios.get(endpoint).then(({data}) => {
                this.restaurents.push(...data.data);
                this.nextUrl = data.next_page_url;
                this.stopUpdating();
                //this.norestaurentsMessage = (this.restaurents.length == 0);
            });
        }
    }
}
</script>
