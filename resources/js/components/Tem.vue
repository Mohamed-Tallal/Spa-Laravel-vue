<template>
    <form @submit.prevent="submit"
          class="vld-parent"
          ref="formContainer">
        <!-- your form inputs goes here-->
        <button type="submit">Login</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                fullPage: true
            }
        },
        methods: {
            submit() {
                let loader = this.$loading.show({
                    // Optional parameters
                    container: this.fullPage ? null : this.$refs.formContainer,
                    onCancel: this.onCancel,
                });
                // simulate AJAX
                setTimeout(() => {
                    loader.hide()
                }, 5000)
            },
            onCancel() {
                console.log('User cancelled the loader.')
            }
        }
    }
</script>
