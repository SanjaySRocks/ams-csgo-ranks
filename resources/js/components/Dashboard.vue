<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 pb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Search for id</h5>
                            <input
                                type="text"
                                id="typeText"
                                v-model="search"
                                class="form-control"
                                placeholder="STEAM_1:0:123456789"
                            />
                        <button @click="searchbox()" class="btn btn-block btn-primary my-3">Search</button>
                    </div>
                </div>
            </div>

            <div class="col-md-3 pb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Players</h5>
                        <p class="card-text total">
                            <i class="fas fa-users"></i>
                            {{ numberWithCommas(total.players) }}
                        </p>

                        <p class="card-text top" @click="moveToUser(total.ptop.steam)">
                            Leader: {{ total.ptop.name }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Headshots</h5>
                        <p class="card-text total">
                            <img
                                src="img/global/headshot.svg"
                                height="32px"
                            />
                            {{ numberWithCommas(total.headshots) }}
                        </p>
                        <p class="card-text top" @click="moveToUser(total.htop.steam)">
                            Leader: {{ total.htop.name }}
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Kills</h5>
                        <p class="card-text total">
                            <i class="fas fa-skull-crossbones"></i>
                            {{ numberWithCommas(total.kills) }}
                        </p>
                        <p class="card-text top" @click="moveToUser(total.ktop.steam)">
                            Leader: {{ total.ktop.name }}
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Knifes</h5>
                        <p class="card-text total">
                            <img
                                src="img/weapons/weapon_knife.svg"
                                height="32px"
                            />
                            {{ numberWithCommas(total.knifes) }}
                        </p>
                        <p class="card-text top" @click="moveToUser(total.knifetop.steam)">
                            Leader: {{total.knifetop.name}}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <div class="text-center">
                        <p class="card-title"><h3>Top Global Achievers</h3></p>
                        <img height="64px" src="https://raw.githubusercontent.com/SteamDatabase/GameTracking-CSGO/0e457516ba13817a45b6c2a1d262fe7d0599bcbc/csgo/pak01_dir/resource/flash/econ/status_icons/skillgroup18.png" alt="global rank">
                    </div>
                    <table class="table table-sm">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(x, index) in total.globals" :key="index">
                        <td class="text-primary" @click="moveToUser(x.steam)">{{x.name}}</td>
                        </tr>
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    mounted() {
    },
    data() {
        return {
            total: {},
            search: '',
        };
    },
    methods: {
        moveToUser(x){
            this.$router.push({name: 'player', params: { id: x }})
        },

        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },

        getTotal() {
            axios.get("/api/total").then((response) => {
                this.total = response.data;
            });
        },

        searchbox(){

            // check empty input
            if(this.search.length > 0){
                
                // check for valid id
                if(!this.search.trim().match(/^STEAM_[0-5]:[01]:\d+$/)){
                    return alert("Invalid ID");
                }

                this.$router.push({name: 'player', params:{id: this.search.trim() }})
            }
            else
            {
                alert("Enter Steam ID");
            }
        }
    },
    created() {
        this.getTotal();
    },
};
</script>
