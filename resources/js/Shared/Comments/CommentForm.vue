<template>
    <div v-if="$page.props.user" class="flex flex-col">
        <hr class="my-2">
        <button
            class="px-2 py-1 text-gray-700 border border-gray-700 hover:text-white hover:bg-gray-700 text-xs ml-auto"
            @click="showCommentForm=!showCommentForm">Add comment</button>
            <transition name="fade">
                <div class="mt-2" v-if="showCommentForm">
                    <textarea class="w-full" rows="5" v-model="form.comment"></textarea>
                    <button @click="comment"
                        class="mt-3 bg-blue-600 text-white font-bold text-sm rounded hover:bg-blue-500 px-4 py-2 focus:outline-none">Add
                        comment</button>
                </div>
            </transition>
    </div>
</template>

<script>
    import {
        Inertia
    } from '@inertiajs/inertia'
    export default {
        props: {
            route: String,
            object: Object,
            type: String
        },
        data() {
            return {
                showCommentForm: 0,
                form: Inertia.form({
                    id: this.object.id,
                    comment: "",
                    type: this.type
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

<style scoped>
    .fade-enter-active,.fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter,.fade-leave-to
        {
        opacity: 0;
    }

</style>
