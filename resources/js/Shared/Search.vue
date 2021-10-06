<template>
    <div class="relative mt-3 w-full">
        <input type="text" v-model="form.search" @keyup="this.showResult" @click="showResult"
            class="bg-white border border-gray-500 text-sm px-7 py-1.5 rounded focus:outline-none focus:shadow-outline w-full"
            placeholder="Search (Press '/' to focus)" >
        <div class="absolute top-0">
            <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24">
                <path class="heroicon-ui"
                    d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
                </svg>
        </div>
        <div class="spinner top-0 right-0 mr-4 mt-3"></div>

        <div class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-0 " >


        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                form:{
                    search:''
                },
                results:[],
            }
        },
        methods:{
            showResult(){
                /* if(this.form.search.length>0){
                    axios.post(route('search'),this.form).then(res=>{
                        this.results=res.data;
                    this.$page.props.openSearch=true;
                }) 
                } */
            },
        },
    }

</script>
