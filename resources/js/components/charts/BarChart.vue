<script>
  import { Bar } from 'vue-chartjs'
  export default {
    extends: Bar,
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