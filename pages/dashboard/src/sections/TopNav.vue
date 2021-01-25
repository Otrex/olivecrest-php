<template>
	<div class="topnav">
		<b-container fluid>
			<b-row>
				<b-col cols='12' sm='6'>
					<span class="navigate"> Dashboard &gt; {{route}} </span>
				</b-col>
				<b-col cols='12' sm='6' style='text-align:right;'>
					<b-button > Buy Bitcoin </b-button>
					<b-button > Help Desk </b-button>
					<div class="avatar">
						<div class="avatar-img-container">
							<img src='#'>
						</div>
						<div class="avatar-details">
							<span> {{detail ? detail : 'No User'}} </span>
						</div>
					</div>
				</b-col>
			</b-row>
		</b-container>
		<div class="info-cont"><marquee> <span v-for='(info, i) in bitData' :key='i'> <b>Name:</b> {{info.name}}({{info.asset_id}}) <b>Price:</b> {{info.price_usd}} <b>Volume today:</b> {{info.volume_1hrs_usd}} | </span></marquee></div>
		<hr/>
	</div>
</template>
<script>
import { mapState } from 'vuex'
export default {
	name: 'TopNav',
	data() {
		return {
			bitData: []
		}
	},
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
	}
};
	
</script>
<style scoped>

.topnav {
	padding-top: 30px;
}
.navigate {
	font-size: 1.5rem !important;
	font-weight: bold;
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
.avatar-details {
	vertical-align: middle;
	display: inline-block;
}
.avatar-details span {
	padding-bottom: 5px;
}

</style>