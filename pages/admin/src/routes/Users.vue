<template>
  <div>
    <h2 v-if='!users' > No User Yet </h2>
    <a href='' > Create User </a>
    <a href='' v-if='moreusers' > Next Users </a>
    <a href='' > Delete all Users </a>
    <table border='1' style="width:100%;" >
      <th v-for='(head, i) in theader' :key='i'> {{head}} </th>
      <tr v-for='(data , i) in users' :key='i' >
        <td v-for='(value, key) in data' :key='key'> {{value}} </td>
        <td><a href=''> Edit </a> | <a href="" > Delete </a></td>
      </tr>
    </table>
  </div>
</template>

<script>
  export default {
    name: "Users",
    data() {
      return {
        users: [],
        moreusers : ''
      }
    },
    computed: {
      theader : function(){
        var ths = []
        if (this.users) {
          for(var x in this.users[0]){
            ths.push(x)
          }
        }
        return ths
      }
    },
    method : {
      getUsers : function(url) {
         axios.get(url)
          .then( res => {
            console.log(res.data)
            if (res.data.msg) {
              this.users = res.data.msg.data
              this.moreusers = res.data.msg.next_page_url
            }
            if (res.data.err) alert(res.data.err)
          })
          .catch( err => {
              if (err) alert (err)
          })
      }
    }, 
    created() {
      axios.get('/admin/users')
      .then( res => {
        console.log(res.data)
        if (res.data.msg) {
          this.users = res.data.msg.data
          this.moreusers = res.data.msg.next_page_url
        }
        if (res.data.err) alert(res.data.err)
      }).catch( err => {
        if (err) alert (err)
      })
    }
  };
</script>