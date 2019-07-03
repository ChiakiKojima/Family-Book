<template>
    
        <div>
            <label :for="name" class="col-form-label"><i class="fas fa-camera fa-lg"></i>選択</label>
            <input type="file" :name="name" :id="name" class="d-none" v-on:change="GetImage">
            <img v-bind:src="preview" alt="写真" class="w-100" v-show="true_or_false">
        </div>
    
</template>
    
<script>
    export default {
        props: ['name', 'id'],
        data(){
                return{
                    true_or_false:false,
                    preview:null
                };
            },
        methods:{
            GetImage(e) {
               let image = e.target.files[0];
               let reader = new FileReader();
               reader.readAsDataURL(image);
               reader.onload = e => {
                   this.preview = e.target.result;
               };
               this.true_or_false = true;
            }
        },
    };
</script>
    
