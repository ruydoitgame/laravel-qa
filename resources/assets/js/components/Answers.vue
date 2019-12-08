<template>
    <div class="row mt-3">
        <div class="col-md-12" v-cloak v-if="count">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{title}}</h2>
                    </div>
                    <hr>
                    <answer v-for="answer in answers"
                            :answer="answer"
                            :key="answer.id">
                    </answer>
                    <div class="text-center mt-3" v-if="nextUrl">
                        <button @click="fetch(nextUrl)" class="btn-outline-secondary btn">Load more answers</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Answer from './Answer';
    export default {
        name: "Answers",
        props: ['question'],
        data () {
            return {
                questionID: this.question.id,
                count: this.question.answers_count,
                answers: [],
                nextUrl: null,
            }
        },
        computed: {
            title() {
                return this.count + " answer";
            }
        },
        components: {
            Answer,
        },
        created() {
            this.fetch(this.pageRoute + `/questions/${this.questionID}/answers`);
        },
        methods: {
            fetch(endpoint) {
                axios.get(endpoint)
                    .then(res => {
                        //nếu dùng this.answers.push(res.data.data);
                        //thì answers sẽ có 1 phần tử là mãng res.data.data
                        this.answers.push(...res.data.data);
                        this.nextUrl = res.data.next_page_url;
                    })
                    // let person = {
                    //     fullName = 'Buoi'
                    // };
                    // let {fullName} = person
                    // -> fullName = 'Buoi'
                    // .then(({data}) => {
                    //     this.answers.push(...data.data);
                    //
                    // })
                    .catch(err => {
                        this.$toast.error(err.response.data.body[0], 'Error', {timeout: 3000});
                    });
            }
        }
    }
</script>

<style scoped>

</style>