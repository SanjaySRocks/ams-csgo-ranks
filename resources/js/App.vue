<template>
    <div>
        <Navbar/>
        <main>
            <router-view></router-view>
        </main>

        <footer>
        <p class="text-center"> <a href="https://github.com/sanjaysrocks" target="_blank"> Github.com </a> - Made with love by Sanjay </p>
        </footer>

    </div>
</template>
<script>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'
    export default {
        components:{
            Navbar, Footer
        }
    }
</script>