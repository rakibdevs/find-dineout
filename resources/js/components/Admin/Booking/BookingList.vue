<template>
	<div>
		<div class="heading flex justify-between">
			<h2 class="font-bold mt-2 mb-2">
        		<i class="h-6 w-6 text-2xl text-indigo-700 las la-utensils align-bottom"></i> 
        		Bookings
        	</h2>
			<!-- <a href="/admin/restaurents/create" class="bg-indigo-900 h-8 hover:bg-indigo-500 focus:outline-none text-white text-sm  px-3 rounded inline-flex items-center" >
              <i class="las la-plus  font-bold mr-2"></i>
              <span>Restaurent</span>
            </a> -->
		</div>
		<div class="flex justify-between mb-3">
			<div class="">
				<select class="h-8 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" v-model="per_page" @change="filter">
					<option value="10" selected>10</option>
					<option value="20">20</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option :value="pagination.total">All</option>
				</select>
			</div>
			<div >
				<input type="text" v-model="search_text" class=" block w-full h-8 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Search restaurent" @keyup.enter="filter">
			</div>
			
		</div>
		<div v-if="!isLoading" class="info-table">
			<table class="w-full mb-3 table-bordered border-collapsed">
				<thead>
					<tr>
						<th>Sl</th>
						<th>Booking Code</th>
						<th>Date</th>
						<th>Restaurent Name</th>
						<th>Guest Name</th>
						<th>Mobile No</th>
						<th>Email</th>
						<th>Guest Count</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(row, index) in rows" :key="index">
						<td class="text-center">{{++index}}</td>
						<td class="text-center">{{row.booking_code}}</td>
						<td>{{row.booking_schedule}}</td>
						<td>{{row.restaurent.name}}</td>
						<td>{{row.guest_name}}</td>
						<td>{{row.mobile_no}}</td>
						<td>{{row.email}}</td>
						<td class="text-center">{{row.guest_count}}</td>
						<td class="text-center">
							<i v-if="row.status == 1" class="las la-check text-green-600 text-bold"></i>
							<i v-else class="las la-times text-red-600 font-bold"></i>
						</td>
						<td class="text-center">
							<div class="flex item-center justify-center action-buttons">
								<i class="las la-trash-alt text-red-500 cursor-pointer text-xl" @click="destroy(row.id)"></i>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
				<!-- for mobile page view -->
				<div class="flex justify-between flex-1 sm:hidden">
					<span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md"> « Previous </span>
					<span @click="loadPage(pagination.next_page_url)" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"> Next » </span>
				</div>
				<div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
					<div>
						<p class="text-sm text-gray-700 leading-5"> 
							Showing <span class="font-medium">{{pagination.from}}</span> to <span class="font-medium">{{pagination.to}}</span> of <span class="font-medium">{{pagination.total}}</span> results 
						</p>
					</div>
					<div>
						<span class="relative z-0 inline-flex shadow-sm rounded-md">
							<span v-for="(link, index) in pagination.links" :key="index">
								<span v-if="link.url!=null" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-pointer leading-5" v-html="link.label" @click="loadPage(link.url)"></span>
								<span v-else class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5" v-html="link.label"></span>
							</span>
							
						</span>
					</div>
				</div>
			</nav>
		</div>
		<loading-table v-if="isLoading"></loading-table>
	</div>
	
</template>
<script>
	export default{
		props:{
	        startpoint: {
	            type: String,
	            default: true
	        },
	    },
	    data(){
	    	return {
	    		reserve_endpoint: null,
	    		rows:[],
	    		pagination:[],
		    	isLoading: false,
		    	per_page:10,
		    	search_text:null,
		    	/*item:{
		    		id:null,
		    		name: null,
		    		zone_id: ""
		    	},*/
		    	//zones:[]
		    }
	    },
	    created () {
	        this.fetch(this.startpoint);
	        //this.fetchZones()
	    },
	    methods: {
	    	withParams( page_url ){
	    		let params = 'per_page='+this.per_page;
	        	if(this.search_text != '' && this.search_text != null){
	        		params += '&keyword='+this.search_text;
	        	}
	        	return page_url += (page_url.split('?')[1] ? '&':'?') + params
	    	},
	        fetch ( page_url ) {
	        	this.isLoading = true;
	        	page_url = this.withParams(page_url)
	        	this.reserve_endpoint = page_url;
	            axios.get(page_url).then(({data}) => {
	                this.rows = data.data;
	                this.pagination = this.getPagination(data)
	                this.isLoading = false;
	                
	            });
	        },
	        filter(){
	        	this.fetch(this.startpoint)
	        },
	        loadPage(page_url) {
	        	this.fetch(page_url)
	        },
	        /*destroy(id) {
	        	console.log('hi');
	        	if(confirm('are you sure?')){
	        		axios.delete('/admin/restaurents/'+id).then(res => {
	        			this.$toast.success("restaurent item has been removed.");
		                this.fetch(this.reserve_endpoint)
		            }).catch(error => {
		                var errors = "";
		            });
	        	}

	        },*/
	        /*update(id){
	        	axios.put('/admin/restaurents/'+id, {
	                name: this.item.name,
	                zone_id: this.item.zone_id
	            }).then(res => {
	                this.closeEditModal()
	                this.$toast.success("restaurent item has been updated.");
	                this.fetch(this.reserve_endpoint)
	            }).catch(error => {
	                var errors = "";
	            });
	        },*//*
	        showCreateModal(){
	        	this.setItemNull()
	        	this.createModal = true;	
	        },
	        closeCreateModal(){
	        	this.createModal = false;
	        },
	        showEditModal(data) {
	        	this.editModal = true;
	        	this.item = JSON.parse(JSON.stringify(data)) // to ignore object instance effect
	        },
	        setItemNull(){
	        	this.item = {
		    		id:null,
		    		name: null,
		    		zone_id : ""
		    	}
	        },
	        closeEditModal(){
	        	this.editModal = false;
	  			this.setItemNull()
	        },*/

	    }
	}
</script>