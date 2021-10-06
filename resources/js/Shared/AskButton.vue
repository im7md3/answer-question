<template>
    <div class="py-12">
            <inertia-link v-if="$page.props.user" :href="route('questions.create')"
                class="rounded-full h-16 w-16 flex items-center justify-center flex fixed bottom-10 right-10 bg-blue-600 text-white font-bold shadow-md">
                Ask ?</inertia-link>
        </div>
</template>

<script>
export default {
    
}
</script>