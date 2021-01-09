<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">

            <router-link to="/" class="navbar-brand">Laravel</router-link>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link to="/categories" class="nav-link" exact>Category</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/products" class="nav-link" exact>Product</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/merchants" class="nav-link" exact>Merchant</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
export default {

}
</script>
<style>

</style>
