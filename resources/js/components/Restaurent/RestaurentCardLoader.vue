<template>
	<div v-for="i in count" class="animate-pulse space-x-4">
        <div class="rounded w-full bg-gray-400 h-24"></div>
        <div class="h-4 bg-gray-400 rounded w-3/4 my-4"></div>
        <div class="space-y-2">
            <div class="h-4 bg-gray-400 rounded w-7/8"></div>
            <div class="h-4 bg-gray-400 rounded w-4/6"></div>
        </div>
    </div>
</template>
<script type="text/javascript">
    export default {
        props: {
            count: {
                type: Number,
                required: true
            }
        }
    }
</script>

