<template>
	<div>
        
        <div class="restaurent-cards grid grid-cols-4 gap-4">
            <!-- restaurent card -->
            <restaurent-card-loader v-if="isLoading" :count="4"></restaurent-card-loader>

            <restaurent-card
                v-for="(restaurent, index) in restaurents"
                :key="restaurent.id"
                :restaurent="restaurent">
            </restaurent-card>
        </div>  
    </div> 
</template>

<script type="text/javascript">
import RestaurentCardLoader from './RestaurentCardLoader.vue';

export default {
    props: {
        startPoint: {
            type: String,
            required: true
        }
    },
    components: {RestaurentCardLoader},
    data () {
        return {
            restaurents: [],
            isLoading:true
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
                this.isLoading = false
                this.nextUrl = data.next_page_url;
                this.stopUpdating();
            });
        }
    }
}
</script>
