<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Edit product</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" v-model="model.name" required>
                        <div class="invalid-feedback"
                            :style="[!errors ? { 'display':'none' } : { 'display':'block'}]">
                            {{ errors }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <v-select multiple
                            v-model="model.categories"
                            :options="categories"
                            :reduce="categories => categories.id"
                            label="name">
                        </v-select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" @click.prevent="update">Save</button>
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
            errors: '',
        }
    },

    methods: {
        async fetchCategories() {
            let response = await axios.get(`/api/categories`)

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

        async update() {
            this.model._method = "PUT"
            let response = await axios.post(`/api/products/${this.model.slug}`, this.model)
            .catch(error => {
                this.$swal.fire({
                    title: 'Error',
                    icon: 'error',
                    text: 'The name has been taken.',
                    allowOutsideClick: false
                }).then(result => {
                    if (result.isConfirmed) {
                        return false;
                    }
                });

            })

            if (response.status == 200) {
                this.$swal.fire({
                    title: 'Success',
                    icon: 'success',
                    text: 'Data has been saved.',
                    allowOutsideClick: false
                }).then(result => {
                    if (result.isConfirmed) {
                        this.$router.push({ name: 'ProductIndex' })
                    }
                });
            }
        },
    },
}
</script>
<style>

</style>
