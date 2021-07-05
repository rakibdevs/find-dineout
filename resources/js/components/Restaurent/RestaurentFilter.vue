<template>
	<div>
        <div class="grid grid-cols-4 gap-4">
            <div class="">
                <!-- filter by cuisine -->
                <div v-if="ignore !='cuisine'" class="">
                    <h3 class="py-2">Cuisines</h3>
                    <hr>
                    <div v-for="(item, index) in libCuisines">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" v-model="cuisines" :value="item.name" @click="checkBoxFilter"> 
                            <span >{{item.name}}</span>
                        </label>
                    </div>
                </div>
                <!-- filter by categories -->
                <div v-if="ignore !='category'" class="">
                    <h3 class="py-2">Categories</h3>
                    <hr>
                    <div v-for="(item, index) in libCategories">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" v-model="categories" :value="item.name" @click="checkBoxFilter"> 
                            <span >{{item.name}}</span>
                        </label>
                    </div>
                </div>
                <!-- filter by features -->
                <div v-if="ignore !='feature'" class="">
                    <h3 class="py-2">Features</h3>
                    <hr>
                    <div v-for="(item, index) in libFeatures">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox" v-model="features" :value="item.name" @click="checkBoxFilter" > 
                            <span>{{item.name}}</span>
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
import queryString from 'query-string';

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
            restaurents: [],
            cuisines:[],
            categories:[],
            features:[],
            libCuisines: [],
            libCategories: [],
            libFeatures: [],
            params: [],
            isLoading:true,
            nextUrl:''
        }
    },

    created () {
        this.setParams();
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
        fetchLibrary(){
            // fetch cuisine
            if(this.ignore !='cuisine'){
                axios.get('api/fetch/cuisines').then(({data}) => {
                    this.libCuisines = data;
                    console.log(this.libCuisines)
                });
            }
            // fetch cuisine
            if(this.ignore !='category'){
                axios.get('api/fetch/categories').then(({data}) => {
                    this.libCategories = data;
                });
            }
            // fetch cuisine
            if(this.ignore !='feature'){
                axios.get('api/fetch/features').then(({data}) => {
                    this.libFeatures = data;
                });
            }
        },
        setParams(){
            this.params = queryString.parse(location.search);
        },
        checkBoxFilter(){
            //this.fetch(this.startPoint);
        }

    }
}
</script>
