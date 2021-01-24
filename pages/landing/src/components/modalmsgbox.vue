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
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group
          :label="label"
          label-for="m-input"
          :invalid-feedback="invalidfeedback"
          :state="nameState"
        >
          <b-form-input
            id="m-input"
            v-model="data"
            :state="nameState"
            required
          ></b-form-input>
        </b-form-group>
      </form>
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
      }
    },
    data() {
      return {
        rcontrol : null,
        name: '',
        data : '',
        nameState: null,
        submittedNames: []
      }
    },
    methods: {
      checkFormValidity() {
        const valid = this.$refs.form.checkValidity()
        this.nameState = valid
        return valid
      },
      resetModal() {
        this.data = ''
        this.nameState = null
        this.rcontrol = null
      },
      handleOk(bvModalEvt) {
        // Prevent modal from closing
        bvModalEvt.preventDefault()
        // Trigger submit handler
        this.handleSubmit()
      },
      handleSubmit() {
        // Exit when the form isn't valid
        if (!this.checkFormValidity()) {
          return
        }
        // Push the name to submitted names
        this.submittedNames.push(this.name)
        let valid = this.action(this.data)
        if (!valid) {
          this.nameState = valid
          return
        };
        // Hide the modal manually
        this.$nextTick(() => {
          this.$bvModal.hide('modal-msg-box')
        })
      }
    }
  };
</script>