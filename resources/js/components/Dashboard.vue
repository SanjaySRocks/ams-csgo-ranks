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
                                placeholder="STEAM_1:23232424"
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

                        <p class="card-text top">
                            {{ total.ptop.name }} ({{ total.ptop.value }} Points )
                        </p>

                        <button class="btn btn-primary">
                            View
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Headshots</h5>
                        <p class="card-text total">
                            <img
                                src="icons/global/headshot.svg"
                                height="32px"
                            />
                            {{ numberWithCommas(total.headshots) }}
                        </p>
                        <p class="card-text top">
                            {{ total.htop.name }} ({{ total.htop.headshots }})
                        </p>
                        <button class="btn btn-primary">
                            View
                        </button>
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
                        <p class="card-text top">
                            {{ total.ktop.name }} ({{ total.ktop.kills }})
                        </p>
                        <button class="btn btn-primary">
                            View
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Knifes</h5>
                        <p class="card-text total">
                            <img
                                src="icons/weapons/weapon_knife.svg"
                                height="32px"
                            />
                            {{ numberWithCommas(total.knifes) }}
                        </p>
                        <p class="card-text top">
                            {{total.knifetop.name}} ({{total.knifetop.kills}})
                        </p>
                        <button class="btn btn-primary">
                            View
                        </button>
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
