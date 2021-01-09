<template>
    <div class="container">
        <h3>Category</h3>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8 align-items-center">
                        <label for="search">Search Here</label>
                        <input
                            id="search"
                            class="form-control"
                            type="text"
                            v-model="options.search">
                    </div>
                    <div class="d-flex align-items-end justify-content-end col-md-4">
                        <button class="btn btn-sm btn-primary btn-block p-2" @click.prevent="create">Create new</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table-component
                    :items="categories"
                    :page="current_page"
                    :perpage="per_page"
                    :type="'category'">
                </table-component>
            </div>
            <div class="card-footer">
                <Paginator
                    :pagination="pagination"
                    v-on:pageChanged="goto"
                />
            </div>
        </div>
    </div>
</template>
<script>
import TableComponent from '../../components/Table'
import Paginator from '../../components/Paginator'

export default {
    components: {
        TableComponent,
        Paginator
    },

    created() {
        this.fetchCategories()
    },

    mounted() {

    },

    data() {
        return {
            url: '/api/categories',
            options: {
                search: '',
            },
            categories: [],
            pagination: [],
            current_page: 1,
            per_page: 15,
        }
    }
,
    methods: {
        async fetchCategories() {
            let response = await axios.get(`${this.url}`, {
                params: this.options
            })

            this.categories = response.data.data
            this.pagination = response.data.meta
            this.current_page = this.pagination.current_page;
            this.per_page = this.pagination.per_page;
        },

        goto(value) {
            this.url = value;
            this.fetchCategories();
        },

        create() {
            this.$router.replace({ name: 'CategoryCreate' })
        }
    },

    watch: {
        'options.search' : function (newVal, oldVal) {
            this.options.search = newVal;

            this.fetchCategories();
        }
    }
}
</script>
<style>

</style>
