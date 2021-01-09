<template>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <template v-if="type == 'product'">
                            <th>
                               Category
                            </th>
                        </template>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(item, index) in dataArray">
                        <tr :key="index">
                            <td>{{ start + index }}</td>
                            <td>{{ item.name }}</td>
                            <template v-if="type == 'product'">
                                <td>{{ item.categories }}</td>
                            </template>
                            <td>
                                <button class="btn btn-sm btn-info text-white" @click.prevent="show(item)">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    props: ['items', 'page', 'perpage', 'type'],
    created() {

    },

    mounted() {

    },

    data() {
        return {
            start: 1,
        }
    },

    methods: {
        show(item) {
            let slug = item.slug;

            if (this.type == 'product') {
                this.$router.push({
                    name: 'ProductShow',
                    params: {
                        slug: slug
                    }
                })
            }

            if (this.type == 'category') {
                this.$router.push({
                    name: 'CategoryShow',
                    params: {
                        slug: slug
                    }
                })
            }

            if (this.type == 'merchant') {
                this.$router.push({
                    name: 'MerchantShow',
                    params: {
                        slug: slug
                    }
                })
            }
        }
    },

    computed: {
        dataArray() {
            return this.items
        }
    },

    watch: {
        'dataArray': function (newVal, oldVal) {
            this.start = this.page > 1 ?
                (this.page - 1) * this.perpage + 1:
                1
        },
    }
}
</script>
<style>

</style>
