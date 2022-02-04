<script>
import { Doughnut } from "vue-chartjs";
export default {
    extends: Doughnut,
    props: ["data", "options"],

    data() {
        return {
            DoughnutOptions: {
                legend: {
                    display: true,
                },
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: "Custom Chart Title",
                    },
                },
            },
        };
    },
    mounted() {
        this.renderChart(this.data, this.options);
    },
};
</script>
