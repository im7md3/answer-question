<template>

        <div class="user-info mr-5">
            <inertia-link :href="route('users.show',ques.user.username)">
                <img :src="ques.user.profile_photo_url" alt="" class="w-14 h-14 object-cover rounded-full">
                <h4 class="font-bold text-center mt-1">
                    {{ ques.user.name }}
                </h4>
            </inertia-link>
        </div>
        <div class="question-info">
            <inertia-link :href="route('questions.show',ques.slug)" class="font-bold text-blue-600 hover:text-blue-800">
                {{ ques.title }} <span v-if="!ques.status" class="text-red-400 text-sm">[Closed]</span></inertia-link>
            <p class="my-2 text-sm mr-2">{{ ques.body }}</p>
            <inertia-link v-for="tag in ques.tags" :key="tag.id" :href="route('tags.show',tag.slug)"
                class="mr-2 text-blue-800 bg-blue-100 hover:bg-blue-200 p-1 text-xs">
                {{ tag.slug }}
            </inertia-link>
        </div>
        <div class="flex flex-col items-center justify-center ml-auto mt-2">
            <div class="text-center mb-5">
                <span class="text-lg text-gray-600">{{ ques.score }}</span>
                <p class="text-xs text-gray-500 ">votes</p>
            </div>
            <div class="text-center mb-5">
                <span class="text-lg text-gray-600">{{ ques.answers_count }}</span>
                <p class="text-xs text-gray-500 ">Answers</p>
            </div>
            <div class="text-center mb-5">
                <span class="text-lg text-gray-600">{{ ques.views }}</span>
                <p class="text-xs text-gray-500 ">Views</p>
            </div>
        </div>
        <small class="text-xs ml-auto absolute right-2 bottom-2">asked {{ ques.created_at }}</small>
        <crud :ques="ques"></crud>

</template>

<script>
import Crud from '@/Shared/CRUDQues'

    export default {
        props: {
            ques: Array
        },
        components:{
            Crud
        }
    }

</script>

