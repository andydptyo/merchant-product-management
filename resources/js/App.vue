<template>
    <div class="container-fluid">
        <Navbar />

        <div class="container py-4">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import Navbar from './components/Navbar'
    export default {
        components: { Navbar }
    }
</script>
