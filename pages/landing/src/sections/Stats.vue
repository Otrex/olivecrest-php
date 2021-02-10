<template>
	<div id="app-stats">
       <b-row>
        <b-col cols = '6' md='3' v-for='(data , i) in stats' class='p-3' :key='i'>
            <b-card>
                <div class='icon' >
                    <icon i='house-fill' size='50' style='color: orange;' />
                </div>
                <div class="text-center">
                    <h2 style="font-weight: normal; "> {{ i | space }} </h2>
                    <h1> {{data}} </h1>
                </div>
            </b-card>
        </b-col>
       </b-row>
    </div>
</template>

<script>
import icon from '../components/icon.vue';

export default {
    name: 'Stats',
    data: function() {
        return { 
            stats : {
                Days : 1222,
                Total_Investment : 1003994,
                Total_Withdraw : 234565432,
                Visitors : 1111
            }
        }
    },
    filters: {
        space : function(v) {
            if (!v) return ''
            return v.replace('_', ' ');
        }
    },
    components: { 
        icon
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
#app-stats {
    padding: 10rem 4%;
    text-align: left;
    font-size: 1.5rem;
    font-family: thasadith, sans-serif;
}

.icon {
    text-align: center;
}

</style>
