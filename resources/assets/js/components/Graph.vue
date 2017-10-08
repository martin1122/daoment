<template>
  <div :id="handle" :class="classes">
    <h1 class="graph__title">{{ index.name }} Index</h1>
    <div class="graph__description" v-html="index.description"></div>

    <h3>24 Hour History</h3>
    <div class="graph__container">
      <canvas :id="'graph-' + index.id" width="1140" height="140"></canvas>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['index'],
    computed: {
      chartData() {
        return _.flatMap(this.index.history, 'value');
      },
      chartLabels() {
        return _.flatMap(this.index.history, 'created_at');
      },
      classes() {
        var classes = ['graph', 'tab-pane'];
        if (this.index.position == 1) {
          classes.push('active');
        }
        return classes.join(' ');
      },
      handle() {
        return this.index.name.toLowerCase().replace(/[^a-z-]+/, '-');
      }
    },
    mounted() {
      var self = this;
      var ctx = document.getElementById(`graph-${self.index.id}`);
      self.chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: self.chartLabels,
          datasets: [{
            label: false,
            data: self.chartData,
            fill: false,
            lineTension: 0.1,
            borderColor: '#470481'
          }]
        },
        options: {
          legend: {
            display: false
          },
          scales: {
            // yAxes: [{
            //   display: false
            // }],
            xAxes: [{
              display: false
            }]
          }
        }
      });
    }
  }
</script>
