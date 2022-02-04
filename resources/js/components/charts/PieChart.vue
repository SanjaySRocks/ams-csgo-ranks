<script>
import { Pie, mixins } from "vue-chartjs";

export default {
    extends: Pie,
    mixins: [mixins.reactiveProp],
    props: ["chartData"],

    data() {
        return {
            options: {
                legend: {
                    display: true,
                },
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: false,
                    text: "Custom Chart Title",
                },
            },
        };
    },
    mounted() {
        // i can't see you wath data change
        this.renderChart(this.chartData, this.options);
    },
    watch: {
        chartData () {
            //this._chart.destroy()
            this.renderChart(this.chartData, this.options)
        }
    }
};
</script>
