<template>
    <app-layout>

        <div class="container my-12 mx-auto md:px-72 p-5">
            <h2 class="mb-8 font-bold text-xl text-center">Top Questions</h2>
            <div v-for="ques in questions" :key="ques.id"
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
            questions: Array
        },

    }

</script>
