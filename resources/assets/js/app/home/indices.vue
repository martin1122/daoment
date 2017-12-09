<template>
    <div class="content-inner">
        <div class="chart-layer">
            <p class="ttl">market summary <span>indecies</span></p>
            <div class="row">
                <div class="col-md-offset-3">
                    <div class="col-md-1"><a href="#" @click.prevent="setPeriod('day')">1 day</a></div>
                    <div class="col-md-1"><a href="#" @click.prevent="setPeriod('month')">1 month</a></div>
                    <div class="col-md-1"><a href="#" @click.prevent="setPeriod('-3 month')">3 month</a></div>
                    <div class="col-md-1"><a href="#" @click.prevent="setPeriod('-1 year')">1 year</a></div>
                    <div class="col-md-1"><a href="#" @click.prevent="setPeriod('-5 years')">5 years</a></div>
                    <div class="col-md-1"><a href="#">max</a></div>
                </div>
            </div>
            <chart :data="chartData" :labels="chartLabels" v-if="history"></chart>
        </div>

        <div class="data-wrap">
            <table class="data-table">
                <tbody>
                    <tr class="top" v-for="item in indices">
                        <td class="name"><a href="#" @click.prevent="setSelectedIndex(item)">{{ item.name }}</a></td>
                        <td>2629.27</td>
                        <td class="last inc decr">
                            <p><i class="fa fa-caret-down"></i> -0.30</p>
                            <span>(-0.01%)</span>

                            <p><i class="fa fa-caret-up"></i> 27.9</p>
                            <span>(0.48%)</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import Chart from '../../components/chart/index.vue'

    export default {
        data() {
            return {
                indices: [],
                selectedIndex: {},
                history: [],
                period: 'day',
                format: '',
                chartData: [],
                chartLabels: []
            }
        },

        mounted() {
            this.getIndices()
        },

        methods: {
            getIndices() {
                axios.get('/indices').then(response => {
                    this.indices = response.data;
                    this.selectedIndex = this.indices[0]
                });

                /*setInterval(() => {
                  this.getIndices();
                }, 15000);*/
            },


            getIndexHistory() {
                var params = {
                    params: {
                        period: this.period
                    }
                }

                axios.get('/indices/' + this.selectedIndex.id + '/chart', params).then(response => {
                    this.chartData = response.data.dataSet
                    this.chartLabels = response.data.labels
                });
            },

            setSelectedIndex(index) {
                this.selectedIndex = index
            },

            setPeriod(period) {
                this.period = period
            }
        },

        computed: {
            chartData2() {
                return _.flatMap(this.history, 'value');
            },
            chartLabels2() {
                return _.flatMap(this.history, 'created_at');
            },
        },

        watch: {
            selectedIndex: 'getIndexHistory',
            period: 'getIndexHistory',

        },

        components: { Chart }
    }
</script>
