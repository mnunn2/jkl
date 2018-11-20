<template>
    <div>
        <b-navbar toggleable="md" type="dark" variant="info">

            <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

            <b-navbar-brand href="#">NavBar</b-navbar-brand>

            <b-collapse is-nav id="nav_collapse">

                <b-navbar-nav>
                    <b-nav-item :to="{ name: 'home' }">Home</b-nav-item>
                    <b-nav-item :to="{ name: 'wibble' }">Wibble</b-nav-item>
                    <b-nav-item :to="{ name: 'page' }">Page</b-nav-item>
                </b-navbar-nav>

            </b-collapse>
        </b-navbar>
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
