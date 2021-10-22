<template>
    <div class="relative mt-3 w-full">
        <input type="text" v-model="form.search" @keyup="this.showResult" @click="showResult"
            class="bg-white border border-gray-500 text-sm px-7 py-1.5 rounded focus:outline-none focus:shadow-outline w-full"
            placeholder="Search (Press '/' to focus)">
        <div class="absolute top-0">
            <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24">
                <path class="heroicon-ui"
                    d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
            </svg>
        </div>
        <div class="spinner top-0 right-0 mr-4 mt-3"></div>

        <div class="z-50 absolute bg-white shadow-lg rounded mt-0 p-4 w-full top-9" v-if="this.results.length!=0">
            <div class="flex justify-around">
                <div class="" >
                    <h2 class="font-bold">Questions</h2>
                    <div class="mt-3" v-if="this.results.questions && this.results.questions.length>0">
                        <div class="" v-for="ques in results.questions" :key="ques.id">
                            <inertia-link :href="route('questions.show',ques.slug)" class="text-blue-400">{{ ques.title }}
                            </inertia-link>
                        </div>
                    </div>
                    <p class="text-red-500 mt-3" v-else >There are no results for the questions</p>
                </div>
                <div class="" >
                    <h4 class="font-bold">Users</h4>
                    <div class="" v-if="this.results.users && this.results.users.length>0">
                        <div class="mt-3" v-for="user in results.users" :key="user.id">
                            <inertia-link :href="route('users.show',user.username)"
                                class="text-blue-400 flex items-center">
                                <img :src="user.profile_photo_url" alt="" class="rounded-full object-cover w-10 h-10 mr-2">
                                <span>{{ user.username }}</span>
                            </inertia-link>
                        </div>
                    </div>
                        <p class="text-red-500 mt-3" v-else >There are no results for the users</p>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    search: ''
                },
                results: [],
            }
        },
        methods: {
            showResult() {
                    axios.get(route('search'), {
                        params: {
                            search: this.form.search
                        },
                    }).then(res => {
                        this.results = res.data;
                    })

            },
        },
    }

</script>
