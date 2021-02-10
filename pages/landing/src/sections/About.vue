<template>
	<div id="app-about">
        <div class="ab-holder" >
            <b-row>
                <b-col md='6' >
                    <div class="img-holder" >
                        <img src="/img/Investment_SVG.svg" style="height: 400px;" />
                    </div>
                </b-col>
                <b-col md='6'>
                    <div class="about">
                        <h5>What is Olivecrest</h5>
                        <p class="info-1" >Olivecrest’s innovative trading platforms and tools provide the power and reliability you need to feel more confident in your trading.</p>
                        <p class="info-2" >Olivecrest is an International Investment company, officially registered in Singapore, it was launched in October 2019. The company has direct contracts with professional traders and miners around the world that guarantees the best services and ensures profits are made and remitted to investors daily.</p> 
                    </div>
                </b-col>
            </b-row>
        </div> 
        <div >
            <b-row>
                <b-col cols='12' class='p-3' md='4'>
                    <b-card class="pad">
                        <div class='icon' >
                            <icon i='wallet-fill' size='50' style='color: orange;' />
                        </div>
                        <h2>Secure Wallet</h2>
                        Trade and invest with 100% peace of mind as we have the best system security team onboard to guarantee you.
                    </b-card>
                </b-col>
                <b-col cols='12'class='p-3' md='4'>
                    <b-card class="pad">
                        <div class='icon' >
                            <icon i='exclude' size='50' style='color: orange;' />
                        </div>
                        <h2>Instant Exchange</h2>
                        See your investments turn to profit in real time. We guarantee you maximum returns on your investment.
                    </b-card>
                </b-col>
                <b-col cols='12'class='p-3' md='4'>
                    <b-card class="pad">
                        <div class='icon' >
                            <icon i='bullseye' size='50' style='color: orange;' />
                        </div>
                        <h2>Expert Support</h2>
                        We provide you the standard of customer care service that cannot be matched with any other.
                    </b-card>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>
import icon from '../components/icon.vue'
export default {
    name: 'About',
    components: { icon }
};

</script>

<style scoped>
#app-about {
    background: rgba(255 ,165 ,0 ,0.1);
    padding: 15rem 5% 10rem 5% !important;
    text-align: left;
    font-size: 1.5rem;
}
#app-about .about {
    padding: 80px 1rem;
}

#app-about h2, #app-about h5 {
    font-family: Righteous, Helvetica, Arial, sans-serif;
}

.icon {
    display: block;
    text-align: center;
}

.ab-holder {
    margin-bottom: 8rem;
}
.pad h2 {
    text-align: center;
}


</style>
