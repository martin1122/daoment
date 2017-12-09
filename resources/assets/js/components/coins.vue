<template>
    <div>
        <div class="head-info-block" v-for="coin in coins">
            <div class="top-info clearfix">
                <span class="pull-left">{{ coin.data.symbol }} / {{ coin.convert }}</span>
                <span class="pull-right">{{ coin.data['price_' + coin.convert.toLowerCase()] }}</span>
            </div>
            <div class="persent green" :class="{red: coin.data.percent_change_1h < 0}">
                <i class="fa fa-angle-down" v-if="coin.data.percent_change_1h < 0"></i>
                <i class="fa fa-angle-up" v-else></i>
                <span class="main">{{ coin.data.percent_change_1h }}%</span>
                <span>0.00057</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                coins: []
            }
        },

        mounted() {
            this.getCurrencies()

        },

        methods: {
            getCurrencies() {
                axios.get('coins').then(response => {
                    this.coins = response.data
                })
            },
        },
    }
</script>
