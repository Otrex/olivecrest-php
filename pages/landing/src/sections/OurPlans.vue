
<template>
    <div class='ourplans' >
        <b-row>
            <b-col cols='12' v-for='(plan , i) in plans' :key='i' sm='6' class='p-3' md='4'>
                <b-card >
                    <h1> {{plan.name}} </h1>
                    <div class='xx-h1'> {{plan.percent_returns}} </div>
                    <p> {{plan.desc}} </p>
                    <ul v-html='plan.feat'></ul>
                </b-card>
            </b-col>
        </b-row>
    </div>
</template>

<script>

export default {
    name: 'OurPlans',
    components: {  },
    data(){
        return {
            plans : []
        }
    },
    created(){
        axios.get('/investment-plans')
        .then( res => {
            if (res.data.msg) this.plans = res.data.msg
            if (res.data.err) console.log(res.data.err)
        })
        .catch( err => {
            if (err) console.log(err)
        })
    }
};

</script>

<style>
    .ourplans {
        padding: 5rem 4%;
    }
    .xx-h1 {
        font-size: 6rem;
        font-weight: bolder;
    }
</style>
