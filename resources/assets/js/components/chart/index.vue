<template>
    <div>
        <div class="graph__container">
            <canvas :id="'index'" width="1140" height="300"></canvas>
        </div>
    </div>
</template>

<script>
    import options from './options'

    export default {
        data() {
            return {
                options: options,
                chart: {}
            }
        },

        props: ['data', 'labels', 'period', 'selectedIndex'],

        mounted() {
            this.initChart()
        },

        methods: {
            initChart() {
                this.options.data.datasets[0].data = this.data
                this.options.data.datasets[0].label = this.selectedIndex.name
                this.options.data.labels = this.labels
                this.options.options.period = this.period

                this.chart = new Chart(document.getElementById('index'), this.options);
            },
            updateChart() {
                this.chart.destroy();

                this.initChart()
            }
        },

        watch: {
            data: 'updateChart'
        }
    }
</script>
