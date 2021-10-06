<template>
    <app-layout>
        <template #header>
            <div class="text-center">
                <h1 class="mb-3 text-3xl drop-shadow-md font-bold">Tags</h1>
                <p class="w-4/6 mx-auto">A tag is a keyword or label that categorizes your question with other, similar
                    questions. Using the right tags makes it easier for others to find and answer your question.</p>
            </div>
        </template>
        <div class="container max-w-7xl  my-12 mx-auto px-8">
            <div class="grid grid-cols-4 gap-5">
                <div v-for="tag in tags" :key="tag.id" class="p-3  border border-gray-200 bg-white shadow-lg rounded-md">
                    <inertia-link :href="route('tags.show',tag.slug)" class="text-blue-600 hover:text-blue-800">
                        {{ tag.name }}</inertia-link>
                    <p class="my-3 text-sm">
                        {{ tag.description.length > 130 ? tag.description.substring(0,130)+'...' : tag.description }}
                    </p>
                    <small class="text-xs text-gray-500">questions {{ tag.questions_count }}</small>
                </div>
            </div>
        </div>
        <ask-button></ask-button>
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
            tags: Array
        },
        methods: {

        }
    }

</script>
