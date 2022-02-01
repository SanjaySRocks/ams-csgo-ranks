<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ user.name }}</h5>
                    <p class="card-text my-0">Steam: <span class="badge bg-primary">{{ user.steam }}</span></p>
                    <p class="card-text my-0">Points: <span class="badge bg-secondary">{{ user.value }}</span></p>
                    <p class="card-text my-0">Kills: <span class="badge bg-success">{{ user.kills }}</span></p>
                    <p class="card-text my-0">Deaths: <span class="badge bg-danger">{{ user.deaths }}</span></p>
                    <p class="card-text my-0">K/D: <span class="badge bg-danger">{{ user.kills ? convertKD(user.kills, user.deaths) : 0 }}</span></p>
                    <p class="card-text mb-3">Headshots: <span class="badge bg-danger">{{ user.headshots }}  ({{ user.kills ? convertHS(user.kills, user.headshots) : 0 }}%)</span></p>

                </div>
                </div>

            </div>

            <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Weapon Statistics</h5>
                <template>
                    <v-data-table
                        dense
                        :headers="headers"
                        :items="weapons"
                        :items-per-page="5"
                        class="elevation-1"
                    >
                     <template v-slot:[`item.classname`]="{ item }">
                                    <!-- <img src="/icons/weapons/{{ item.classname}}.svg" height="12px" class="pr-3"> -->
                                    {{ item.classname }}
                            </template>
                </v-data-table>
                </template>
                </div>
                 </div>
            </div>

        </div>
    </div>
</template>

<script>
import Navbar from './Navbar.vue';
    export default {
  components: { Navbar },
        mounted() {
            this.getUser();
        },
        data() {
            return {
              user: {},
              headers: [
                {
                    text: 'Weapon Name',
                    align: 'start',
                    sortable: false,
                    value: 'classname',
                },
                { text: 'Kills', value: 'kills' },
            ],
            weapons: [],
            }
        },
        methods: {

            convertKD(tk, td){
                let kd;
                kd = tk/td
                kd = parseFloat(kd).toFixed(2);
                return kd;
            },

            convertHS(tk, th){
                let hs_percent;
                hs_percent = th/tk * 100
                hs_percent = parseFloat(hs_percent).toFixed(2);
                return hs_percent;
            },

            getUser(){
                axios.get('api/user/'+this.$route.params.id)
                    .then((response)=>{
                         this.user = response.data
                         this.weapons = response.data.weapons
                    })
                    .catch(function (error) {
                        if (error.response) {
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                        }
                    });
            }
        },
    }
</script>
