<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div v-if="!user" class="alert alert-danger" role="alert">
                    Data Not Found!
                </div>

                <div v-if="user" class="card">
                    <div class="card-body">
                        <h5 class="card-title user-name">
                            {{ user.name }}
                            <a
                                :href="genProfileLink(user.steam)"
                                target="_blank"
                                ><i class="fas fa-external-link-alt"></i
                            ></a>
                        </h5>

                        <img id="skillgroup" :src="getSkillImage(user)" />

                        <p class="card-text my-0">
                            Steam:
                            <span class="badge bg-primary">{{
                                user.steam
                            }}</span>
                            <span class="badge bg-primary">{{
                                convert_steam64(user.steam)
                            }}</span>
                        </p>
                        <p class="card-text my-0">
                            Points:
                            <span class="badge bg-secondary">{{
                                user.value
                            }}</span>
                        </p>
                        <p class="card-text my-0">
                            Kills:
                            <span class="badge bg-success">{{
                                user.kills
                            }}</span>
                        </p>
                        <p class="card-text my-0">
                            Deaths:
                            <span class="badge bg-danger">{{
                                user.deaths
                            }}</span>
                        </p>
                        <p class="card-text my-0">
                            K/D:
                            <span class="badge bg-danger">{{
                                user.kills
                                    ? convertKD(user.kills, user.deaths)
                                    : 0
                            }}</span>
                        </p>

                        <p class="card-text my-0">
                            Assists:
                            <span class="badge bg-danger">{{
                                user.assists
                            }}</span>
                        </p>

                        <p class="card-text my-0">
                            Total Shoots:
                            <span class="badge bg-danger">{{
                                user.shoots
                            }}</span>
                        </p>

                        <p class="card-text my-0">
                            Total Hits:
                            <span class="badge bg-danger">{{ user.hits }}</span>
                        </p>

                        <p class="card-text my-0">
                            Total Round Win/Lose:
                            <span class="badge bg-danger"
                                >{{ user.round_win }} /
                                {{ user.round_lose }}</span
                            >
                        </p>

                        <p class="card-text my-0">
                            Total Played:
                            <span class="badge bg-danger">{{
                                getPlayTime(user)
                            }}</span>
                        </p>

                        <p class="card-text mb-3">
                            Headshots:
                            <span class="badge bg-danger"
                                >{{ user.headshots }} / ({{
                                    getPercent(user, user.headshots)
                                }})</span
                            >
                        </p>

                        <p class="card-text my-0">
                            Last Connect:
                            <span class="badge bg-danger text-wrap">{{
                                getTime(user)
                            }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div v-if="user.unusual.length > 0" class="col-md-6">
                <div id="global-count" class="row mb-3 align-right">
                    <div class="col-6 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">WALLBANG</h5>
                                <h2 class="count">
                                    {{ user.unusual[0].Penetrated }}
                                </h2>
                                <span class="count count_percent"
                                    >({{
                                        getPercent(
                                            user,
                                            user.unusual[0].Penetrated
                                        )
                                    }})</span
                                >
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">NOSCOPE</h5>
                                <h2 class="count">
                                    {{ user.unusual[0].NoScope }}
                                </h2>
                                <span class="count count_percent"
                                    >({{
                                        getPercent(
                                            user,
                                            user.unusual[0].NoScope
                                        )
                                    }})</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">RUN KILL</h5>
                                <h2 class="count">{{ user.unusual[0].Run }}</h2>
                                <span class="count count_percent"
                                    >({{
                                        getPercent(user, user.unusual[0].Run)
                                    }})</span
                                >
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">JUMPING</h5>
                                <h2 class="count">
                                    {{ user.unusual[0].Jump }}
                                </h2>
                                <span class="count count_percent"
                                    >({{
                                        getPercent(user, user.unusual[0].Jump)
                                    }})</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">FLASHED</h5>
                                <h2 class="count">
                                    {{ user.unusual[0].Flash }}
                                </h2>
                                <span class="count count_percent"
                                    >({{
                                        getPercent(user, user.unusual[0].Flash)
                                    }})</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">360 SPIN</h5>
                                <h2 class="count">
                                    {{ user.unusual[0].Whirl }}
                                </h2>
                                <span class="count count_percent"
                                    >({{
                                        getPercent(user, user.unusual[0].Whirl)
                                    }})</span
                                >
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">FIRST BLOOD</h5>
                                <h2 class="count">{{ user.unusual[0].OP }}</h2>
                                <span class="count count_percent"
                                    >({{
                                        getPercent(user, user.unusual[0].OP)
                                    }})</span
                                >
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">SMOKE THROUGH</h5>
                                <h2 class="count">
                                    {{ user.unusual[0].Smoke }}
                                </h2>
                                <span class="count count_percent"
                                    >({{
                                        getPercent(user, user.unusual[0].Smoke)
                                    }})</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">LAST BULLET</h5>
                                <h2 class="count">
                                    {{ user.unusual[0].LastClip }}
                                </h2>
                                <span class="count count_percent"
                                    >({{
                                        getPercent(
                                            user,
                                            user.unusual[0].LastClip
                                        )
                                    }})</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div v-if="user.weapons.length > 0" class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Weapon Statistics</h5>
                        <table id="table1" class="table table-sm table-borderless">
                            <thead class="table-dark">
                                <tr>
                                <th scope="col">Weapon Name</th>
                                <th scope="col">Kills</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in weapons" :key="index">
                                <td>{{ item.classname }}</td>
                                <td>{{ item.kills }}</td>
                                </tr>
                            </tbody>
                    </table>
                    </div>
                </div>
            </div>


            <div v-if="user.weapons.length > 0" class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Loading...</h5>
                    </div>
                </div>
            </div>

            <div v-if="HitsData.datasets[0].data.length > 0" class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Hits Charts</p>
                        <doughnut-chart :data="HitsData"></doughnut-chart>
                    </div>
                </div>
            </div>

            <div v-if="MapsData.datasets[0].data.length > 0" class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Performance [{{ map_name }}]</p>
                        <div class="dropdown">
                            <span
                                class="badge badge-primary dropdown-toggle"
                                data-mdb-toggle="dropdown"
                                style="cursor: pointer"
                            >
                                {{ map_name }}
                            </span>
                            <ul
                                class="dropdown-menu"
                                aria-labelledby="dropdownMenuButton"
                            >
                                <div v-for="x in map_badge" :key="x">
                                    <li>
                                        <a
                                            @click="getMap(x)"
                                            class="dropdown-item"
                                            style="cursor: pointer"
                                            >{{ x }}</a
                                        >
                                    </li>
                                </div>
                            </ul>
                        </div>
                        <pie-chart :chartData="MapsData"></pie-chart>
                    </div>
                </div>
            </div>

            <div
                v-if="MapCompareData.datasets[0].data.length > 0"
                class="col-md-4"
            >
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Over All Maps</p>
                        <bar-chart :data="MapCompareData"></bar-chart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "./Navbar.vue";
const SteamID = require("steamid");
import PieChart from "./charts/PieChart.vue";
import DoughnutChart from "./charts/DoughnutChart.vue";
import LineChart from "./charts/LineChart.vue";
import BarChart from "./charts/BarChart.vue";

export default {
    components: { Navbar, PieChart, DoughnutChart, BarChart },
    
    mounted() {
        console.log('Data Fetching..')
        this.getUser();
    },
    data() {
        return {
            // WeaponNames = {
            //     weapon_ak47: "AK-47",
            //     weapon_awp: "AWP",
            //     weapon_bizon: "PP-BIZON",
            //     weapon_deagle: "Desert Eagle",
            //     weapon_elite: "Dual Berettas",
            //     weapon_famas: "FAMAS",
            //     weapon_fiveseven: "Five-SeveN",
            //     weapon_g3sg1: "G3SG1 (Terrorist Auto Sniper)",
            //     weapon_galilar: "Galil AR",
            //     weapon_glock: "Glock-18",
            //     weapon_hegrenade: "He Grenade",
            //     weapon_inferno: "Molotov",
            //     weapon_knife: "Knife",
            //     weapon_m249: "M249",
            //     weapon_m4a1: "M4A4",
            //     weapon_m4a1_silencer: "M4A1-S",
            //     weapon_mac10: "MAC-10",
            //     weapon_mp5sd: "MP5-SD",
            //     weapon_mp7: "MP7",
            //     weapon_mp9: "MP9",
            //     weapon_nova: "Nova",
            //     weapon_p250: "P250",
            //     weapon_sawedoff: "Sawed-Off Shotgun",
            //     weapon_scar20: "SCAR-20 (CT Auto Sniper)",
            //     weapon_ssg08: "SSG 08 (Scout Sniper)",
            //     weapon_taser: "Taser",
            //     weapon_tec9: "Tec-9",
            //     weapon_usp_silencer: "USP-S",
            //     weapon_xm1014: "XM1014"
            // },

            HitsData: {
                labels: [],
                datasets: [
                    {
                        data: [],
                        backgroundColor: [
                            "#FF6900",
                            "#FCB900",
                            "#7BDCB5",
                            "#00D084",
                            "#8ED1FC",
                            "#0693E3",
                            "#ABB8C3",
                            "#EB144C",
                            "#F78DA7",
                            "#9900EF",
                        ],
                    },
                ],
            },

            MapsData: {
                labels: [],
                datasets: [
                    {
                        data: [],
                        backgroundColor: [
                            "#FF6900",
                            "#FCB900",
                            "#7BDCB5",
                            "#00D084",
                            "#8ED1FC",
                            "#0693E3",
                            "#ABB8C3",
                            "#EB144C",
                            "#F78DA7",
                            "#9900EF",
                        ],
                        hoverBorderWidth: 10,
                    },
                ],
            },

            MapCompareData: {
                labels: [],
                datasets: [
                    {
                        label: "Kills",
                        data: [],
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        borderColor: "rgb(255, 99, 132)",
                        borderWidth: 1,
                    },
                ],
            },

            map_name: "",
            map_badge: [],
            user: {},
            headers: [
                {
                    text: "Weapon Name",
                    align: "start",
                    sortable: false,
                    value: "classname",
                },
                { text: "Kills", value: "kills" },
            ],
            weapons: [],
        };
    },
    methods: {

        makeTable(){
            $(document).ready(function(){
                $('#table1').DataTable({
                    "pageLength": 5,
                    "lengthMenu": [5, 10],
                    order: [[1, 'desc']]
                });
            });
        },

        getMap(x) {
            // Map Mirage
            const maps = this.user.maps.filter(function (item) {
                return item.name_map == x;
            });

            if (maps.length > 0) {
                this.MapsData.datasets[0].data = [];
                this.map_name = x;
                for (var key in maps[0]) {
                    if (
                        key == "steam" ||
                        key == "name_map" ||
                        key == "playtime"
                    )
                        continue;
                    this.MapsData.datasets[0].data.push(maps[0][key]);
                }
                // console.log('map', this.MapsData);
                this.MapsData = _.cloneDeep(this.MapsData);
            }
        },
        convert_steam64(x) {
            let sid = new SteamID(x);
            return sid;
        },

        getSkillImage(user) {
            let link =
                "https://raw.githubusercontent.com/SteamDatabase/GameTracking-CSGO/0e457516ba13817a45b6c2a1d262fe7d0599bcbc/csgo/pak01_dir/resource/flash/econ/status_icons/skillgroup" +
                user.rank +
                ".png";
            return link;
        },
        genProfileLink(x) {
            x = this.convert_steam64(x);
            let profile = "http://steamcommunity.com/profiles/" + x + "/";
            return profile;
        },

        getTime(user) {
            let x = parseInt(user.lastconnect);
            let time = Date(x * 1000);
            return time;
        },

        getPlayTime(user) {
            if(!user.playtime)
                return

            const seconds = user.playtime;
            const hours = parseInt(seconds/3600);
            const minutes = parseInt((seconds%3600)/60);
            const sec = seconds%60;
            const result = hours+':'+minutes+':'+sec+' Hours';
            return result;
        },
        convertKD(tk, td) {
            let kd;
            kd = tk / td;
            kd = parseFloat(kd).toFixed(2);
            return kd;
        },

        getPercent(user, x) {
            let percent;

            if (x > 0) {
                percent = (x / user.kills) * 100;
                percent = parseFloat(percent).toFixed(2);
            } else {
                percent = 0;
            }

            return percent + "%";
        },

        getUser() {
            axios
                .get("api/user/" + this.$route.params.id)
                .then((response) => {
                    console.log('Data Fetched')
                    this.user = response.data;
                    this.weapons = response.data.weapons;
                    this.makeTable();

                    // Hits
                    for (var key in response.data.base_hits) {
                        if (
                            key == "SteamID" ||
                            key == "DmgHealth" ||
                            key == "DmgArmor"
                        )
                            continue;
                        if (response.data.base_hits.hasOwnProperty(key)) {
                            this.HitsData.labels.push(key);
                            this.HitsData.datasets[0].data.push(
                                response.data.base_hits[key]
                            );
                        }
                    }

                    if (response.data.maps.length > 0) {
                        // Maps
                        for (var key in response.data.maps) {
                            this.map_badge.push(
                                response.data.maps[key].name_map
                            );
                        }

                        // Map Mirage

                        this.map_name = response.data.maps[0].name_map;
                        for (var key in response.data.maps[0]) {
                            if (
                                key == "steam" ||
                                key == "name_map" ||
                                key == "playtime"
                            )
                                continue;

                            this.MapsData.labels.push(key);
                            this.MapsData.datasets[0].data.push(
                                response.data.maps[0][key]
                            );
                        }

                        // Maps Compare Kills
                        for (var key in response.data.maps) {
                            this.MapCompareData.labels.push(
                                response.data.maps[key].name_map
                            );
                            this.MapCompareData.datasets[0].data.push(
                                response.data.maps[key].kills
                            );
                        }
                    }
                })
                .catch(function (error) {
                    if (error.response) {
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    }
                });
        },
    },
};
</script>
