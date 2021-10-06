<template>
    <div class="flex justify-center items-center">
        <div class="col-start-2 col-span-1 flex flex-col text-center items-center justify-center  w-auto mt-5">
            <img class="w-28 h-28 rounded-full mb-3" :src="user.profile_photo_url " :alt="user.username">
            <p>{{ user.reputation }}<span class="text-xs text-gray-500"> REPUTATION</span></p>
        </div>
        <div class=" flex flex-col w-auto ml-16 ">

            <div class="flex flex-row items-center mt-8 mb-4">
                <h1 class="font-light text-3xl mr-14">{{ user.name }}</h1>
                <span v-if="$page.props.user && $page.props.user.username==user.username">
                    <inertia-link :href="route('profile.show')"
                        class="border border-gray-300 hover:text-white hover:border-gray-700 hover:bg-gray-700 rounded-md py-1 px-2 whitespace-nowrap ">
                        {{ 'Edit Profile' }}</inertia-link>
                </span>
            </div>
            <p class="mb-4 font-black">{{ user.name }}</p>
            <ul class="flex flex-row mb-4">
                <li class="mr-10"><span class="font-semibold">
                        {{ user.answers_count }} </span> {{ 'Answers' }}
                </li>
                <li class="mr-10"><span class="font-semibold">
                        {{ user.questions_count }} </span> {{ 'Questions' }}
                </li>
            </ul>
            <div>

                <p>{{ user.address }}</p>
                <p class="text-blue-500"><a :href="user.site">{{ user.site }}</a></p>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: Array
        }
    }

</script>
