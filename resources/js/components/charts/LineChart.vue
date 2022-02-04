<script>
  import { Line } from 'vue-chartjs'
  export default {
    extends: Line,
    props: ["data", "options"],
    
    data(){
      return{
        LineOptions: {
          legend: {
            display: true
          },
          responsive: true,
          maintainAspectRatio: false,
          title: {
                display: true,
                text: 'Custom Chart Title'
            }
        },
      }
    },
    mounted () {
      this.renderChart(this.data, this.options)
    }
  }
</script>