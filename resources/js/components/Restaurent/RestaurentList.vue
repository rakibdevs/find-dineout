<template>
	<div>
        
        <div class="restaurent-cards grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-4">
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
        },
        show: {
            type: String,
            required: false
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
                if(this.show){
                    this.restaurents = this.restaurents.slice(0,4)
                }
                this.isLoading = false
                this.nextUrl = data.next_page_url;
                this.stopUpdating();
            });
        }
    }
}
</script>
