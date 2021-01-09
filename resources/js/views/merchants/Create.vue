<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Create new merchant</h5>
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
                        <button class="btn btn-primary btn-block" @click.prevent="store">Save</button>
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
    data() {
        return {
            model: {
                name: '',
            },
            errors: '',
        }
    },

    methods: {
        async store() {
            let response = await axios.post(`/api/merchants`, this.model)
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

            if (response.status == 201) {
                this.$swal.fire({
                    title: 'success',
                    icon: 'success',
                    text: 'Data has been saved',
                    allowOutsideClick: false
                }).then(result => {
                    if (result.isConfirmed) {
                        this.$router.push({ name: 'MerchantIndex' })
                    }
                });
            }
        }
    },
}
</script>
<style>

</style>
