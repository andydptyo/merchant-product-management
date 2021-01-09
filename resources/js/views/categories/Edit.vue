<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Edit category</h5>
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
                        <button class="btn btn-primary btn-block" @click.prevent="update">Save</button>
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

        async update() {
            this.model._method = "PUT"
            let response = await axios.post(`/api/categories/${this.model.slug}`, this.model)
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
                    title: 'success',
                    icon: 'success',
                    text: 'Data has been saved.',
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
