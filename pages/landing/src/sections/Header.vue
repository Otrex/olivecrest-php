<template>
	<div id="app-home">
            <b-row>
                <b-col cols='12' md='6' class='pad'>
                  <div class="header-text">
                   <h5>Welcome to Olivecrest</h5>
                   <h1>Get max profit<br>from your Investment</h1>
                   <h3 class="header2">Trade with confidence with one of the worlds best crypto investment Company</h3>
                   <br>
                   <router-link to='/signup' class='action-btn left'  > Get Started Now </router-link>
                 </div>
                </b-col>
                <b-col cols='12' md='6' class='img-cont ' >
                  <img src="/img/crypto1.svg" class="img-fluid">
                </b-col>
            </b-row>
    </div>
</template>

<script>

export default {
    name: 'Home',
    components: {  }
};

</script>

<style >
#app-home {
   /*background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0));*/
   padding: 10rem 4%;
   height: 550px;
}
.img-cont {
  padding-top: 4rem;
}
.img-cont img {
  width: 100%;
  height: auto;
}
.pad {
  padding-top: 10rem;
}
#app-home h5 {
  font-size: 3rem;
    margin-bottom: 10px;
}
#app-home .left {
    text-align: left;
}

#app-home.jumbotron {
    padding: 80px 0px;
}

#app-home h1 {
    font-size: 5rem;
    line-height: 4.5rem;
    margin-bottom: 15px;
}
.header-text {
  /*position: absolute;
  bottom: 20vh;*/
  padding-left: 30px;
  margin: auto 0px;
}
.header-text * {
  text-align: left !important;
}
.action-btn {
  display: inline-block;
  color: black;
  background-color: orange;
  padding: 8px 1.2rem;
  float: left;
  border-radius: 5px;
  transition: all .2s;
}

.action-btn:hover {
  background-color: black;
  text-decoration: none !important;
  color: orange;
  transform: translateY(-2px);
}

.header2 {
  line-height: 2.5rem !important;

}
</style>
