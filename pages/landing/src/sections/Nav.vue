<template>
	<div id="nav">
        <div >
          <nav ref='navi' :class="{ 'nav--hidden': !showNavbar }">
            <b-container fluid>
              <b-row>

                <b-col cols='2' class='small-screen'>
                        <label class='hmenu' for="check"> 
                            <icon :i='iconname' size='25' />
                        </label>
                        <input id='check' type="checkbox" @click='checkd = !checkd' class="sidecheck" />
                    <ul class='nav-small'>
                      <li><a href="#app-home"> Home </a></li>
                      <li><a href="#app-about"> About-Us </a></li>
                      <li><a href="#app-contact"> Contact-Us </a></li>
                      <li><a href="#app-hwork"> How We Work </a></li>
                      <li><a href="#app-benefit"> Benefits </a></li>
                      <li><a href="#app-plans"> Plans </a></li>
                    </ul>
                </b-col>


                <b-col cols='4' class='f' md='3'>
                  <div class="logo">
                    <img src='/img/logo5.png' v-show='logosrc'/>
                    <img src='/img/logo4.png' v-show='!logosrc' />
                  </div>
                </b-col>


                <b-col cols='4' md='6' class='full-screen'>
                  <ul class='nav-sections'>
                    <li><a href="#app-home"> Home </a></li>
                    <li><a href="#app-about"> About-Us </a></li>
                    <li><a href="#app-contact"> Contact-Us </a></li>
                    <li><a href="#app-hwork"> How We Work </a></li>
                    <li><a href="#app-benefit"> Benefits </a></li>
                    <li><a href="#app-plans"> Plans </a></li>
                  </ul>
                  
                </b-col>


                <b-col cols='6' md='3' >
                  <div class="nbtn-container">
                  <a href="#/login" class="nbtn login"> Login </a>
                  <a href="#/register" class="nbtn signup"> Sign-Up </a>
                  </div>
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
          checkd: false,
          logosrc : false,
          showNavbar: true,
        lastScrollPosition: 0
        }
      },
      computed: {
        iconname : function() {
          if (this.checkd) {
            this.showNavbar = false
            this.logosrc = true
            return "x"
          }
          return "list"
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
      if (this.checkd) this.logosrc = true;
    // current scroll position and last scroll position is less than some offset
      if (Math.abs(currentScrollPosition - this.lastScrollPosition) < 60) {
        return
      }
      // Here we determine whether we need to show or hide the navbar
      this.showNavbar = !this.logosrc;
      // this.showNavbar = currentScrollPosition < this.lastScrollPosition
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
    padding-top: 25px;
    transition: all .3s;
}
/** {border: 1px solid black;}*/
.nav-sections {
  margin-top: 6px;
}

.nav-sections li {
  display: inline-block;
  margin-right: 5px;
}
.nav-sections li::last-child {
  margin-right: 0px;
}
.nav--hidden {
  box-shadow: 2px 0px 5px grey;
  transform: translateY(-20px);
  background-color: orange;
  padding-bottom: .5rem;
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
  transform: translateY(-2px);
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
@media screen and (max-width: 470px) {
  .f {
    width: 100% !important;
    display: block !important;
  }
}
@media screen and (max-width: 760px) {
  .small-screen {
    display: block;
    text-align: left;
  }
  .nav-small {
    max-height: 0px;
    position: absolute;
    left:0px;
    top: 5.4rem;
    text-align: center;
    transition: all .3s;
    background-color: orange;
    width: 600%;
    box-shadow: 0px 3px 5px rgba(10,10,10, .2);
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
  .nbtn:hover {
    box-shadow: 0px 2px 3px rgba(10,10,10,.3);
    transform: translateY(2%);
    text-decoration: none;
  }
  .logo img {
    display: inline-block;
    margin: 0px;
    transform: translateX(-35px);
  }
   label:hover {
    background-color: white;
   }
  label {
    display: inline-block;
    background-color: rgba(12,12,12,.15);
    padding: 5px 5px 0px 5px;
    color: orange;
    border-radius: 5px;
    margin: auto 0px;
    margin-top: 10px;
    /*transform: translateY(50%);*/
  }
  input[type='checkbox'] {
      display: none;
  }
  input[type='checkbox']:checked ~ .nav-small {
    min-height:100%;
    max-height: 100vh;
  }
  .nbtn {
    margin: 0px;
  }
  .nbtn-container {
    text-align: right;
    padding-top: 0px;
  }
}

.nbtn-container {
  padding-top: 10px;
}

.nbtn {
  display: inline-block;
  padding: 3px 15px;
  border-radius: 20px;
  border: 2px solid white;
  color: white;
  transition: all .2s;
  margin-bottom: 7px;
}

.nbtn:hover {
  box-shadow: 0px 2px 3px rgba(10,10,10,.3);
  transform: translateY(-2px);
  text-decoration: none;
}

.nbtn.signup {
  background-color: white;
  color: orange !important;
}
</style>
