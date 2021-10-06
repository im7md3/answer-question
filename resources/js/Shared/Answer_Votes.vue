<template>
    <div  class="flex flex-col items-center">
        <button v-if="$page.props.user && $page.props.user.id==ques.user_id && ques.best_answer!==answer.id" @click="theBest()"
            class="w-10 h-10 rounded-full text-white mb-2 leading-3" :class="ques.best_answer==answer.id? ' bg-green-400':' bg-gray-400'">
            <i class="fas fa-check text-xl text-gray-100"></i>
        </button>
        <i v-if=" ques.best_answer==answer.id" class="fas fa-check fa-2x text-green-500" title="Marked as correct answer"></i>
        <button @click="Vote(1)">
            <i class="fas fa-sort-up fa-4x text-gray-400"
                :class="{'text-yellow-500':theAnswer.votes.length>0?theAnswer.votes[0].pivot.score==1 : false}"></i>
        </button>
        <div class="text-lg text-center ">{{ theAnswer.score }}</div>
        <button class="" @click="Vote(-1)">
            <i class="fas fa-sort-down fa-4x text-gray-400"
                :class="{'text-yellow-500':theAnswer.votes.length>0 ? theAnswer.votes[0].pivot.score==-1 : false}"></i>
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
            answer: Array,
            ques:Object
        },
        data() {
            return {
                msg: null,
                theAnswer: this.answer,
            }
        },
        methods: {
            Vote(s) {
                if (this.$page.props.user) {
                    if (this.$page.props.user.id !== this.theAnswer.user_id) {
                        axios.post(route('vote_answer'), {
                            'id': this.theAnswer.id,
                            'score': s
                        }).then(e => {
                            this.theAnswer = e.data.answer
                        });
                    } else {
                        this.msg = "You cannot vote for your answer"
                        setTimeout(function () {
                            this.msg = null
                        }, 1000);
                    }
                } else {
                    this.msg = "You must be logged in to vote"
                    setTimeout(function () {
                        this.msg = null
                    }, 1000);
                }
            },

            theBest() {
                 if (this.$page.props.user) {
                    if (this.$page.props.user.id !== this.theAnswer.user_id) {
                        this.$inertia.post(route('best_answer'), {
                            'id': this.theAnswer.id,
                        },{
                            preserveScroll:true
                        })
                    } else {
                        this.msg = "You cannot vote for your answer"
                    }
                } else {
                    this.msg = "You must be logged in to vote"
                }
            }
        }
    }

</script>
