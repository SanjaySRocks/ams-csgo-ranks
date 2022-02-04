<script>
  import { Line } from 'vue-chartjs'
  export default {
    extends: Line,
    props: ["data"],
    
    data(){
      return{
        options: {
          legend: {
            display: true
          },
          responsive: true,
          maintainAspectRatio: false,
          title: {
                display: false,
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