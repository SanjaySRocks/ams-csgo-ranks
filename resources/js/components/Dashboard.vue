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
                            Leader: <span class="text-danger">{{ total.ptop.name }}</span>
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
                            Leader: <span class="text-danger">{{ total.htop.name }}</span>
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
                            Leader: <span class="text-danger">{{ total.ktop.name }}</span>
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
                            Leader: <span class="text-danger">{{total.knifetop.name}}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                <div class="card-body table-responsive">
                    <h3>Top 10</h3>
                    <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">PLAYER</th>
                        <th scope="col">POINTS</th>
                        <th scope="col">RANK</th>
                        <th scope="col">KILLS</th>
                        <th scope="col">DEATHS</th>
                        <th scope="col">PLAYED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(x, index) in top" :key="index" style="cursor: pointer;">
                        <td>{{index+1}}</td>
                        <td class="text-primary" @click="moveToUser(x.steam)">{{x.name}}</td>
                        <td>{{x.value}}</td>
                        <td><img id="skillgroup" :src="getSkillImage(x)" /></td>
                        <td>{{x.kills}}</td>
                        <td>{{x.deaths}}</td>
                        <td>{{ Math.round(x.playtime/60/60)  }} hrs</td>
                        </tr>
                    </tbody>
                    </table>
                    </div></div>
            </div>
            
            <div class="col-md-12 my-5">
                <div class="card">
                    <div class="card-body table-responsive">
                    <div class="text-center pb-3">
                        <h3>Top Global Achievers</h3>
                        <img height="64px" src="https://raw.githubusercontent.com/SteamDatabase/GameTracking-CSGO/0e457516ba13817a45b6c2a1d262fe7d0599bcbc/csgo/pak01_dir/resource/flash/econ/status_icons/skillgroup18.png" alt="global rank">
                    </div>
                    <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">PLAYER</th>
                        <th scope="col">POINTS</th>
                        <th scope="col">KILLS</th>
                        <th scope="col">DEATHS</th>
                        <th scope="col">HEADSHOT</th>
                        <th scope="col">PLAYTIME</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(x, index) in total.globals" :key="index" style="cursor: pointer;">
                        <td>{{index+1}}</td>
                        <td class="text-primary" @click="moveToUser(x.steam)">{{x.name}}</td>
                        <td>{{ x.value }}</td>
                        <td>{{ x.kills }}</td>
                        <td>{{ x.deaths }}</td>
                        <td>{{ x.headshots }}</td>
                        <td>{{ Math.round(x.playtime/60/60)  }} hrs</td>
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
            top: {},
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
            
            axios.get("/api/top10").then((response) => {
                this.top = response.data;
            });


        },

        getSkillImage(user) {
            let link =
                "https://raw.githubusercontent.com/SteamDatabase/GameTracking-CSGO/0e457516ba13817a45b6c2a1d262fe7d0599bcbc/csgo/pak01_dir/resource/flash/econ/status_icons/skillgroup" +
                user.rank +
                ".png";
            return link;
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
