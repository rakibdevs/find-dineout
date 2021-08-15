<template>
	<div class="calendar clearfix">
		<div class="month-div">
			<span>Aug</span>
			<img src="https://st1.dineout-cdn.co.in/images/uploads/misc/2020/Feb/14/calendar-img.png" alt="" title="" class="clear-img" width="30"></div>
			<div class="date-ls" id="sidebar-book-section-commonBookWidget-5[0]"><span class="left" data-w-preserve-attrs="class" data-w-onclick="scrollBackward|sidebar-book-section-commonBookWidget"><i class="do do-angle-left arrow"></i></span><ul><li class="cDate" data-date="2021-08-15" data-index="0" data-w-preserve-attrs="class" data-w-onclick="dateChangeHandler|sidebar-book-section-commonBookWidget"><span>TODAY</span><div class="date-box"><strong>15</strong></div></li><li class="cDate" data-date="2021-08-16" data-index="0" data-w-preserve-attrs="class" data-w-onclick="dateChangeHandler|sidebar-book-section-commonBookWidget"><span>Mon</span><div class="date-box"><strong>16</strong></div></li>
	</ul>
	<span class="right" data-w-preserve-attrs="class" data-w-onclick="scrollForward|sidebar-book-section-commonBookWidget"><i class="do do-angle-right arrow"></i></span></div></div>
	
</template>
<script>
	export default {
		props: {
	        restaurent: {
	            type: Object,
	            required: true
	        }
	    }
	}
</script>