<template>
  <div class="db">
    <slot :content="content" />
  </div>
</template>

<script>
    export default {
        props: ['user'],
        data () {
            return {
                content: '',
                pagination: {
                    page: 1,
                    perPage: 8
                }
            }
        },
        mounted() {
            this.fetchPage()
        },
        methods: {
            async fetchPage () {
                const data = {
                    user: this.user,
                    pagination: this.pagination
                }

                await window.axios.post('/api/deck-builder/page', data).then((response) => {
                    this.content = response.data
                })

                window.resizeCards()
            }
        }
    }
</script>
