<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Category {{ this.model.name }}</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" v-model="model.name" disabled>
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
export default {
    async created() {
        this.model.slug = this.$route.params.slug
        await this.fetchCategory()
    },

    data() {
        return {
            model: {
                name: '',
                slug: '',
            },
            errors: '',
        }
    },

    methods: {
        async fetchCategory() {
            let response = await axios.get(`/api/categories/${this.model.slug}`)

            this.model = response.data.data
        },

        edit(slug) {
            this.$router.push({
                name: "CategoryEdit",
                params: {
                    slug: slug
                }
            })
        },

        async destroy(slug) {
            this.model._method = "DELETE"
            let response = await axios.post(`/api/categories/${this.model.slug}`, this.model)

            if (response.status == 200) {
                this.$swal.fire({
                    title: 'success',
                    icon: 'success',
                    text: 'Data has been destroyed',
                    allowOutsideClick: false
                }).then(result => {
                    if (result.isConfirmed) {
                        this.$router.push({ name: 'CategoryIndex' })
                    }
                });
            }
        }
    },
}
</script>
<style>

</style>
