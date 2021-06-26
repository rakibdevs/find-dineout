<template>
	<div>
        <div class="grid grid-cols-4 gap-4">
            <div class="">
                <!-- do some filter here -->
                <!-- filter by cuisine -->
                <div v-if="ignore !='cuisine'" class="">
                    <h3 class="py-2">Cuisines</h3>
                    <hr>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" id="cuisines-" v-model="cuisines">
                            <span >Option 1</span>
                        </label>
                    </div>
                </div>
                <!-- filter by categories -->
                <div v-if="ignore !='category'" class="">
                    <h3 class="py-2">Categories</h3>
                    <hr>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" v-model="categories">
                            <span >Option 1</span>
                        </label>
                    </div>
                </div>
                <!-- filter by features -->
                <div v-if="ignore !='feature'" class="">
                    <h3 class="py-2">Features</h3>
                    <hr>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" v-model="features">
                            <span>Option 1</span>
                        </label>
                    </div>
                    <hr>
                </div>
                
            </div>
            <div class="col-span-3">
                <!-- results here -->
                <div class="restaurent-cards grid grid-cols-3 gap-4">
                    <!-- restaurent card -->
                    <restaurent-card
                        v-for="(restaurent, index) in restaurents"
                        :key="restaurent.id"
                        :restaurent="restaurent">
                    </restaurent-card>
                    <restaurent-card-loader v-if="isLoading" :count="3"></restaurent-card-loader>
                </div>
                <div v-if="nextUrl && !isUpdating" class="text-center my-3">
                    <button @click.prevent="fetch(nextUrl)" class="btn btn-sm btn-outline-secondary">
                        {{ __('View more restaurents') }}
                    </button>
                </div>
            </div> 
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
        ignore: {
            type: String,
            required: false,
            default: ''
        }

    },
    components: {RestaurentCardLoader},
    data () {
        return {
            filterable:[],
            restaurents: [],
            cuisines:[],
            categories:[],
            features:[],
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
        },
        fetchLibrary(){

        }
    }
}
</script>
