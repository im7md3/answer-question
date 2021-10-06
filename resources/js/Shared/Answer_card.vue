<template>
    <div class="row bg-white relative" id="answers">
        <div class="answer-block ">
            <inertia-link :href="route('users.show',answer.user.username)">
                <div class="text-sm flex items-center">
                    <img :src="answer.user.profile_photo_url"
                        class="w-10 h-10 object-cover rounded-full shadow-md mr-3">
                    <div class="text-blue-400">{{ answer.user.name }}</div>
                </div>
            </inertia-link>
            <hr class="my-3">
            <div class="flex relative" v-if="!editForm">
                <answer-votes :ques="ques" :answer="answer"></answer-votes>
                <p class="text-lg ml-5 mt-2">{{ answer.answer }}</p>
            <small class="text-xs ml-auto absolute right-2 bottom-2">answerd {{ answer.created_at }}</small>
            </div>
            <div class="" v-if="editForm">
                <textarea class="w-full"  rows="5" v-model="form.answer"></textarea>
                <button @click="updateAnswer" class="mt-3 bg-blue-600 text-white font-bold text-sm rounded hover:bg-blue-500 px-4 py-2 focus:outline-none">Update</button>
            </div>
            <comment-form :type="`answer`" :route='`comments.store`' :object="answer" ></comment-form>
            <comments :comments="answer.comments"></comments>
            <div v-if="$page.props.user && $page.props.user.id==answer.user_id" class="flex absolute right-2 top-2">
                <button @click="editAnswer" class="font-bold text-green-400 border border-green-400 mr-2 px-2 py-1 text-xs hover:bg-green-400 hover:text-white  shadow">
                    Edit</button>
                <button
                    class="font-bold text-red-400 border border-red-400 px-2 py-1 text-xs hover:bg-red-400 hover:text-white shadow"
                    @click="submitDelete()">Delete</button>
            </div>
                    
        </div>
    </div>
</template>
<script>
    import AnswerVotes from '@/Shared/Answer_Votes'
        import CommentForm from '@/Shared/Comments/CommentForm'
    import Comments from '@/Shared/Comments/Comments'
    export default {
        components: {
            AnswerVotes,
            CommentForm,
            Comments
        },
        props: {
            answer: Object,
            ques: Object,
        },
        data() {
            return {
                editForm:false,
                form:this.$inertia.form({
                    answer:this.answer.answer,
                    _method:"PUT"
                })
            }
        },
        methods: {
            submitDelete() {
                this.$inertia.delete(route('answers.destroy', this.answer.id), {
                    preserveScroll: true,
                });
            },
            editAnswer(){
                this.editForm= !this.editForm;
            },
            updateAnswer(){
                this.form.post(route('answers.update', this.answer.id), {
                    preserveScroll: true,
                    onSuccess:()=>{
                        this.editForm=false
                    }
                });
            }
        }
    }

</script>
