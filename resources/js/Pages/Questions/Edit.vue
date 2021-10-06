<template>
    <app-layout>
        <div class="container my-12 mx-auto md:px-12 p-5">
            <h1 class="text-2xl p-5 mb-2">Ask Question </h1>
            <hr class="mb-5" />
            <form class="form-contact" enctype="multipart/form-data" @submit.prevent="submit">

                    <div class="">
                        <label for="title">Title</label>
                        <input type="text"
                            class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-400"
                            v-model="form.title" />
                            <div class="p-2 my-0.5 bg-red-400 text-white w-full text-center" v-if="form.errors.title">{{form.errors.title}}</div>
                    </div>

                <div class="">
                    <label for="body">Body</label>
                    <textarea type="text"
                        class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-400"
                        v-model="form.body" id="body" rows="5"></textarea>
                        <div class="p-2 my-0.5 bg-red-400 text-white w-full text-center" v-if="form.errors.body">{{form.errors.body}}</div>
                </div>

                <div class="form-group col-lg-6">
                    <label for="tags">Tags</label>
                    <select multiple class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-400" v-model="form.tags">
                        <option v-for="tag in tags" :key="tag.id" :value="tag.id" :selected="this.form.tags.includes(tag.id)">{{tag.name}}</option>
                    </select>
                        <div class="p-2 my-0.5 bg-red-400 text-white w-full text-center" v-if="form.errors.tags">{{form.errors.tags}}</div>
                </div>

                <button type="submit"
                    class="mt-3 bg-blue-600 text-gray-200 rounded hover:bg-blue-500 px-4 py-2 focus:outline-none">Review your question</button>
            </form>
        </div>
    </app-layout>
<ask-button></ask-button>

</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";
import { Inertia } from '@inertiajs/inertia'
    import AskButton from '@/Shared/AskButton'

    export default {
        components: {
            AppLayout,
            AskButton
        },
        props:{
            tags:Array,
            myQues:Object,
        },
        data() {
            return {
                ques:this.myQues,
                form: Inertia.form({
                    title: this.myQues.title,
                    slug:this.myQues.slug,
                    tags: [],
                    body: this.myQues.body,
                    _method: 'PUT',
                })
            }
        },
        methods: {
            submit() {
                this.form.post(route('questions.update',this.ques.slug),{
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset()
                    },
                    onError:()=>{}
                })
            },
        },

        mounted(){
            this.ques.tags.forEach(e => {
                this.form.tags.push(e.id);
            })
        }
    }

</script>
