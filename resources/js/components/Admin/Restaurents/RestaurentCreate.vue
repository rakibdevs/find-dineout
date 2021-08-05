<template>
    <div>
        <div class="heading flex justify-between">
            <h2 class="font-bold mt-2 mb-2">
                <i class="h-6 w-6 text-2xl text-indigo-700 las la-utensils align-bottom"></i> 
                Restaurent Add
            </h2>
            <a href="/admin/restaurents" class="bg-indigo-900 h-8 hover:bg-indigo-500 focus:outline-none text-white text-sm  px-3 rounded inline-flex items-center" >
              <i class="las la-list  font-bold mr-2"></i>
              <span>Restaurents</span>
            </a>
        </div>
        <form >
            <div class="grid grid-cols-4 gap-6">
                <div class="col-span-2">
                    <div class="grid grid-cols-1 gap-3 mb-3">
                        <label class="block">
                            <span class="text-gray-700 font-bold">Restaurent Name</span>
                            <input type="text" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter a title" v-model="item.name">
                        </label>
                        <label class="block">
                            <span class="text-gray-700 font-bold">Description</span>
                        </label>
                        <wysiwyg
                            @input="updateBody"
                            placeholder="Add restaurent description" :class="'h-30'">
                        </wysiwyg>
                        <label class="block">
                            <span class="text-gray-700 font-bold">Menu Card</span>
                        </label>
                    </div>
                </div>
                <div class="">
                    <label class="block">
                        <span class="text-gray-700 font-bold">Approximate Cost</span>
                        <input type="text" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter cost" v-model="item.approx_cost">
                    </label>
                    <label class="block my-3">
                        <input type="checkbox" class="form-checkbox" v-model="item.is_booking"> 
                        <span class="text-gray-700 text-sm ml-3">Booking Available</span>
                        <span >{{item.name}}</span>
                    </label>
                    <label class="block">
                        <span class="text-gray-700 font-bold">Zone</span>
                        <select v-model="item.zone_id" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" @change="fetchLocation()">
                            <option  value="">Please select one</option>
                            <option v-for="(zone, z) in zones" :key="z" :value="zone.id">{{zone.name}}</option>
                        </select>
                    </label>
                    <label class="block">
                        <span class="text-gray-700 font-bold">Location</span>
                        <select v-model="item.location_id" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option  value="">Please select one</option>
                            <option v-for="(location, z) in locations" :key="z" :value="location.id">{{zone.name}}</option>
                        </select>
                    </label>
                    <label class="block">
                        <span class="text-gray-700 font-bold">Address</span>
                        <textarea type="text" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 h-20 focus:ring-opacity-50" placeholder="Enter address" v-model="item.address"></textarea>
                    </label>
                </div>
                <div class="">
                    <div class="">
                        <label class="block">
                            <span class="text-gray-700 font-bold">Cuisines</span>
                            <div class="libray-items-checkbox overflow-y-auto max-h-40 border border-gray-300 px-3 py-2 mt-1 rounded" >
                                <label class="block items-center" v-for="(lib, index) in libCuisines">
                                    <input type="checkbox" class="form-checkbox" v-model="cuisines" :value="lib.id"> 
                                    <span class="pl-3">{{lib.name}}</span>
                                </label>
                            </div>
                        </label>
                    </div>
                    <div class="">
                        <label class="block">
                            <span class="text-gray-700 font-bold">Categories</span>
                            <div class="libray-items-checkbox overflow-y-auto max-h-40 border border-gray-300 px-3 py-2 mt-1 rounded" >
                                <label class="block items-center" v-for="(lib, index) in libCategories">
                                    <input type="checkbox" class="form-checkbox" v-model="categories" :value="lib.id"> 
                                    <span class="pl-3">{{lib.name}}</span>
                                </label>
                            </div>
                        </label>
                    </div>
                    <div class="">
                        <label class="block">
                            <span class="text-gray-700 font-bold">Features</span>
                            <div class="libray-items-checkbox overflow-y-auto max-h-40 border border-gray-300 px-3 py-2 mt-1 rounded" >
                                <label class="block items-center" v-for="(lib, index) in libFeatures">
                                    <input type="checkbox" class="form-checkbox" v-model="features" :value="lib.id" > 
                                    <span class="pl-3">{{lib.name}}</span>
                                </label>
                            </div>
                        </label>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
    
</template>
<script>
    import Wysiwyg from './../../Common/Wysiwyg.vue';
    export default{
        data(){
            return {
                isLoading: false,
                item:{
                    name:'',
                    description:'',
                    zone_id : '',
                    location_id : '',
                },
                zones:[],
                locations:[],
                libCuisines: [],
                libCategories: [],
                libFeatures: [],
                cuisines:[],
                categories:[],
                features:[],
            }
        },
        components:{ Wysiwyg },
        created () {
            this.fetchZones()
            this.fetchLibrary();
        },
        methods: {
            fetchZones(){
                axios.get('/api/fetch/zones/').then(({data}) => {
                    this.zones = data;
                });
            },
            fetchLocation(){
                axios.get('/api/fetch/locations?zone='+this.item.zone_id).then(({data}) => {
                    this.locations = data;
                });
            },
            fetchLibrary(){
                // fetch cuisine
                axios.get('/api/fetch/cuisines').then(({data}) => {
                    this.libCuisines = data;
                });
                
                // fetch cuisine
                axios.get('/api/fetch/categories').then(({data}) => {
                    this.libCategories = data;
                });
                
                // fetch cuisine
                axios.get('/api/fetch/features').then(({data}) => {
                    this.libFeatures = data;
                });
                
            },
            updateBody (newValue) {
                this.item.description = newValue;
            },
            save(){
                axios.post('/admin/restaurents', {
                    name: this.item.name,
                    zone_id: this.item.zone_id
                }).then(res => {
                    this.$toast.success("New restaurent added.");
                }).catch(error => {
                    var errors = "";
                    
                });
            },
            destroy(id) {
                if(confirm('are you sure?')){
                    axios.delete('/admin/restaurents/'+id).then(res => {
                        this.$toast.success("restaurent item has been removed.");
                    }).catch(error => {
                        var errors = "";
                    });
                }

            }

        }
    }
</script>
<style>
    .ck.ck-editor__editable_inline{height: 120px;}
</style>