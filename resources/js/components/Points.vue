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
                                        <th>Total Points</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                
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
            }
        },
    methods: {
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
                        $(nTd).html('<a class="text-secondary" href="player/'+oData.steam+'" style="cursor: pointer;">'+oData.name+'</a>');
                    }

                },
                { "data": "steam" },
                { "data": "value",
                className: "text-center",
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        // let html = '';
                        // html = iRow+1 == 1 ? '<span class="mx-1 badge bg-danger">Top 1</span>' : html
                        // html = iRow+1 == 2 ? '<span class="mx-1 badge bg-secondary">Top 2</span>' : html
                        // html = iRow+1 == 3 ? '<span class="mx-1 badge bg-warning">Top 3</span>' : html

                        // $(nTd).html(oData.value+html);
                        
                    }
                }
            ]
            });
    }
};
</script>
