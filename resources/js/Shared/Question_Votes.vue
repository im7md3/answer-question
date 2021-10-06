<template>
    <div class="flex flex-col items-center">
        <button @click="Vote(1)">
            <i class="fas fa-sort-up fa-4x text-gray-400"
                :class="{'text-yellow-500':theQues.votes.length>0?theQues.votes[0].pivot.score==1 : false}"></i>
        </button>
        <div class="text-lg text-center ">{{ theQues.score }}</div>
        <button class="" @click="Vote(-1)">
            <i class="fas fa-sort-down fa-4x text-gray-400"
                :class="{'text-yellow-500':theQues.votes.length>0?theQues.votes[0].pivot.score==-1 : false}"></i>
        </button>
        <div class="text-white py-1 px-2 bg-red-400 shadow-md rounded-md w-96 mx-auto text-center fixed top-20 right-3"
            v-if="msg!==null">
            {{ msg }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            ques: Array
        },
        data() {
            return {
                msg: null,
                theQues: this.ques,
            }
        },
        methods: {
            Vote(s) {
                if (this.$page.props.user) {
                    if (this.$page.props.user.id !== this.ques.user_id) {
                        axios.post(route('vote_question'), {
                            'id': this.ques.id,
                            'score': s
                        }).then(e => {
                            this.theQues = e.data
                        })
                    } else {
                        this.msg = "You cannot vote for your question"
                        setTimeout(function () {
                            this.msg = null
                        }, 5000);
                    }
                } else {
                    this.msg = "You must be logged in to vote"
                    setTimeout(function () {
                        this.msg = null
                    }, 5000);
                }

            },
        }
    }

</script>
