<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Points Table</h5>

                        <template>
                            <v-text-field
                                v-model="search"
                                append-icon="mdi-magnify"
                                label="Search"
                                single-line
                                hide-details
                            ></v-text-field>
                            <v-data-table
                                dense
                                :headers="headers"
                                :items="desserts"
                                :items-per-page="10"
                                class="elevation-1"
                                :search="search"
                            >
                            <!-- <template v-slot:[`item.name`]="{ item }">
                                    <router-link class="font-weight-bolder" :to="{name: 'player', params:{id: item.steam }}">{{ item.name }}</router-link>
                            </template> -->
                            <template v-slot:item="{ item }">
                                    <tr>
                                    <td><router-link class="font-weight-bolder" :to="{name: 'player', params:{id: item.steam }}"> {{ item.name }} </router-link> </td> 
                                    <td>{{item.steam }} </td>
                                    <td>{{ item.value }} </td>
                                </tr>
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
  export default {
    data () {
      return {
        search: '',
        headers: [
          { text: 'Name', align: 'start', value: 'name' },
          { text: 'Steam', value: 'steam' },
          { text: 'XP', value: 'value' },
        ],
        desserts: [],
      }
    },
    methods:{
        playerItem(item){
            console.log(item);
        },

            getTable(){
            axios.get('/api/points')
                .then((response)=>{
                this.desserts = response.data
                })
        }
    },
    created(){
        this.getTable();
    }
  }
</script>