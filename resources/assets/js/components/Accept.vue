<template>
    <div>
        <a v-if="canAccept" href=""
           :title="'Mark this answer as best ' + name" class=""
           :style="myStyle"
           @click.prevent="accept"
        >
            Best answer
        </a>
        <a v-if="isBestComputed" href="" :title="'Best ' + name" class=""
           :style="myStyle">
            Best answer
        </a>
    </div>
</template>

<script>
    export default {
        props: ['answer', 'name'],
        data () {
            return {
                isBest: this.answer.is_best,
                id: this.answer.id,
            }
        },
        computed: {
            canAccept() {
                return this.authorize('accept', this.answer);
            },
            isBestComputed() {
                return !this.canAccept && this.isBest;
            },
            myStyle() {
                return this.isBest ? 'color: red' : '';
            },
            route() {
                return this.pageRoute + `/answers/${this.answer.id}/accept`;
            },
        },
        methods: {
            accept() {
                axios.post(this.route)
                    .then(res => {
                        this.$toast.success(res.data.message, 'Success', {timeout: 3000, position: 'bottomLeft'});
                        this.isBest = true;
                    })
                    .catch(err => {
                        this.$toast.error(err.response.data.body[0], 'Error', {timeout: 3000});
                    });
            }
        }
    }
</script>

<style scoped>

</style>