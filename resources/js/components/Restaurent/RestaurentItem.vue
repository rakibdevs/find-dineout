<template>
	<div>{{restaurent.name}}</div>
</template>


<script type="text/javascript">

export default {
	props: {
        restaurent: {
            type: Object,
            required: true
        }
    }
}
</script>