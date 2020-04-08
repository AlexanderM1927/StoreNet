import { Doughnut, mixins } from 'vue-chartjs'

export default {
  extends: Doughnut,
  props: ['data'],
  mounted () {
    this.renderChart(this.data)
  },
  watch: {
    data(){
        this.renderChart(this.data)
     }
  }
}