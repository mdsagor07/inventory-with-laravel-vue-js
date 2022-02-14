<template>
    <div>

        <button @click="deleteUser">
        <slot>Delete</slot>
    </button>

    </div>
</template>

<script>
    export default {
        
        props: ['id', 'name'],
        methods: {
            deleteUser() {
                alert(`I am ${this.id}!`)
            }
        },

    }
</script>

<style lang="scss" scoped>

</style>