<template>
    <div class="custom-file btn-sm my-1">
        
        <label class="custom-file-label photo-uploader" >
            <div class="el-upload el-upload--picture-card" tabindex="0">
                <img class="img w-full h-full object-cover" v-if="img_src" :src="this.img_src">
                <i v-else class="el-icon-plus"></i>

                <input type="file" accept="image/*"
                @change="onChange" class="custom-file-input" style="display:none;">
            </div>
        </label>
    </div>
</template>

<script type="text/javascript">
export default {
    props: {
        text: {
            type: String,
            required: false
        },
    },
    data(){
        return {
            img_src: null
        }
    },

    methods: {
        onChange (e) {
            if (! e.target.files.length) return;

            let file = e.target.files[0];
            

            let reader = new FileReader();

            reader.readAsDataURL(file);

            reader.onload = e => {
                let src = e.target.result
                this.$emit('loaded', { src, file });
                this.img_src = e.target.result;
            };
        },
    }
}
</script>
