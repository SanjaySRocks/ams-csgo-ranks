<template>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg mb-3 container">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Navbar brand -->
            <router-link class="navbar-brand me-2" :to="{name: 'home'}">
                <img
                    src="brand.svg"
                    height="32"
                    alt="AmS Logo"
                    loading="lazy"
                    style="margin-top: -1px"
                />
            </router-link>

            <!-- Toggle button -->
            <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarButtonsExample"
                aria-controls="navbarButtonsExample"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class="btn btn-link px-3 me-2" to="/"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link
                            class="btn btn-link px-3 me-2"
                            :to="{ name: 'points' }"
                            >Points</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link
                            class="btn btn-link px-3 me-2"
                            :to="{ name: 'kills' }"
                            >Kills</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link
                            class="btn btn-link px-3 me-2"
                            :to="{ name: 'deaths' }"
                            >Deaths</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link
                            class="btn btn-link px-3 me-2"
                            :to="{ name: 'knifes' }"
                            >Knifes</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link
                            class="btn btn-link px-3 me-2"
                            :to="{ name: 'headshots' }"
                            >Headshots</router-link
                        >
                    </li>
                </ul>
                <!-- Left links -->

                <div class="d-flex align-items-center">
                    <a class="text-reset me-3" href="https://www.facebook.com/groups/amsgaming">
                        <i class="fab fa-facebook"></i>
                    </a>

                    <a class="text-reset me-3" href="https://amsgaming.in/whatsapp">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    <a class="text-reset me-3" href="https://discord.gg/nCr4EkZ">
                        <i class="fab fa-discord"></i>
                    </a>

                    <a class="text-reset me-3" href="https://github.com/sanjaysrocks">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</template>
