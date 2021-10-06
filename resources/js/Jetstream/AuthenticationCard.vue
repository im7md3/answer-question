<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
        <div v-if="route().current('login')" class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg flex justify-center items-center">
     <span class="text-sm text-gray-600 ">{{('Don\'t have an account?')}}<inertia-link :href=" route('register') " class="text-yellow-600 hover:text-yellow-900 text-base font-bold mx-2 ">{{('Sign Up')}}</inertia-link></span>   
    </div>
    </div>
</template>
