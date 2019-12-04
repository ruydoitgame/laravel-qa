<template>

</template>

<script>
    export default {
        props: ['answer', 'homeRoute'],
        data() {
            return {
                editing: false,
                body: this.answer.body,
                bodyHtml: this.answer.body_html,
                id: this.answer.id,
                questionId: this.answer.question_id,
                beforeEditCache:null,
            }
        },
        computed: {
            isInvalid() {
                return this.body.length < 10;
            },
            endpoint() {
                return this.homeRoute + `/questions/${this.questionId}/answers/${this.id }`;
            }
        },
        methods: {
            edit() {
                this.beforeEditCache = this.body;
                this.editing = true;
            },
            cancel() {
                this.body = this.beforeEditCache;
                this.editing = false;
            },
            update() {
                axios.patch(this.endpoint, {
                    body: this.body
                })
                    .then(res => {
                        this.editing = false;
                        this.bodyHtml = res.data.body_html;
                        alert(res.data.message);
                    })
                    .catch(err => {
                        alert(err.response.data.body[0]);
                    });
            },
            destroy() {
                if (confirm('Are you sure?')) {
                    axios.delete(this.endpoint, {})
                        .then(res => {
                            $(this.$el).fadeOut(500, () => {
                                alert(res.data.message);
                            })
                        })
                        .catch(err => {
                            alert(err.response.data.body[0]);
                        });
                }
            }
        }
    }
</script>

<style scoped>

</style>