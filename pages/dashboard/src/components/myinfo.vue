<template>
  <div>
    <b-card >
      <h3>{{ name}}</h3>
      <h1>${{ amount }}</h1>
    </b-card>
  </div>
</template>
<script>

	export default {
		name : 'myinfo',
    props : {
      data : Object,
      name : String,
      amount : String
    }
	};
</script>

<style scoped>
h3 {
  font-size: 1rem;
}
</style>