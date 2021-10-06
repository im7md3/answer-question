<template>
    <div class="flex flex-col">
        <hr class="my-3">
        <h1 class="">Comments</h1>
        <div v-for="comment in comments" :key="comment.id" class="flex items-center mt-2">
            <div class="">
                <inertia-link :href="route('users.show',comment.user.username)">
                    <img :src="comment.user.profile_photo_url" :alt="comment.user.username"
                        class="w-10 h-10 rounded-full shadow mr-4">
                </inertia-link>
            </div>
            <div class="">
                <h3 class="font-bold text-blue-500 hover:text-blue-700">
                    <inertia-link :href="route('users.show',comment.user.username)">{{ comment.user.name }}</inertia-link>
                </h3>
                <p class="text-sm">{{ comment.content }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import {
        Inertia
    } from '@inertiajs/inertia'
    export default {
        props: {
            comments: Object,
        },
        data() {
            return {
                showCommentForm: 0,
                form: Inertia.form({

                    comment: "",

                })
            }
        },
        methods: {
            comment() {
                this.form.post(route(this.route), {
                    preserveScroll: true
                })
            }
        }
    }

</script>
