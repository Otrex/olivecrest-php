<template>
	<div id="nav">
        <div >
          <nav ref='navi' :class="{ 'nav--hidden': !showNavbar }">
            <b-container fluid>
              <b-row>
                <b-col cols='4' md='3'>
                  <div class="logo">
                    <img src='/img/logo5.png' v-show='logosrc'/>
                    <img src='/img/logo4.png' v-show='!logosrc' />
                  </div>
                </b-col>
                <b-col cols='12' md='6' class='full-screen'>
                  <ul class='nav-sections'>
                    <li><a href="#app-home"> Home </a></li>
                    <li><a href="#app-about"> About-Us </a></li>
                    <li><a href="#app-contact"> Contact-Us </a></li>
                    <li><a href="#app-hwork"> How We Work </a></li>
                    <li><a href="#app-benefit"> Benefits </a></li>
                    <li><a href="#app-plans"> Plans </a></li>
                  </ul>
                  
                </b-col>
                <b-col cols='4' md='3' style="padding-top:16px;">
                  <a href="#/login" class="btn btn-primary"> Login </a>
                  <a href="#/register" class="btn btn-secondary"> Sign-Up </a>
                </b-col>
                <b-col cols='4' class='small-screen'>
                    
                    <label class='nav-item' for="check"> 
                        <icon i='list' size='35' />
                    </label>
                    <input id='check' type="checkbox" class="sidecheck" />
                    <ul class='nav-small'>
                      <li><a href="#app-home"> Home </a></li>
                      <li><a href="#app-about"> About-Us </a></li>
                      <li><a href="#app-contact"> Contact-Us </a></li>
                      <li><a href="#app-hwork"> How We Work </a></li>
                      <li><a href="#app-benefit"> Benefits </a></li>
                      <li><a href="#app-plans"> Plans </a></li>
                    </ul>
                </b-col>
              </b-row>
            </b-container>
          </nav>
        </div>
    </div>
</template>

<script>
import icon from '../components/icon.vue';
export default {
    name: 'Nav',
    data(){
      return {
        logosrc : false,
        showNavbar: true,
      lastScrollPosition: 0
      }
    },
    components: { icon },
    methods: {
      onScroll () {
    // Get the current scroll position
    const currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop
    // Because of momentum scrolling on mobiles, we shouldn't continue if it is less than zero
    if (currentScrollPosition < 0) {
      return
    }
    this.logosrc = false
    if (currentScrollPosition > 60){
      this.logosrc = true
     // Stop executing this function if the difference between
    }
  // current scroll position and last scroll position is less than some offset
    if (Math.abs(currentScrollPosition - this.lastScrollPosition) < 60) {
      return
    }
    // Here we determine whether we need to show or hide the navbar
    this.showNavbar = currentScrollPosition < this.lastScrollPosition
    // Set the current scroll position as the last scroll position
    this.lastScrollPosition = currentScrollPosition
  }
    },
    mounted () {
      window.addEventListener('scroll', this.onScroll)
    },
    beforeDestroy () {
      window.removeEventListener('scroll', this.onScroll)
    }
};

</script>

<style scoped>
nav {
      min-height: 50px;
    padding-top: 50px;
  transition: all .5s;
}
.nav-sections {
  margin-top: 8px;
}
.nav-sections li {
  display: inline-block;
}
.nav--hidden {
  box-shadow: 2px 0px 5px grey;
  transform: translateY(-45px);
  background-color: orange;
}
.nav--hidden ul li a:hover {
  color:white;
}
.nav-sections li a, .nav-small li a {
  display: block;
  padding: 8px;
  border-radius: 5px;
  color: inherit;
  transition: all .3s;
}
.nav-sections li a:hover, .nav-small li a:hover {
 /* background-color: orange;*/
  color: orange;
  transform: translateY(-5px);
  text-decoration: none;
}
.logo img{
  width: auto;
  height: 50px;
  margin-bottom: 8px;
}

.small-screen {
  display: none;
}

@media screen and (max-width: 760px) {
  .small-screen {
    display: block;
  }
  .nav-small {
    max-height: 0px;
    position: absolute;
    left:0px;
    transition: all .3s;
    background-color: orange;
    width: 100%;
    overflow: hidden
  }
  .nav-small li {
    display: block;
  }
  .nav-small li:hover {
    background-color: black;
  }
  .full-screen {
    display: none;
  }
  label {
    background-color: rgba(12,12,12,.2);
    padding: 5px 5px 2px 5px;
    margin: 7px auto;
    margin-left: 8px;
    border-radius: 5px;
  }
  input[type='checkbox'] {
      display: none;
  }
  input[type='checkbox']:checked ~ .nav-small {
    min-height:100%;
    max-height: 100vh;
  }
}
</style>
