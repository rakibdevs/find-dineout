<template>
	<div class="bg-white rounded-xl border-transparent booking-section">
		<div class="title-label text-center font-bold text-xl bg-red-400 rounded-l-xl rounded-r-xl text-white py-2">Book</div>
		<div class=" p-3">
			<p class="text-sm"><i class="las la-calendar"></i> {{picked}} {{item.booking_time}}</p>
			<label class="block">
                <span class="text-gray-700 font-bold">Date</span>
             </label>
			<el-date-picker
		      v-model="item.booking_date"
		      type="date"
		      placeholder="Pick a day">

		    </el-date-picker>
		    <label class="block">
                <span class="text-gray-700 font-bold">Time</span>
             </label>
		    <p> Pick a suitable timeslot</p>
		    <div class="time-picker  my-3">
		    	<div class="grid grid-cols-3 gap-4 mb-3">
		    		<div v-for="(time, index) in this.timeSlot" :key="index" class="text-xl text-center cursor-pointer time-slot-header" :class="{ active: item.type == time.type }" @click="changeTimeSlot(time.type)">{{time.type}}</div>
		    	</div>
		    	<div v-for="(time, index) in this.timeSlot" :key="index">
			    	<div v-if="item.type == time.type" class="grid grid-cols-3 gap-3 time-slot">
			    		<span v-for="(slot, i) in time.slots" :key="i" class="inline-flex items-center justify-center p-3 mr-2 text-base leading-none  bg-gray-200 hover:bg-gray-500 hover:text-white rounded-full cursor-pointer" :class="{ active: item.booking_time == slot }" @click="setTime(slot)">{{slot}}</span>
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
		    		booking_date: '',
		    		booking_time: '',
		    		restaurent_id: this.restaurent_id,
		    		type: 'Lunch'
		    	}
	    	}
	    },
	    computed:{
	    	picked: function(){
	    		return this.item.booking_time;
	    		return moment(this.item.booking_time).format('MM/DD/YYYY')
	    	}
	    },
	    methods:{
	    	changeTimeSlot(type)
	    	{
	    		this.item.type = type
	    		this.item.booking_time = ''
	    	},
	    	setTime(time)
	    	{
	    		this.item.booking_time = time
	    	}
	    }

	}
</script>