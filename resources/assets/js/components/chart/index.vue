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
                options: options
            }
        },

        props: ['data', 'labels'],

        mounted() {
            this.initChart()
        },

        methods: {
            initChart() {
                this.options.data.datasets[0].data = this.data
                this.options.data.labels = this.labels

                this.chart = new Chart(document.getElementById('index'), this.options);
            }
        },

        watch: {
            data: 'initChart'
        }
    }
</script>
