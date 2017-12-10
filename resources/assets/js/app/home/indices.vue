<template>
    <div class="content-inner">
        <div class="chart-layer">
            <p class="ttl">market summary <span>indecies</span></p>
            <div class="row">
                <div class="col-md-offset-3">
                    <div class="col-md-1"><a href="#" @click.prevent="setPeriod('day')">1 day</a></div>
                    <div class="col-md-1"><a href="#" @click.prevent="setPeriod('month')">1 month</a></div>
                    <div class="col-md-1"><a href="#" @click.prevent="setPeriod('3 months')">3 month</a></div>
                    <div class="col-md-1"><a href="#" @click.prevent="setPeriod('year')">1 year</a></div>
                    <div class="col-md-1"><a href="#" @click.prevent="setPeriod('5 years')">5 years</a></div>
                    <div class="col-md-1"><a href="#" @click.prevent="setPeriod('max')">max</a></div>
                </div>
            </div>
            <chart :data="chartData" :labels="chartLabels" :period="period" :selected-index="selectedIndex" v-if="history"></chart>
        </div>

        <div class="data-wrap">
            <table class="data-table">
                <tbody>
                    <tr class="top" v-for="item in indices">
                        <td class="name">
                            <a href="#" @click.prevent="setSelectedIndex(item)">{{ item.name }}</a>
                        </td>
                        <td>{{ item.current_value }}</td>
                        <td class="last decr" :class="{'inc': item.different.index > 0}">
                            <p>
                                <i class="fa fa-caret-down" :class="{'fa-caret-up': item.different.index > 0}"></i>
                                {{ item.different.index }}
                            </p>
                            <span>({{ item.different.percent }}%)</span>
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
                //chartData: [],
                //chartLabels: []
            }
        },

        mounted() {
            this.getIndices()
        },

        methods: {
            getIndices() {
                axios.get('/indices').then(response => {
                    this.selectedIndex = response.data[0]
                    this.indices = response.data;
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
                    this.history = response.data

                    //this.chartData = response.data.dataSet
                    //this.chartLabels = response.data.labels
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
            chartData() {
                return _.flatMap(this.history, 'value');
            },
            chartLabels() {
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
