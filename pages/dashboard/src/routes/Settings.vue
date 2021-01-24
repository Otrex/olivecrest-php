<template>
	<div id="investment">
		<form class="form">
			<div class="form-group" v-for='(data, key) in profile' :key='key'>
				<label :for='key'>{{key}}</label>
				<input type="text" :id='key' class="form-control" v-model='form[key]' :placeholder="data" /> 
			</div>
		</form>
	</div>
</template>
<script>
import { mapState, mapActions } from 'vuex'

	export default {
		name : 'Settings',
		data() {
			return {
				form : {}
			}
		},
		computed : {
			...mapState({
				userdata: 'profile'
			}),
			profile : function(){
				delete this.userdata.user_id;
				return this.userdata
			}
		},
		methods : {
			modal : function(i){
				console.log(i)
				this.show_modal = !this.show_modal
				this.modal_data_link = i
			},
			set : function(data){
				this.datas = data
			}
		},
		created(){
			self = this
			axios.get('/api/plans')
			.then(function (response) {
				self.datas = response.data;
		    })
		    .catch(e=>alert(e));
		},
	};
</script>

<style scoped>
	label {
		font-size: 1.2rem;
	}
	.cards {
		width: 50%;
		padding: 20px 20px;
		display: inline-block;
	}
	.cards::nth-child(2) {
		padding: 20px 0px;
	}
</style>