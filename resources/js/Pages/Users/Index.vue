<template>
    <app-layout>
        <template #header>
            <div class="text-center">
                <h1 class="mb-3 text-3xl drop-shadow-md font-bold">Users</h1>
            </div>
        </template>
        <div class="container max-w-7xl  my-12 mx-auto px-8">
            <div class="grid grid-cols-4 gap-5">
                <div v-for="user in users" :key="user.id"
                    class="p-3  border border-gray-200 bg-white shadow-lg rounded-md">
                    <div class="flex items-center">
                        <div class="mr-2">
                            <inertia-link :href="route('users.show',user.username)">
                                <img :src="user.profile_photo_url" :alt="user.name" class="w-16 h-16 rounded-full">
                            </inertia-link>
                        </div>
                        <div class="">
                            <inertia-link :href="route('users.show',user.username)">
                                <h4 class="mb-1 text-blue-500 hover:text-blue-800 text-lg">{{user.name}}</h4>
                            </inertia-link>
                            <p class="mb-1 text-gray-500 text-sm">{{user.address}}</p>
                            <p class="mb-1 font-bold text-gray-700 text-sm">{{user.reputation}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ask-button></Ask-button>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import AskButton from '@/Shared/AskButton'

    export default {
        components: {
            AppLayout,
            AskButton
        },
        props: {
            users:Array
        },
    }

</script>
