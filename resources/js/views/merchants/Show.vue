<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Merchant {{ model.name }}</h5>
            </div>
            <div class="card-body">
                <h5>List of products</h5>
                <template v-for="(category, index) in grouped.categories">
                    <div class="row mb-2" :key="index">
                        <div class="col">
                            <div class="card" v-if="category.products && category.products.length">
                                <div class="card-header">
                                    <h5>{{ category.name }}</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <h5>Name</h5>
                                                <h5>Price</h5>
                                            </div>
                                        </li>
                                        <template v-for="(product, i) in category.products">
                                            <li class="list-group-item" :key="i">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        {{ product.name }}
                                                    </div>
                                                    <div class="col-md-6 d-flex justify-content-end">
                                                        {{ product.price }}
                                                    </div>
                                                </div>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-warning btn-block" @click.prevent="edit(model.slug)">Edit</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-danger btn-block" @click.prevent="destroy(model.slug)">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import vSelect from 'vue-select'
export default {
    components: { vSelect },
    async created() {
        this.model.slug = this.$route.params.slug

        await this.fetchCategories()
        await this.fetchMerchant()
    },

    mounted() {
    },

    data() {
        return {
            model: {
                name: '',
                slug: '',
                products: [],
            },
            grouped: {
                categories: [],
            }
        }
    },

    methods: {
        async fetchCategories() {
            let response = await axios.get(`/api/categories`)
            this.grouped.categories = response.data.data
        },

        async fetchMerchant() {
            let response = await axios.get(`/api/merchants/${this.model.slug}`)
            let products = response.data.data.products.map(item => {
                item.price = parseFloat(item.price)
                return item
            })

            let categories = this.grouped.categories.map(category => {
                category.products = []

                products.forEach(product => {

                    product.categories.forEach(row => {
                        if (row.id == category.id) {
                            category.products.push(product)
                        }
                    })
                });

                return category
            })

            this.model = response.data.data
            this.model.products = products
            this.grouped.categories = categories
        },

        edit(slug) {
            this.$router.push({
                name: 'MerchantEdit',
                params: {
                    slug: slug
                }
            })
        },

        async destroy(slug) {
            this.model._method = 'DELETE'
            let response = await axios.post(`/api/merchants/${this.model.slug}`, this.model)

            if (response.data.status == 200) {
                this.$swal.fire({
                    title: 'success',
                    icon: 'success',
                    text: 'Data has been destroyed',
                    allowOutsideClick: false
                }).then(result => {
                    if (result.isConfirmed) {
                        this.$router.push({ name: 'MerchantIndex' })
                    }
                });
            }
        },
    },
}
</script>
<style>

</style>
