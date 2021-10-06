<template>
    <div v-if="$page.props.user && $page.props.user.id==ques.user_id" class="flex absolute right-2 top-2">
        <inertia-link :href="route('questions.edit',ques.slug)"
            class="font-bold text-green-400 border border-green-400 mr-2 px-2 py-1 text-xs hover:bg-green-400 hover:text-white shadow">
            Edit</inertia-link>
        <button
            class="font-bold text-red-400 border border-red-400 px-2 py-1 text-xs hover:bg-red-400 hover:text-white shadow"
            @click="submitDelete(ques)">Delete</button>
            <label class="switch ml-2" for="checkbox" v-if="route().current('questions.show',ques.slug)">
                <input type="checkbox" id="checkbox" v-model="form.status" :checked="form.status" @change="updateStatus(ques)"/>
                <div class="slider round" ></div>
            </label>
    </div>
</template>

<script>
    export default {
        props: {
            ques: Array
        },
        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    status: this.ques.status
                })
            }
        },
        methods: {
            submitDelete(ques) {
                this.$inertia.delete(route('questions.destroy', ques.slug))
            },
            updateStatus(ques) {
                this.form.post(route('update_status',ques.id), {
                    preserveScroll: true,
                })
            }
        }
    }

</script>

<style scoped>
    .switch {
        display: inline-block;
        height: 24px;
        position: relative;
        width: 45px;
    }

    .switch input {
        display: none;
    }

    .slider {
        background-color: #ccc;
        bottom: 0;
        cursor: pointer;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        transition: .4s;
    }

    .slider:before {
        background-color: #fff;
        bottom: 4px;
        content: "";
        height: 17px;
        left: 4px;
        position: absolute;
        transition: .4s;
        width: 17px;
    }

    input:checked+.slider {
        background-color: #66bb6a;
    }

    input:checked+.slider:before {
        transform: translateX(20px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
