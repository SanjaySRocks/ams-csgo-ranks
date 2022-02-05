<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ title }}</h5>
                        <div class="table-responsive">
                            <table
                                id="example"
                                class="table table-sm table-hover"
                                style="width: 100%"
                            >
                                <thead>
                                    <tr>
                                        <th>Player</th>
                                        <th>Steam ID</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr v-for="(point, index) in table" :key="index">
                                        <td>{{ index + 1}}</td>
                                        <td>{{ point.name }}</td>
                                        <td>{{ point.steam }}</td>
                                        <td>{{ point.value }}</td>
                                    </tr> -->

                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Player</th>
                                        <th>Steam ID</th>
                                        <th>Points</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["title"],

    data() {
            return {
              table: {},
            }
        },
    methods: {
        getTest(x){
            console.log(x);
        },
        getTable(){
            axios.get('/api/points')
                .then((response)=>{
                this.table = response.data
                })
        }
    },
    mounted() {
        $('#example').DataTable(
        {
            "processing": true,
            "language": {
                "processing": '<div class="spinner-border text-danger" role="status"></div> Loading...'},
            "ordering": false,
            "serverSide": true,
            "ajax": "api/get/points",
            "columns": [
                { "data": "name", 
                    "className": 'font-weight-bold', 
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html('<router-link class="text-primary" :to="player/'+oData.steam+'" style="cursor: pointer;">'+oData.name+'</router-link>');
                    }

                },
                { "data": "steam" },
                { "data": "value" }
            ]
            });
    }
};
</script>
