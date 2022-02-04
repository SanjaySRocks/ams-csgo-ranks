<script>
  import { Bar } from 'vue-chartjs'
  export default {
    extends: Bar,
    props: ["data", "options"],
    
    data(){
      return{
        BarOptions: {
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