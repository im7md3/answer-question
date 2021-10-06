<template>
    <app-layout>
        <div class="py-12">

            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-5 mt-5">
                <div class="col-span-2 bg-white shadow-lg rounded p-5 relative">
                    <div class="">
                        <h1 class="mb-2 text-2xl font-bold">{{ theQues.title }} <span v-if="!theQues.status"
                                class="text-red-400 text-sm">[Closed]</span></h1>
                        <crud :ques="theQues"></crud>
                        <div class="flex items-center justify-between">
                            <div class="flex ">
                                <inertia-link v-for="tag in theQues.tags" :key="tag.id"
                                    :href="route('tags.show',tag.slug)"
                                    class="mr-2 text-blue-800 bg-blue-100 hover:bg-blue-200 p-1 text-xs">
                                    {{ tag.slug }}
                                </inertia-link>
                            </div>
                            <p class="text-gray-500 text-xs">Asked <span
                                    class="text-black">{{ theQues.created_at }}</span></p>
                        </div>
                        <hr class="my-2">
                        <div class="flex">
                            <question-votes :ques="theQues"></question-votes>
                            <p class=" ml-5 mt-2">{{ theQues.body }}</p>
                        </div>
                    </div>

                    <comment-form :type="`question`" :route='`comments.store`' :object="theQues"></comment-form>
                    <comments :comments="theQues.comments"></comments>

                </div>
                <div class="bg-white shadow-lg rounded p-4" style="height:max-content">
                    <div class="p-5 bg-white flex items-center">
                        <inertia-link :href="route('users.show',theQues.user.username)" class="">
                            <img :src="theQues.user.profile_photo_url" alt=""
                                class="w-20 h-20 object-cover rounded-full shadow-md mr-3">
                        </inertia-link>
                        <div class="">
                            <inertia-link :href="route('questions.index')" class="">
                                <h3 class="font-bold">{{ theQues.user.name }}</h3>
                            </inertia-link>
                            <p>{{ theQues.user.email }} </p>
                        </div>
                    </div>
                </div>

                <h3 class="col-span-2 text-lg">{{ theQues.answers.length }} Answers</h3>
                <div class="bg-white col-span-2 shadow-lg rounded p-5 mb-1" v-for="answer in theQues.answers"
                    :key="answer.id">
                    <answer-card :ques="theQues" :answer="answer"></answer-card>
                </div>
                <hr />

                <form v-if="$page.props.user && theQues.status" class="form-contact col-span-2" @submit.prevent="submitAnswer">
                    <div class="mt-4  w-full">
                        <div class="form-group">
                            <textarea class="border w-full" rows="9" v-model="form.answer"></textarea>
                            <div class="p-2 my-0.5 bg-red-400 text-white w-full text-center" v-if="form.errors.answer">
                                {{ form.errors.answer }}</div>
                        </div>
                        <input type="hidden" v-model="id">
                        <button type="submit"
                            class="mt-3 bg-blue-600 text-white font-bold text-sm rounded hover:bg-blue-500 px-4 py-2 focus:outline-none">Post
                            Your Answer</button>
                    </div>
                </form>

            </div>
        </div>
        <ask-button></ask-button>

    </app-layout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";
    import AskButton from '@/Shared/AskButton'
    import QuestionVotes from '@/Shared/Question_Votes'
    import AnswerCard from '@/Shared/Answer_card'
    import Crud from '@/Shared/CRUDQues'
    import CommentForm from '@/Shared/Comments/CommentForm'
    import Comments from '@/Shared/Comments/Comments'

    import {
        Inertia
    } from '@inertiajs/inertia'
    export default {
        props: {
            theQues: Object
        },
        data() {
            return {
                msg: null,
                form: Inertia.form({
                    answer: '',
                    id: this.theQues.id
                })
            }
        },
        components: {
            AppLayout,
            AskButton,
            QuestionVotes,
            AnswerCard,
            Crud,
            CommentForm,
            Comments
        },
        methods: {
            submitAnswer() {
                this.form.post(route('answers.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset()
                    },
                    onError: () => {}
                })
            },

        }
    }

</script>
