<template>
	<div id="app-hwork">
		<h5>How it work</h5>
		<p><i>Dynamically procrastinate B2C users after installed base benefits dramatically</i></p>

		<div >
            <b-row>
                <b-col cols='12' md='4' class='p-3'>
                    <b-card class="pad">
                         <div class='icon' >
                            <icon i='door-open-fill' size='50' style='color: orange;' />
                        </div>
                        <h2>Open Free Account</h2>
                        Starting off with our platform is pretty simple. The first step to get started is to simply create a free account on the platform
                    </b-card>
                </b-col>
                <b-col cols='12' class='p-3' md='4'>
                    <b-card class="pad">
                         <div class='icon' >
                            <icon i='file-person-fill' size='50' style='color: orange;' />
                        </div>
                        <h2>Activate Your Account</h2>
                        All new members are required to verify their email before their accounts can be enabled for use. This should be done within 24hrs.
                    </b-card>
                </b-col >
                <b-col cols='12' class='p-3' md='4'>
                    <b-card class="pad">
                         <div class='icon' >
                            <icon i='file-arrow-up-fill' size='50' style='color: orange;' />
                        </div>
                        <h2>Grow Your Fund & Enjoy</h2>
                        Once you have created account and ctivated your email. You are ready to get started on the journey to financial freedom.
                    </b-card>
                </b-col>
            </b-row>
        </div>

	</div>
</template>

<script>
import icon from '../components/icon.vue'
export default {
    name: 'Hwork',
    components: { icon }
};

</script>

<style>

#app-hwork {
    padding: 5rem 4%;
    text-align: left;
    font-family: thasadith, sans-serif;
    font-size: 1.5rem;
}

#app-hwork h5, #app-hwork h2, #app-hwork h1, #app-hwork h3 {
    font-family: Righteous, Helvetica, Arial, sans-serif;
}


.icon {
    display: block;
    text-align: center;
    margin-bottom: 18px;
}

</style>
