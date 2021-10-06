<template>
    <app-layout>
        <template #header>
            <header>
                <user-card :user="theUser"></user-card>
            </header>
        </template>
        <div class="container max-w-7xl  my-12 mx-auto px-8">
            <div class="grid grid-cols-2 gap-5">
                <questions-card :questions="theUser.questions"></questions-card>
                <answers-card :answers="theUser.answers"></answers-card>
                <badges-card :badges="theUser.badges"></badges-card>
            </div>
        </div>
        <ask-button></ask-button>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import AskButton from '@/Shared/AskButton'
    import UserCard from '@/Shared/Profile/UserCard'
    import QuestionsCard from '@/Shared/Profile/QuestionsCard'
    import AnswersCard from '@/Shared/Profile/AnswersCard'
    import BadgesCard from '@/Shared/Profile/BadgesCard'

    export default {
        components: {
            AppLayout,
            AskButton,
            UserCard,
            QuestionsCard,
            AnswersCard,
            BadgesCard
        },
        props: {
            theUser: Array
        },
        methods: {

        }
    }

</script>
