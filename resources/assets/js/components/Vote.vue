<template>
    <div class="d-flex flex-column vote-controls  mr-3">
        <a href="" class="vote-up"
           :title="title('up')"
           :style="myStyle"
           @click.prevent="voteUp"
        >
            ^
        </a>
        <span class="votes-coute">{{count}}</span>
        <a href="" class="vote-down off"
           :title="title('down')"
           :style="myStyle"
           @click.prevent="voteDown"
        >
            v
        </a>

        <favorite v-if="name === 'question'" :question="model" name="name" :route="route"></favorite>
        <accept v-if="name === 'answer'" :answer="model" name="name" :route="route"></accept>
    </div>
</template>

<script>
    import Favorite from './Favorite.vue';
    import Accept from './Accept.vue';
    export default {
        props: ['name', 'model', 'route', 'voteroute'],
        data () {
            return {
                count: this.model.votes_count,
            }
        },
        computed: {
            myStyle() {
                return this.signedIn ? '' : 'color: white';
            },
        },
        methods: {
            title(voteType) {
                let titles = {
                    up: `The ${this.name} is useful`,
                    down: `The ${this.name} is not useful`,
                }
                return titles[voteType];
            },
            voteUp() {
                this._vote(1);

            },
            voteDown() {
                this._vote(-1);
            },
            _vote(vote) {
                if (!this.signIn)
                {
                    this.$toast.warning(`Please login to vote this ${this.name}`, 'Warning', {timeout: 3000, position: 'bottomLeft'});
                    return;
                }
                axios.post(this.voteroute, {
                    vote: vote
                    //hoặc chỉ cần ghi
                    //vote
                })
                    .then(res => {
                        this.$toast.success(res.data.message, 'Success', {timeout: 3000});
                        this.count = res.data.voteCount;
                    })
                    .catch(err => {
                        this.$toast.error(err.response.data.body[0], 'Error', {timeout: 3000});
                    });
            }
        },
        components: {
            // Favorite: Favorite,
            // Accept: Accept,
            Favorite,
            Accept
        }
    }

</script>

<style scoped>

</style>