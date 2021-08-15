<template>
	<div>
        <div class="grid grid-cols-4 gap-4">
            <div class="">
                <!-- filter by cuisine -->
                <div v-if="ignore !='cuisines'" class="">
                    <h3 class="py-2">Cuisines</h3>
                    <hr>
                    <div v-for="(item, index) in libCuisines">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" v-model="cuisines" :value="item.slug" @change="checkBoxFilter"> 
                            <span class="ml-2"> {{item.name}}</span>
                        </label>
                    </div>
                </div>
                <!-- filter by categories -->
                <div v-if="ignore !='categories'" class="">
                    <h3 class="py-2">Categories</h3>
                    <hr>
                    <div v-for="(item, index) in libCategories">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" v-model="categories" :value="item.slug" @change="checkBoxFilter"> 
                            <span class="ml-2"> {{item.name}}</span>
                        </label>
                    </div>
                </div>
                <!-- filter by features -->
                <div v-if="ignore !='features'" class="">
                    <h3 class="py-2">Features</h3>
                    <hr>
                    <div v-for="(item, index) in libFeatures">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" v-model="features" :value="item.slug" @change="checkBoxFilter" > 
                            <span class="ml-2"> {{item.name}}</span>
                        </label>
                    </div>
                    <hr>
                </div>
                
            </div>
            <div class="col-span-3">
                <!-- results here -->
                <div class="restaurent-cards grid grid-cols-3 gap-4">
                    <!-- restaurent card -->

                    <restaurent-card v-if="!isUpdating"
                        v-for="(restaurent, index) in restaurents"
                        :key="restaurent.id"
                        :restaurent="restaurent">
                    </restaurent-card>
                    <restaurent-card-loader v-if="isLoading" :count="6"></restaurent-card-loader>
                </div>
                <div v-if="nextUrl && !isUpdating" class="text-center my-3">
                    <button @click.prevent="addMore(nextUrl)" class="btn btn-sm btn-outline-secondary">
                        View more restaurents
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
        },
        findSlug: {
            type: String,
            required: false,
            default: ''
        },

    },
    components: {RestaurentCardLoader},
    data () {
        return {
            restaurents: [],
            cuisines:[],
            categories:[],
            features:[],
            libCuisines: [],
            libCategories: [],
            libFeatures: [],
            isLoading:true,
            nextUrl:'',
            queries: [],
        }
    },

    created () {
        this.createdParams();
        this.fetchLibrary();
        this.fetch(this.startPoint);
    },

    methods: {
        fetch (endpoint) {  
            this.isLoading = true
            this.startUpdating();
            axios.get(endpoint).then(({data}) => {
                this.restaurents = data.data;
                this.isLoading = false
                this.nextUrl = data.next_page_url;
                this.stopUpdating();
            });
        },
        addMore (endpoint) {
            this.isLoading = true
            this.startUpdating();
            axios.get(endpoint).then(({data}) => {
                this.restaurents = [...this.restaurents,...data.data]
                console.log(this.restaurents)
                this.isLoading = false
                this.nextUrl = data.next_page_url;
                this.stopUpdating();
            });
        },
        fetchLibrary(){
            // fetch cuisine
            if(this.ignore !='cuisine'){
                axios.get('/api/fetch/cuisines').then(({data}) => {
                    this.libCuisines = data;
                });
            }
            // fetch cuisine
            if(this.ignore !='category'){
                axios.get('/api/fetch/categories').then(({data}) => {
                    this.libCategories = data;
                });
            }
            // fetch cuisine
            if(this.ignore !='feature'){
                axios.get('/api/fetch/features').then(({data}) => {
                    this.libFeatures = data;
                });
            }
        },
        checkBoxFilter(){
            this.getSelectedParams();
            this.setParams(this.queries);
            let params = this.setQueryString();
            let fetchUri = this.startPoint+(this.startPoint.indexOf('?') !== -1?'&':'?')+params;
            this.fetch(fetchUri);
        },
        getSelectedParams(){
            this.queries = [];
            if(this.cuisines.length > 0){
                this.queries.cuisines = this.cuisines.join()
            }
            if(this.categories.length > 0){
                this.queries.categories = this.categories.join()
            }
            if(this.features.length > 0){
                this.queries.features = this.features.join()
            }
            /*if(this.ignore != '' && this.findSlug != ''){
                this.queries[this.ignore] = this.findSlug
            }*/
            console.log(this.queries)
        }

    }
}
</script>
