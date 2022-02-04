<script>
import { Pie, mixins } from "vue-chartjs";

export default {
    extends: Pie,
    mixins: [mixins.reactiveProp],
    props: ["chartData", "options"],

    data() {
        return {
            PieOptions: {
                legend: {
                    display: true,
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: "Custom Chart Title",
                },
            },
        };
    },
    mounted() {
        this.renderChart(this.chartData, this.options);
    },
};
</script>
