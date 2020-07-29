<template>
  <div class="db">
    <slot
        :next-page="nextPage"
        :previous-page="previousPage"
    />
  </div>
</template>

<script>
    export default {
        props: ['user'],
        data () {
            return {
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
                    document.querySelector('.db-content-card-list-cards').innerHTML = response.data.view
                    this.pagination = response.data.pagination
                })

                window.resizeCards()


            },
            async nextPage() {
                this.pagination.page++
                this.fetchPage()
            },
            async previousPage() {
                this.pagination.page--
                this.fetchPage()
            }
        }
    }
</script>
