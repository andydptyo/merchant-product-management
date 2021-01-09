<template>
    <nav>
        <ul class="pagination justify-content-center">
            <template v-for="(item, index) in pagination.links">
                <li class="page-item" :class="{active: item.active, disabled: !item.url}" :key="index">
                    <button class="page-link" v-html="item.label" @click.prevent="goto(item.url)" />
                </li>
            </template>
        </ul>
    </nav>
</template>
<script>
export default {
    props: ['pagination'],
    data() {
        return {
            url: '',
        }
    },

    methods: {
        goto (url) {
            this.url = url
            this.$emit('pageChanged', this.url)
        }
    }
}
</script>
<style>

</style>
