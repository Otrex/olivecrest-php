<template>
	<div class="topnav">
		<b-container fluid>
			<b-row>
				<b-col cols='12' sm='6'>
					<div class="navigate"><h3> Dashboard &gt; {{route}} </h3></div>
				</b-col>

				<b-col cols='12' sm='6'>
					<div class="left-nv">
						<a href='#' > Buy Bitcoin </a>
						<a href='#'> Help Desk </a>
						<a @click='refresh' class='floater-btn circle'><icon i='arrow-counterclockwise' size='30' /> </icon>{{text || ''}} </a>
						<a href='/auth/logout' class='floater-btn'><icon i='box-arrow-right' size='30' /> </icon></a>
						<div class="avatar-img-container"><b-img style='background-color: grey;'></b-img></div>
						<a> {{detail ? detail : 'No User'}} </a>
					</div>
				</b-col>

			</b-row>
		</b-container>
			<hr/>
		<div class="info-cont"><marquee> <div v-if='!bitData'> No BitCoin Data Found </div><span v-if='bitData' v-for='(info, i) in bitData' :key='i'> <b>Name:</b> {{info.name}}({{info.asset_id}}) <b>Price:</b> {{info.price_usd}} <b>Volume today:</b> {{info.volume_1hrs_usd}} | </span></marquee></div>
	</div>
</template>
<script>
import icon from "../components/icon.vue"
import refreshBtn from '../components/refreshBtn.vue'
import { mapState, mapActions  } from 'vuex'
export default {
	name: 'TopNav',
	data() {
		return {
			bitData: [],
			text : null
		}
	},
	components : { refreshBtn, icon },
	computed : {
		...mapState(['profile']),
		route: function() {
			return this.$route.name
		},
		detail : function() {
			return this.profile.username
		}
	},

	created (){
		axios.get('/get-coin-data')
        .then( res => {
            if (res.data.err) {
                console.log("Server Error")
                return
            }
            this.bitData = res.data;
        }).catch ( err => console.log(err));
	},
	methods : {
		...mapActions([
			'get_profile',
			'get_account_overview', 'get_plans'
		]),

		refresh : function() {
			this.get_plans();
			this.get_profile();
			this.get_account_overview();
		},
	}

};
	
</script>
<style scoped>
.left-nv {
	height : 35px;
	display: table;
	float: right;
	text-align: right;
}

.left-nv a {
	display: table-cell;
	vertical-align: middle;
	padding-right: 5px;
}

.topnav {
	padding-top: 30px;
}

.navigate {
	display: table-cell;
	vertical-align: bottom;
	font-size: 1.5rem !important;
	font-weight: bold;
	height: 35px;
}

.navigate h3 {
	padding-bottom: 0px !important;
	line-height: 1.4rem;
}

.avatar {
	display: inline-block;
}
.avatar-img-container {
	display: inline-block;
	width: 35px;
	height: 35px;
	overflow: hidden;
	background-color: rgba(orange, 0.3);
	border-radius: 50%;
}

.avatar-img-container img {
	width: 35px;
	height: 35px;
}

</style>