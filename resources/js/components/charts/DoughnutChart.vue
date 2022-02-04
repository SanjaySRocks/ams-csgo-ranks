<script>
import { Doughnut } from "vue-chartjs";
export default {
    extends: Doughnut,
    props: ["data"],

    data() {
        return {
            options: {
                legend: {
                    display: true,
                },
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: false,
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
