<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Edit merchant</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group mb-4">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" v-model="model.name" required>
                        <div class="invalid-feedback"
                            :style="[!errors ? { 'display':'none' } : { 'display':'block'}]">
                            {{ errors }}
                        </div>
                    </div>
                    <h5>List of products</h5>
                    <template v-for="(item, index) in model.products">
                        <div class="form-group" :key="index">
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <v-select
                                        v-model="model.products[index].id"
                                        :options="products"
                                        :reduce="product => product.id"
                                        label="name">
                                    </v-select>
                                </div>
                                <div class="col-md-4">
                                    <label>Price</label>
                                    <input type="text" class="form-control" v-model="model.products[index].price">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-sm btn-danger btn-block" @click.prevent="remove(index)">Remove</button>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md">
                                <button class="btn btn-sm btn-outline-primary btn-block" @click.prevent="addRow">Add More Product</button>
                            </div>
                        </div>
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

        await this.fetchProducts()
        await this.fetchMerchant()
    },

    data() {
        return {
            model: {
                name: '',
                slug: '',
                products: [],
            },
            products: [],
            errors: '',
        }
    },

    methods: {
        async fetchMerchant() {
            let response = await axios.get(`/api/merchants/${this.model.slug}`)
            let products = response.data.data.products.map(item => {
                item.price = parseFloat(item.price)
                return item
            })

            this.model = response.data.data
            this.model.products = products
        },

        async fetchProducts() {
            let response = await axios.get(`/api/products`)
            this.products = response.data.data
        },

        async update() {
            this.model._method = "PUT"
            let products = {};

            this.model.products.forEach((row, index) => {
                products[row.id] = { price: row.price}
            })

            this.model.products = products

            let response = await axios.post(`/api/merchants/${this.model.slug}`, this.model)
            .catch(error => {
                this.$swal.fire({
                    title: 'Error',
                    icon: 'error',
                    text: 'The name has been taken.',
                    allowOutsideClick: false
                });
            })

            if (response.status == 200) {
                this.$swal.fire({
                    title: 'success',
                    icon: 'success',
                    text: 'Data has been saved.',
                    allowOutsideClick: false
                }).then(result => {
                    if (result.isConfirmed) {
                        this.$router.push({ name: 'MerchantIndex' })
                    }
                });
            }
        },

        addRow() {
            this.model.products.push(0);
        },

        remove(index) {
            this.model.products.splice(index, 1);
        }
    },
}
</script>
<style>

</style>
