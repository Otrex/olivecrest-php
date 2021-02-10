<template>
	<div id="app-currency">
        <h5>Currency Prices Live</h5>
        <b-row >
            <!-- {{ coin_datas }} -->
            <b-col cols='6' md='3' v-for='(coin_data, i) in coin_datas' :key='i'>
                <Coin :data='coin_data' />
            </b-col>
        </b-row>
       
    </div>
</template>

<script>
import Coin from '../components/Coin.vue'

export default {
    name: 'Learn',
    data: function() {
        return { 
            coin_datas : [
                {
                    name : 'Bitcoin (BTC)',
                    pricing: '11,394.03 USD',
                    rank: 1,
                    marketCap: '$210.99 B',
                    volume: '$23.40 B'
                }
            ]
        }
    },
    components: { 
        Coin
    },
    mounted(){
        axios.get('/get-coin-data')
        .then( res => {
            if (res.data.err) {
                console.log("Server Error")
                return
            }
            this.coin_datas = res.data;
        }).catch ( err => console.log(err));
    }
};

</script>

<style>
#app-currency {
    padding: 10rem 4%;
    text-align: left;
    font-size: 1.5rem;
    font-family: thasadith, sans-serif;
}

</style>
