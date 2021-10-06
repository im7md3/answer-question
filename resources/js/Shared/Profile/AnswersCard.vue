<template>
    <div class="p-3  border border-gray-200 bg-white shadow-lg rounded-md">
        <h1 class="mb-3 text-xl drop-shadow-md font-bold text-center border-b py-2">Last answers</h1>
        <div class="" v-for="answer in answers" :key="answer.id">
            <p class="mb-2">{{answer.answer.substring(0,30)+'... , a '}}
                <span class="mb-2 font-bold text-blue-500 hover:text-blue-900"><inertia-link :href="route('questions.show',answer.question.slug)">{{answer.question.title}}</inertia-link></span>
            </p>
            
        </div>
    </div>
</template>

<script>
export default {
    props:{answers:Array}
}
</script>