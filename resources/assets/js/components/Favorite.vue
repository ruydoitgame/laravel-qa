<template>
    <a href="" :title="'Click to mark as favorite ' + name + ' (Click again to undo)'" class="favorite"
       :style="mystyles"
       @click.prevent="toggle"
    >
        Favorite
        {{count}}
    </a>
</template>

<script>
    export default {
        props: ['question', 'name', 'route'],
        data() {
            return {
                isFavorited: this.question.is_favorited,
                count: this.question.favorites_count,
                id: this.question.id,
            }
        },
        computed: {
            mystyles () {
                return !this.signedIn ? 'color: white' : (this.isFavorited ? 'color: pink' : 'color: gray');
            },
            signedIn() {
                return window.Auth.signedIn;
            }
        },
        methods: {
            toggle() {
                if (!this.signedIn) {
                    this.$toast.warning("Please login to favorite this question", 'Warning', {timeout: 3000, position: 'bottomLeft'});
                    return;
                }
                this.isFavorited ? this.destroy() : this.create();
            },
            destroy() {
                axios.delete(this.route)
                    .then(res => {
                        this.count--;
                        this.isFavorited = false;
                    })
                    .catch(err => {
                        this.$toast.error(err.response.data.body[0], 'Error', {timeout: 3000});
                    });

            },
            create() {
                axios.post(this.route)
                    .then(res => {
                        this.count++;
                        this.isFavorited = true;
                    })
                    .catch(err => {
                        this.$toast.error(err.response.data.body[0], 'Error', {timeout: 3000});
                    });
            },
        }
    }
</script>

<style scoped>

</style>