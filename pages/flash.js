
const Vue = require('vue');

export default {
	install( Vue, options) {
		Vue.prototype.$msgalert = function(msg, bs, action, params=[]){

			bs.msgBoxOk(msg, {
	          title: 'Confirmation',
	          size: 'sm',
	          buttonSize: 'sm',
	          okVariant: 'success',
	          headerClass: 'p-2 border-bottom-0',
	          footerClass: 'p-2 border-top-0',
	          centered: true
	        })
	          .then(value => {
	          	if (action){
	          		action(...params)
	          	}
	          })
	          .catch(err => {
	            // An error occurred
	            console.log(err)
	          })
		}

		Vue.mixin({ 
			created() {
				console.log('Working')
			}
		})
	}
}