<template>
	<div class="bg-white rounded-xl border-transparent booking-section">
		<div class="title-label text-center font-bold text-xl py-2">Booking Area</div>
		<div v-if="bookingResponse" class="booking-response p-3">
			<div class="text-center">
				<i class="text-16xl font-bold text-green-500 las la-calendar-check"></i>
			</div>
			<h1 class="text-xl font-bold text-center mb-3">Congratulations!</h1>
			<p>Hey <b>{{item.guest_name}}</b>, your booking request for <b>{{item.type}}</b> at {{item.booking_schedule}} has submitted successsfully! Please wait for the confirmation.</p>
			<p class="font-bold text-xl my-2">Booking Code: {{item.booking_code}}</p>
			<p><i class="las la-calendar"></i> {{item.booking_schedule}}</p>

			<p class="text-red-600 text-sm mt-4">N.B. Preserve booking code and mobile no for tracking your booking.</p>
		</div>
		<div v-else class=" p-3">
			<p class="text-sm"> {{picked}}</p>
			<el-date-picker
		      v-model="item.booking_date"
		      type="date"
		      placeholder="Pick a date" 
		      value-format="YYYY-MM-DD"
		      
		      >

		    </el-date-picker>
		    <div class="p-3 rounded border border-gray-200 mt-2">
			    <p class="text-green-700 text-center"> Pick a suitable timeslot</p>
			    <div class="time-picker  my-3">
			    	<div class="grid grid-cols-3 gap-4 mb-3">
			    		<div v-for="(time, index) in this.timeSlot" :key="index" class="text-base font-medium text-center cursor-pointer time-slot-header relative" :class="{ active: item.type == time.type }" @click="changeTimeSlot(time.type)">{{time.type}}</div>
			    	</div>
			    	<div v-for="(time, index) in this.timeSlot" :key="index">
				    	<div v-if="item.type == time.type" class="grid grid-cols-3 gap-3 time-slot">
				    		<span v-for="(slot, i) in time.slots" :key="i" class="inline-flex items-center justify-center py-2 px-2 mr-2 text-base leading-none  bg-blue-100 hover:bg-blue-400 hover:text-white rounded-full cursor-pointer time-slot-item" :class="{ active: picked_time == slot }" @click="setTime(slot)">{{slot}}</span>
				    	</div>
				    </div>
			    </div>
		    	
		    </div>
		    <label class="block">
                <span class="text-gray-700 font-bold">Guest Name</span>
                <input type="text" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter guest name" v-model="item.guest_name">
            </label> 
            <label class="block">
                <span class="text-gray-700 font-bold">Mobile No.</span>
                <input type="text" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter guest mobile no" v-model="item.mobile_no">
            </label> 
            <label class="block">
                <span class="text-gray-700 font-bold">Email</span>
                <input type="text" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter email address" v-model="item.email">
            </label> 
            <label class="block">
                <span class="text-gray-700 font-bold">No of Guest</span>
                <input type="text" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter no of guest" v-model="item.guest_count">
            </label>
            <label class="block">
                <span class="text-gray-700 font-bold"> Special Request</span>
                <input type="text" class="mt-1 block w-full h-10 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Add if any special request" v-model="item.special_request">
                <span class="text-sm text-gray-500">(If any special request)</span>
            </label>

            <label class="block mt-3">
            	<button type="button" class="bg-indigo-900 h-10 hover:bg-indigo-500 focus:outline-none text-white text-sm  px-3 rounded inline-flex items-center block" @click="booking">
                    <span>Book Now</span>
                </button>
            </label>
		</div>
	</div>
</template>

<script>
	import moment from 'moment';
	export default {
		props: {
	        restaurent_id: {
	            type: Number,
	            required: true
	        }
	    },
	    data(){
	    	return{
	    		timeSlot:[
	    			{
	    				type: 'Break Fast',
	    				slots: ['06:00 AM','06:30 AM','07:00 AM','07:30 AM','08:00 AM','08:30 AM','09:00 AM','09:30 AM','10:00 AM','10:30 AM']
	    			},
	    			{
	    				type: 'Lunch',
	    				slots: ['12:00 PM','12:30 PM','01:00 PM','01:30 PM','02:00 PM','02:30 PM','03:00 PM','03:30 PM','04:00 PM','04:30 PM','05:00 PM','05:30 PM']
	    			},
	    			{
	    				type: 'Dinner',
	    				slots: ['7:00 PM','7:30 PM','08:00 PM','08:30 PM','09:00 PM','09:30 PM','10:00 PM','10:30 PM']
	    			},
	    		],
		    	item: {
		    		guest_name: '',
		    		mobile_no: '',
		    		email: '',
		    		booking_date: '',
		    		booking_time: '',
		    		restaurent_id: this.restaurent_id,
		    		type: 'Lunch'
		    	},
	    		picked_time:'',
		    	picked:'',
		    	bookingResponse: false,
		    	datePickerOptions: {
			      disabledDate (date) {
			        return date > new Date()
			      }
			    }
	    	}
	    },
	    computed: {
		  inBetweenDatesPickerOptions() {
		    return {
		      disabledDate: (time) => {
		        return time <= new Date()
		      }
		    }
		  }
		},
	    methods:{
	    	changeTimeSlot(type)
	    	{
	    		this.item.type = type
	    		this.picked_time = ''
	    	},
	    	setTime(time)
	    	{
	    		if(this.item.booking_date == ''){
	    			this.picked = ''
	    			this.picked_time = ''
	    			this.$notify({
                      title: 'Danger',
                      message: 'Select booking date first!',
                      type: 'error'
                    });
	    		}else{

		    		this.picked_time = time
		    		let dateObj = new Date(this.item.booking_date +' '+ time);
		    		this.item.booking_time = moment(dateObj).format('HH:mm:ss')
		    		this.picked = moment(dateObj).format('LLLL')
	    		}
	    	},
	    	validateRequest()
	    	{
	    		let error = '';
	    		if(this.item.booking_date == ''){
	    			error = 'Booking Date'
	    		}else if(this.picked_time == ''){
	    			error = 'Booking Time'
	    		}else if(this.item.guest_name == ''){
	    			error = "Guest Name"
	    		}else if(this.item.mobile_no == ''){
	    			error = "Mobile No"
	    		}
	    		if(error){
	    			this.$notify({
                      title: 'Danger',
                      message: error+ ' is missing!',
                      type: 'error'
                    });
                    return false;
	    		}else{
	    			return true;
	    		}

	    	},
	    	booking(){
	    		if(this.validateRequest()){
		    		let formData = new FormData();
	                for ( var key in this.item ) {
	                    Array.isArray(this.item[key])
	                    ? this.item[key].forEach(value => formData.append(key + '[]', value))
	                    : formData.append(key, this.item[key]) ;
	                }
	                axios.post('/bookings/store', formData, {
	                    headers: {
	                      'Content-Type': 'multipart/form-data'
	                    }
	                }).then(res => {
	                    this.$notify({
	                      title: 'Success',
	                      message: 'New restaurent added to the list',
	                      type: 'success'
	                    });
	                    this.bookingResponse = true
	                    this.item = res.data
	                }).catch(error => {
	                    var errors = "";
	                    this.$notify({
	                      title: 'Error!',
	                      message: 'Something error occured! Please try again',
	                      type: 'danger'
	                    });
	                    
	                });
	    		}
	    	}
	    }

	}
</script>