<template>
    <app-layout>
        <template #header>
            <div class="text-center">
                <h1 class="mb-3 text-3xl drop-shadow-md font-bold">{{ tag.name }}</h1>
                <p class="w-4/6 mx-auto">{{ tag.description }}</p>
            </div>
        </template>
        <div class="container my-12 mx-auto md:px-72 p-5">
            <h2 class="mb-8 font-bold text-xl text-center">{{ tag.questions.length }} questions</h2>
            <div v-for="ques in tag.questions" :key="ques.id"
                class="flex bg-white px-8 py-10 mb-9 shadow-md relative rounded-md">
                <question-card :ques="ques"></question-card>
            </div>
        </div>
        <ask-button></ask-button>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import QuestionCard from '@/Shared/QuestionCard'
    import AskButton from '@/Shared/AskButton'

    export default {
        components: {
            AppLayout,
            QuestionCard,
            AskButton
        },
        props: {
            tag: Array
        },

    }

</script>
