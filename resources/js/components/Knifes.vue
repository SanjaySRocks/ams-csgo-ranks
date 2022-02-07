<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Most Knifes</h5>

                        <table
                                id="example"
                                class="table table-sm table-hover"
                                style="width: 100%"
                            >
                                <thead>
                                    <tr>
                                        <th>Player</th>
                                        <th>Steam ID</th>
                                        <th>Knifes</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>Player</th>
                                        <th>Steam ID</th>
                                        <th>Knifes</th>
                                    </tr>
                                </tfoot>
                            </table>
                        
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
      }
    },
    methods:{
    },
    mounted(){
        $('#example').DataTable(
        {
            "processing": true,
            "language": {
                "processing": '<div class="spinner-border text-danger" role="status"></div> Loading...'},
            "ordering": false,
            "serverSide": true,
            "ajax": "api/get/knifes",
            "columns": [
                { "data": "user.name", 
                    "className": 'font-weight-bold', 
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html('<a class="text-primary" href="player/'+oData.steam+'" style="cursor: pointer;">'+oData.user.name+'</a>');
                    }

                },
                { "data": "steam" },
                { "data": "kills" }
            ]
            });
    }
  }
</script>