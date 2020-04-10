import { Line } from 'vue-chartjs'

export default {
  extends: Line,
  props: ['data1'],
  mounted () {
    this.renderChart(this.data1)
  },
  watch: {
    data1(){
        this.renderChart(this.data1)
     }
  }
}