<template>
    <div>
        <div class="media">
            <vote name="answer" :model="answer"></vote>
            <div class="media-body">
                <form v-if="editing" @submit.prevent="update">
                    <div class="form-group">
                        <textarea name="" id="" cols="30" rows="5" class="form-control" v-model="body" required></textarea>
                    </div>
                    <button class="btn btn-sm btn-outline-primary" :disabled="isInvalid">Update</button>
                    <button @click="cancel" class="btn btn-sm btn-outline-secondary" type="button">Cancel</button>
                </form>
                <div v-else>
                    <div v-html="bodyHtml"></div>
                    <div class="row">
                        <div class="col-4">
                            <div class="ml-auto">
                                <a v-if="authorize('modify', answer)"
                                   @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                                <button v-if="authorize('modify', answer)" class="btn btn-sm btn-outline-danger"
                                        @click="destroy">Del</button>
                            </div>
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4">
                            <user-info label="Answered" :model="answer"></user-info>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</template>

<script>
    export default {
        props: ['answer'],
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
                return this.pageRoute + `/questions/${this.questionId}/answers/${this.id }`;
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
                        this.$toast.success(res.data.message, 'Success', {timeout: 3000});
                        //alert(res.data.message);
                    })
                    .catch(err => {
                        this.$toast.error(err.response.data.body[0], 'Error', {timeout: 3000});
                        //alert(err.response.data.body[0]);
                    });
            },
            destroy() {
                this.$toast.question('Are you sure about that?', 'Confirm', {
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    position: 'center',
                    buttons: [
                        ['<button><b>YES</b></button>', (instance, toast) => {
                            axios.delete(this.endpoint, {})
                                .then(res => {
                                    // $(this.$el).fadeOut(500, () => {
                                    //     this.$toast.success(res.data.message, 'Success', {timeout: 3000});
                                    //     //alert(res.data.message);
                                    // })

                                    //hàm gọi method để lắng nghe từ component cha
                                    this.$emit('deleted');
                                })
                                .catch(err => {
                                    alert(err.response.data.body[0]);
                                });
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }, true],
                        ['<button>NO</button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ],
                });
            }
        }
    }
</script>

<style scoped>

</style>