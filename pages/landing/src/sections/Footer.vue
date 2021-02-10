<template>
	<div id="app-footer">
        <div class='container-fluid' >
        <b-row>
            <b-col md='4'>
                <h4 >Quick Contact</h4>
                <p>65, Street, New York, MAC 5245<br>info@olivecrest.co<br>@olivecrest_priest</p>
            </b-col>
            <b-col md='2'>
                <h4>Quick Link</h4>
                <ul>
                    <li><a href='#'> Home </a></li>
                    <li><a href='#'> About us </a></li>
                    <li><a href='#'> Packages </a></li>
                    <li><a href='#'> FAQ </a></li>
                    <li><a href='#'> Contact Us </a></li>
                </ul>
            </b-col>
            <b-col md='2'>
                <h4>Office Locations</h4>
                <ul>
                    <li><a href="#">United States</a></li>
                    <li><a href="#">United Kingdom</a></li>
                    <li><a href="#">Singapore</a></li>
                    <li><a href="#">Canada</a></li>
                    <li><a href="#">Kuwait</a></li>
                </ul>
            </b-col>
            <b-col md='4'>
                <h4>Newsletter</h4><br>
                <p>Get latest updates and offers.</p>
                <form>
                    <input placeholder="Enter Your Email .." type="text" name="email">
                    <input type="submit" value=">>">
                </form>
                <div class="social-media">
                    X X X X
                </div>
            </b-col>
        </b-row>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Footer',
    components: {  }
};

</script>

<style scoped>
#app-footer {
    padding: 5rem 4%;
}
    a {
        color: white;
    }

    a:hover {
        color: yellow;
    }

    a:active {
        color: red;
    }
    ul {
        list-style: none;
    }

    ul li {
        text-align: left;
    }
</style>
