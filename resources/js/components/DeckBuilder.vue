<template>
  <div class="db">
    <slot :test="test" />
  </div>
</template>

<script>
    export default {
        mounted() {
            document.addEventListener("livewire:load", function(event) {
                window.livewire.hook('afterDomUpdate', () => {
                    window.resizeCards()
                });
            });
        },
        methods: {
            test () {
                alert('WAT')
            }
        }
    }
</script>
