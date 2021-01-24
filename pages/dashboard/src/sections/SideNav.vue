
<template>
  	<div id='sidenav'>
        <label class='nav-item' for="check"> 
          <img src='/img/logo1.svg' style='width:35px; height:35px;' /> 
        </label>
        <input id='check' type="checkbox" v-model='sidenav.is_open' class="sidecheck" />
        <div class="fold text " > <img src='/img/logo4.svg' style='width:auto;height:35px;' /></div>
        <nav>
          <h4 class='text' style="margin-top: 30px;"> Dashboard </h4>
          <hr  />
          <ul class="nav">
            <li class="nav-item">
              <router-link to='/' class='nav-link'>
                <icon i="house-door-fill" size='25'/><div class='text' > Home </div>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to='/plans' class='nav-link'>
                <icon i="wallet-fill" size='25'/><div class='text' > Investment Plans </div>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to='/profile' class='nav-link'>
                <icon i='person-fill' size='25'/><div class='text' > My Profile </div>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to='/transactions' class='nav-link'>
                <icon i='journal-text' size='25'/><div class='text' > Transactions </div>
              </router-link>
            </li>
          </ul>

          <h4 class='text'> Other Features </h4>
          <hr />
          <ul class="nav">
            <li class="nav-item">
              <router-link to='/make-transaction' class='nav-link'> 
                <icon i='credit-card-2-front-fill' size='25' /><div class='text' > Make Transaction </div>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to='/settings' class='nav-link'>
                <icon i="gear-fill" size='25'/><div class='text' > Settings </div>
              </router-link>
            </li>
           <!--  <li class="nav-item">
              <router-link to='/profile' class='nav-link'>
                <icon i='person-fill' size='25'/><div class='text' > Home </div>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to='/transactions' class='nav-link'>
                <icon i='journal-text' size='25'/><div class='text' > Home </div>
              </router-link>
            </li> -->
          </ul>

        </nav>

  	</div>
</template>
<script >
  import icon from '../components/icon.vue'

  export default {
    	name : 'SideNav',
      data () {
        return {
          sidenav : {is_open:false},
        }
      },
    	components : {
        icon
      }
  };
</script>
<style scoped>
  a {
    color: inherit;
    padding: 10px;
  }
  a:hover {
    background-color: black;
    color: orange;
  }
  a:active {
    background-color: white;
    color: black;
  }
  .nl {
    display: block;
  }
  * {    
    transition: all .5s;
  }
  ul li {
    width: 100%;
  }
  div.sidenav {
    background-color: orange;
  }
  .text {
    position: absolute;
    left: -100%;
    font-size: 1.4rem;
    display: inline-block;
    opacity: 0;
    padding-left:5px;
    vertical-align: middle;
  }
  .fold {
    margin-left: 0px !important;
    padding-right: 20px !important;
  }
  label, .fold.text {
    /*background-color: rgba(12,12,12,.2);*/
    background-color: rgba(255,255,255, .5);
    padding: 1px;
    margin: 7px auto;
    margin-right: 0px;
    margin-left: 3px;
    border-radius: 5px;
    display: inline-block;
  }
  nav {
    width: 50px;
    position: relative;
  }
  input[type='checkbox'] {
    display: none;
  }
  input[type='checkbox']:checked ~ nav {
    width:100%;
  }
  input[type='checkbox']:checked ~ .text,
  input[type='checkbox']:checked ~ nav .text,
  input[type='checkbox']:checked ~ nav ul li .text {
    position: relative;
    left: 0px;
    opacity: 1;
  }
</style>