<template>
	<div id="app-about">
        <div >
            <b-row>
                <b-col md='8'>
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
                <b-col cols='12' md='4'>
                    <b-card>
                        <h2>Secure Wallet</h2>
                        Trade and invest with 100% peace of mind as we have the best system security team onboard.
                    </b-card>
                </b-col>
                <b-col cols='12' md='4'>
                    <b-card>
                        <h2>Instant Exchange</h2>
                        See your investments turn to profit in real time. We guarantee you maximum returns on investments
                    </b-card>
                </b-col>
                <b-col cols='12' md='4'>
                    <b-card>
                        <h2>Expert Support</h2>
                        We provide you the standard of customer care service that cannot be matched with any other.
                    </b-card>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>

export default {
    name: 'About',
    components: {  }
};

</script>

<style>
#app-about {
    text-align: left;
    font-family: thasadith, sans-serif;
    font-size: 1.5rem;
}
#app-about .about {
    padding: 80px 1rem;
}

#app-about h2, #app-about h5 {
    font-family: Righteous, Helvetica, Arial, sans-serif;
}
</style>
