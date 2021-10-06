<template>
    <div class="p-3  border border-gray-200 bg-white shadow-lg rounded-md">
        <h1 class="mb-3 text-xl drop-shadow-md font-bold text-center border-b py-2">Last questions</h1>
        <div class="" v-for="badge in badges" :key="badge.id">
            <h3 class="mb-2 font-bold text-blue-500 hover:text-blue-900">{{badge.name}}</h3>
        </div>
    </div>
</template>

<script>
export default {
    props:{badges:Array}
}
</script>