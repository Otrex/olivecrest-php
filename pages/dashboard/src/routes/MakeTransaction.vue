<template>
	<div id="investment">
		<b-card-group class='space'>
			<b-card header='Credit'>
				<b-card-text>
					This is to add more funds to your Account
					<table>
						<tr>
							<td style="width: 60%;"> Bitcoin </td>
							<td><b-button @click='show_qr("bitcoin")'> Get QR code </b-button></td>
						</tr>
						<tr>
							<td> Ethereum </td>
							<td><b-button @click='show_qr("ethereum")'> Get QR code </b-button></td>
						</tr>
						<tr>
							<td> Litecoin </td>
							<td><b-button @click='show_qr("litecoin")'> Get QR code </b-button></td>
						</tr>
						<tr>
							<td> Bitcoin Cash </td>
							<td><b-button @click='show_qr("bitcoincash")'> Get QR code </b-button></td>
						</tr>
						<tr>
							<td> USDC </td>
							<td><b-button @click='show_qr("usdc")'> Get QR code </b-button></td>
						</tr>
						<tr>
							<td> DAI </td>
							<td><b-button @click='show_qr("dai")'> Get QR code </b-button></td>
						</tr>
					</table>
					<!-- <div v-if='addresses'>
						<table border="1" style="width: 100%;"  v-for='(ad , i) in addresses' :key='i'>
							<tr>
								<td> Bitcoin </td><td> {{ad.bitcoin}} </td>
								<td><b-button @click='show_qr("bitcoin",ad.bitcoin)'> Get QR code </b-button></td>
							</tr>
							<tr>
								<td> Ethereum </td><td> {{ad.ethereum}} </td>
								<td><b-button @click='show_qr("ethereum", ad.ethereum)'> Get QR code </b-button></td>
							</tr>
							<tr>
								<td> Litecoin </td><td> {{ad.litecoin}} </td>
								<td><b-button @click='show_qr("litecoin",ad.litecoin)'> Get QR code </b-button></td>
							</tr>
							<tr>
								<td> Bitcoin Cash </td><td> {{ad.bitcoincash}} </td>
								<td><b-button @click='show_qr("bitcoincash",ad.bitcoincash)'> Get QR code </b-button></td>
							</tr>
							<tr>
								<td> USDC </td><td> {{ad.usdc}} </td>
								<td><b-button @click='show_qr("usdc", ad.usdc)'> Get QR code </b-button></td>
							</tr>
							<tr>
								<td> DAI </td><td> {{ad.dai}} </td>
								<td><b-button @click='show_qr("dai", ad.dai)'> Get QR code </b-button></td>
							</tr>
						</table>
					</div> -->
				</b-card-text>
			</b-card>

			<b-card header='Debit' >
				<b-card-text>
					This is to add more funds to your Account
				</b-card-text>
			</b-card>
		</b-card-group>

		<modal title='QR-CODE' :action='resetmodal' :control='showmodal'>
			<div class="text-center">
				<h1> {{type}} </h1>
				<img :src='qr_src' />
				<p> {{bit_addr}}</p>
			</div>
		</modal>
	</div>
</template>
<script>

import axios from 'axios';
import modal from '../components/modal.vue';
import { mapState, mapMutations, mapActions } from 'vuex'

const loader = require('../../../loader');

	export default {
		name : 'MakeTransaction',
		data : function() {
			return {
				type : '',
				showmodal : false,
				bit_addr: '',
				qr_src : '',
				addresses : [],
			}	
		},
		methods : {
			...mapActions(['alert']),

			credit : function() {
				loader.showloader()
				axios.post('/transact/create-charge', {...this.form})
				.then(res => {
					loader.hideloader()
					// console.log(res.data)
					if ('err' in res.data) {
						this.alert({bs :this.$bvModal, info: 'Connection to Crypto-Payment-Gateway Failed'});
						return;
					}
					this.addresses = res.data.msg;
					this.alkey = true;
				})
				.catch(err => {
					loader.hideloader()
					if (err) this.alert({bs: this.$bvModal, info:err});
				})
			},
			show_qr : function(type) {
				if (!this.alkey) this.credit()
				if (!this.alkey) {
					this.alert({bs :this.$bvModal, info: 'No Addresses Loaded..., Try Again...'})
					return
				}
		        this.qr_src = `https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=${type}:${this.addresses[type]}&choe=UTF-8`
		        this.bit_addr = this.addresses[type];
		        this.showmodal = true
		        this.type = type
			},

			resetmodal : function(){
				this.showmodal =false
			}
		},

		components : {
			modal
		}
	};
</script>

<style scoped>
	.cards {
		width: 50%;
		padding: 20px 20px;
		display: inline-block;
	}
	.space {
		padding: 0px 50px;
	}
	.card {
		transition: .3s;
	}
	.card:hover {
		transform: scale(1.1);
		z-index: 3;
		box-shadow: 0px 0px 15px rgba(0,0,0,.2);
	}
	.cards::nth-child(2) {
		padding: 20px 0px;
	}
</style>