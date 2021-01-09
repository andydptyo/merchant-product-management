<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Product {{ model.name }}</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" v-model="model.name" disabled>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <v-select multiple
                            v-model="model.categories"
                            :options="categories"
                            :reduce="categories => categories.id"
                            label="name"
                            disabled>
                        </v-select>
                    </div>
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
                </form>
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
        await this.fetchProduct()
    },

    data() {
        return {
            model: {
                name: '',
                slug: '',
                categories: [],
            },
            categories: [],
        }
    },

    methods: {
        async fetchCategories() {
            let response = await axios.get('/api/categories')

            this.categories = response.data.data
        },

        async fetchProduct() {
            let response = await axios.get(`/api/products/${this.model.slug}`)
            let categories = response.data.data.categories.map(row => {
                let category = this.categories.find(category => row.slug == category.slug)

                return category.id
            })

            this.model.name = response.data.data.name
            this.model.categories = categories
        },

        edit(slug) {
            this.$router.push({
                name: 'ProductEdit',
                params: {
                    slug: slug
                }
            })
        },

        async destroy(slug) {
            this.model._method = 'DELETE'
            let response = await axios.post(`/api/products/${this.model.slug}`, this.model)

            if (response.data.status == 200) {
                this.$swal.fire({
                    title: 'success',
                    icon: 'success',
                    text: 'Data has been destroyed',
                    allowOutsideClick: false
                }).then(result => {
                    if (result.isConfirmed) {
                        this.$router.push({ name: 'ProductIndex' })
                    }
                });
            }
        }
    },
}
</script>
<style>

</style>
