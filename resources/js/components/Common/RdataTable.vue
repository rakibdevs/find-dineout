<template>
	<div>
		<div v-if="!isLoading" class="info-table">
			<table>
				<thead>
					<tr>
						<th 
							v-for="(th, index) in headers"
		                    :key="index">
		                    {{th.title}}
		                </th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(row, index) in rows" :key="index">
						<td 
							v-for="(th, index) in headers"
		                    :key="index">
		                    {{row[th.key]}}
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
								<span v-if="link.url!=null || link.active == false" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-pointer leading-5" v-html="link.label" @click="loadPage(link.url)"></span>
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
	        /*headers: {
	            type: Object,
	            required: true
	        },*/
	        startpoint: {
	            type: String,
	            default: false
	        },
	    },
	    data(){
	    	return {
	    		headers: [
	    			{
	    				key:'id',
	    				title:'Serial',
	    			},
	    			{
	    				key:'name',
	    				title:'Name',
	    			},
	    			{
	    				key:'slug',
	    				title:'Slug',
	    			},
	    		],
	    		rows:[],
	    		pagination:{
	    			page:1,
	    			from:null,
	    			to:null,
	    			total:null,
	    			links:[],
	    		},
		    	isLoading: false
		    }
	    },
	    created () {
	        this.fetch();
	    },
	    methods: {
	        fetch (page_url = null) {
	        	this.isLoading = true;
	        	page_url = page_url == null?this.startpoint:page_url;
	            axios.get(page_url).then(({data}) => {
	                this.rows = data.data;
	                this.pagination.page = data.current_page;
	                this.pagination.from = data.from;
	                this.pagination.to = data.to;
	                this.pagination.total = data.total;
	                this.pagination.next_page_url = data.next_page_url;
	                this.pagination.links = data.links;
	                this.isLoading = false;
	            });
	        },
	        loadPage(page_url) {
	        	this.fetch(page_url)
	        }

	    }
	}
</script>