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
                            <span class="text-gray-700 font-bold required">Restaurent Name</span>
                            <input type="text" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter a title" v-model="item.name">
                        </label>
                        <label class="block">
                            <span class="text-gray-700 font-bold">Description</span>
                        </label>
                        <wysiwyg
                            @input="updateBody"
                            placeholder="Add restaurent description" :class="'h-30'" :value="item.description">
                        </wysiwyg>


                        <label class="block">
                            <span class="text-gray-700 font-bold">Images</span>
                        </label>
                        <el-upload 
                            action="#" list-type="picture-card" 
                            :auto-upload="false" 
                            multiple
                            name="images"
                            :on-change="setExtraImages"
                            :on-remove="extraImageRemove"
                            :file-list="extraImageFiles"
                            >
                           <template #default>
                            <i class="el-icon-plus"></i>
                          </template>
                        </el-upload>
                        
                        <label class="block">
                            <span class="text-gray-700 font-bold">Menu Card</span>
                        </label>


                        <el-upload 
                            action="#" list-type="picture-card" 
                            :auto-upload="false" 
                            multiple
                            name="menus"
                            :on-change="setMenuImages"
                            :on-remove="handleRemove"
                            :file-list="extraMenuFiles"
                            
                            >
                           <template #default>
                            <i class="el-icon-plus"></i>
                          </template>
                        </el-upload>



                    </div>
                </div>
                <div class="">
                    <label class="block">
                        <span class="text-gray-700 font-bold required">Feature Image</span>
                        <!-- <image-upload @loaded="onLoad" > </image-upload> -->
                        <label class="custom-file-label photo-uploader" >
                            <div class="el-upload el-upload--picture-card w-full" tabindex="0">
                                <img class="img w-full h-full object-cover" v-if="img_src" :src="img_src">
                                <i v-else class="el-icon-plus"></i>

                                <input type="file" accept="image/*"
                                @change="onChange" class="custom-file-input" style="display:none;">
                            </div>
                        </label>
                    </label>

                    <label class="block">
                        <span class="text-gray-700 font-bold required">Approximate Cost</span>
                        <input type="text" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter cost" v-model="item.approx_cost">
                    </label>

                    <label class="block">
                        <span class="text-gray-700 font-bold">Contact</span>
                        <input type="text" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter mobile no" v-model="item.mobile_no">
                    </label>
                    
                    <label class="block">
                        <span class="text-gray-700 font-bold required">Zone</span>
                        <select v-model="item.zone_id" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" @change="fetchLocation()">
                            <option  value="">Please select one</option>
                            <option v-for="(zone, z) in zones" :key="z" :value="zone.id" >{{zone.name}}</option>
                        </select>
                    </label>
                    <label class="block">
                        <span class="text-gray-700 font-bold required">Location</span>
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
                    <label class="block my-3">
                        <input type="checkbox" class="form-checkbox" v-model="item.is_booking"> 
                        <span class="text-gray-700 text-sm ml-3">Booking Available</span>
                    </label>
                    <div class="">
                        <label class="block">
                            <span class="text-gray-700 font-bold">Cuisines</span>
                            <div class="libray-items-checkbox overflow-y-auto max-h-40 h-40 border border-gray-300 px-3 py-2 mt-1 rounded" >
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
                            <div class="libray-items-checkbox overflow-y-auto max-h-40 h-40 border border-gray-300 px-3 py-2 mt-1 rounded" >
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
                            <div class="libray-items-checkbox overflow-y-auto max-h-40 h-40 border border-gray-300 px-3 py-2 mt-1 rounded" >
                                <label class="block items-center" v-for="(lib, index) in libFeatures">
                                    <input type="checkbox" class="form-checkbox" v-model="item.features" :value="lib.id" > 
                                    <span class="pl-3">{{lib.name}}</span>
                                </label>
                            </div>
                        </label>
                    </div>

                    <div class="block mt-3">
                        <button type="button" class="bg-indigo-900 w-full rounded-full hover:bg-indigo-500 focus:outline-none text-white text-sm  py-2 text-center text-xl " @click="update">
                           Update
                        </button>
                    </div>
                    
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
        props:{
            restaurent: {
                type: Object,
                default: true
            }
        },
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
                menuCards:[],
                checkedCities:[],
                img_src: '',
                extraImages:[],
                extraImageFiles:[],
                extraMenuFiles:[]
            }
        },
        components:{ Wysiwyg, ImageUpload },
        created () {
            this.setRestaurent()
            this.fetchZones()
            this.fetchLibrary();
        },
        methods: {
            setRestaurent(){
                this.item = this.restaurent;
                this.item.zone_id = this.restaurent.location.zone_id
                this.fetchLocation()
                this.item.cuisines = this.restaurent.cuisines.map(a => a.id);
                this.item.features = this.restaurent.features.map(a => a.id);
                this.item.categories = this.restaurent.categories.map(a => a.id);
                this.img_src = this.restaurent.cover_src

                // put feature images
                this.item.images.forEach((item) => {
                    this.extraImageFiles.push({ name: item.id, url: item.image_src });
                })
                // put menu items
                 this.item.menucards.forEach((item) => {
                    this.extraMenuFiles.push({ name: item.id, url: item.image_src });
                })
            },
            fetchZones(){
                axios.get('/api/fetch/zones/').then(({data}) => {
                    this.zones = data;
                });
            },
            fetchLocation(){
                axios.get('/api/fetch/locations?zone='+this.item.zone_id).then(({data}) => {
                    this.locations = data;
                });
                console.log(this.extraImageFiles)
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
            update(){
                let formData = new FormData();
                formData.append('_method', 'PUT')
                formData.append('image', this.item.image);
                for (let i = 0; i < this.extraImages.length; i++) {
                    formData.append('images[]', this.extraImages[i]);
                }
                for (let i = 0; i < this.menuCards.length; i++) {
                    formData.append('menucards[]', this.menuCards[i]);
                }
                for ( var key in this.item ) {
                    formData.append(key, this.item[key])
                    Array.isArray(this.item[key])
                    ? this.item[key].forEach(value => formData.append(key + '[]', value))
                    : formData.append(key, this.item[key]) ;
                }
                axios.post('/admin/restaurents/'+this.item.id, formData, {
                    headers: {
                      'Content-Type': 'multipart/form-data'
                    }
                }).then(res => {
                    this.$notify({
                      title: 'Success',
                      message: 'Restaurent information updated successfully',
                      type: 'success'
                    });
                }).catch(error => {
                    var errors = "";
                    
                });
            },
            onChange(e)
            {
                if (! e.target.files.length) return;
                this.item.image = e.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(this.item.image);
                reader.onload = e => {
                    this.img_src = e.target.result;
                };
            },
            setExtraImages(file, filelist){
                let reader = new FileReader();
                reader.readAsDataURL(file.raw);
                reader.onload = (e) => {
                this.extraImageFiles.push({ name: file.raw.name, url: e.target.result });
                }
                this.extraImages.push(file.raw);
                filelist = this.extraImageFiles;

                console.log(filelist);
            },
            extraImageRemove(file, filelist) {
                const j = this.extraImages.findIndex(x => x.name === file.name)
                this.extraImages.splice(j, 1);
            },
            setMenuImages(file, filelist){
                let reader = new FileReader();
                reader.readAsDataURL(file.raw);
                reader.onload = (e) => {
                this.extraMenuFiles.push({ name: file.raw.name, url: e.target.result });
                }
                this.menuCards.push(file.raw);
                filelist = this.extraMenuFiles;
            },
            handleRemove(file, filelist) {
                const j = this.menuCards.findIndex(x => x.name === file.name)
                this.menuCards.splice(j, 1);
            },

        }
    }
</script>
<style>
    .ck.ck-editor__editable_inline{height: 120px;}
</style>

