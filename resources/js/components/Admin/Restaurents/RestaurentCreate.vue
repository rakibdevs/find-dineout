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
        <form>
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


                        <el-upload 
                            action="#" list-type="picture-card" 
                            :auto-upload="false" 
                            multiple
                            :name="image"
                            v-model="selImages"
                            
                            >
                          <template #default>
                            <i class="el-icon-plus"></i>
                          </template>
                          <template #file="{file}">
                            <div>
                              <img class="el-upload-list__item-thumbnail" :src="file.url" alt="" />
                              <span class="el-upload-list__item-actions">
                                <span
                                  class="el-upload-list__item-preview"
                                  @click="handlePictureCardPreview(file)"
                                >
                                  <i class="el-icon-zoom-in"></i>
                                </span>
                                <span
                                  v-if="!disabled"
                                  class="el-upload-list__item-delete"
                                  @click="handleDownload(file)"
                                >
                                  <i class="el-icon-download"></i>
                                </span>
                                <span
                                  v-if="!disabled"
                                  class="el-upload-list__item-delete"
                                  @click="handleRemove(file)"
                                >
                                  <i class="el-icon-delete"></i>
                                </span>
                              </span>
                            </div>
                          </template>
                        </el-upload>
                        <el-dialog v-model="dialogVisible">
                          <img width="100%" :src="dialogImageUrl" alt="" />

                        </el-dialog>



                    </div>
                </div>
                <div class="">
                    <label class="block">
                        <span class="text-gray-700 font-bold">Feature Image</span>
                        <image-upload @loaded="onLoad" > </image-upload>
                    </label>

                    <label class="block">
                        <span class="text-gray-700 font-bold">Approximate Cost</span>
                        <input type="text" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter cost" v-model="item.approx_cost">
                    </label>
                    <label class="block my-3">
                        <input type="checkbox" class="form-checkbox" v-model="item.is_booking"> 
                        <span class="text-gray-700 text-sm ml-3">Booking Available</span>
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
                            <option v-for="(location, z) in locations" :key="z" :value="location.id">{{location.name}}</option>
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
                                    <input type="checkbox" class="form-checkbox" v-model="item.cuisines" :value="lib.id"> 
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
                                    <input type="checkbox" class="form-checkbox" v-model="item.categories" :value="lib.id"> 
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
                                    <input type="checkbox" class="form-checkbox" v-model="item.features" :value="lib.id" > 
                                    <span class="pl-3">{{lib.name}}</span>
                                </label>
                            </div>
                        </label>
                    </div>

                    <button type="button" class="bg-indigo-900 h-8 hover:bg-indigo-500 focus:outline-none text-white text-sm  px-3 rounded inline-flex items-center" @click="save">
                        <span>Save</span>
                    </button>
                    
                </div>
            </div>
        </form>
    </div>
    
</template>
<script>
    import Wysiwyg from './../../Common/Wysiwyg.vue';
    import ImageUpload from './../../Common/ImageUpload.vue';
    const cityOptions = ['Shanghai', 'Beijing', 'Guangzhou', 'Shenzhen'];
    export default{
        data(){
            return {
                isLoading: false,
                item:{
                    cuisines: [],
                    features: [],
                    categories: [],
                },
                zones:[],
                locations:[],
                libCuisines: [],
                libCategories: [],
                libFeatures: [],
                dialogImageUrl: '',
                dialogVisible: false,
                disabled: false,
                image:[],
                selImages:[],
                checkedCities:[]
            }
        },
        components:{ Wysiwyg, ImageUpload },
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
                let data = this.item
                axios.post('/admin/restaurents', data).then(res => {
                    this.$notify({
                      title: 'Success',
                      message: 'New restaurent added to the list',
                      type: 'success'
                    });
                }).catch(error => {
                    var errors = "";
                    
                });
            },
            handleRemove(file) {
                console.log(this.image)
            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.url
                this.dialogVisible = true
            },
            handleDownload(file) {
                console.log(file)
            },
            onLoad(image)
            {
                this.item.cover = image.src;
            }

        }
    }
</script>
<style>
    .ck.ck-editor__editable_inline{height: 120px;}
</style>

