<template>
  <div :class='rfcontrol'>
    <b-modal
      id="modal-msg-box"
      ref="modal"
      v-model='rcontrol'
      :title="title"
      @show="resetModal"
      @hidden="resetModal"
      @ok="handleOk"
    >
    <slot></slot>
    </b-modal>
  </div>
</template>

<script>
  export default {
    props : {
      control : Boolean,
      title : String,
      label : String,
      invalidfeedback : String,
      action : Function
    },
    computed : {
      rfcontrol : function() {
        this.rcontrol = this.control;
        return 'on'
      },
    },
    data() {
      return {
        show : false,
        rcontrol : null,
        data : '',
        nameState: null,
        submittedNames: []
      }
    },
    methods: {
      resetModal(){
        return
      },
      handleOk(bvModalEvt) {
        // Prevent modal from closing
        bvModalEvt.preventDefault()
        // Trigger submit handler
        this.handleSubmit()
      },
      handleSubmit() {
        // Exit when the form isn't valid
        this.rcontrol = false
        if (this.action){
          if (!this.action()) return;
        }
        // Hide the modal manually
        this.$nextTick(() => {
          this.$bvModal.hide('modal-msg-box')
        })
      }
    }
  };
</script>