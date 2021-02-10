<!-- <template>
	<div id='testimonies'>
		<b-row>
			<b-col v-for='t in data' :key='t.name'>
				<b-card>
					<div><h2>{{t.name}}</h2></div>
					<div>{{t.testimony}}</div>
				</b-card>
			</b-col>
		</b-row> 
	</div>
</template>
<script>

export default {
	name: 'Testimonies',
	props: {
        data: Array
	},
	components: {}
}

</script>
<style scoped>
	#testimonies {

	}
</style> -->

<template>
  <div>
    <b-carousel
      id="carousel-1"
      v-model="slide"
      :interval="4000"
      controls
      indicators
      :img-width="fullwidth"
      img-height="480"
      style="text-shadow: 1px 1px 2px #333;"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
    >
      <!-- Text slides with image -->
      <!-- Slides with img slot -->
      <!-- Note the classes .d-block and .img-fluid to prevent browser default image alignment -->
      <b-carousel-slide v-for='(ts , i) in data' :key='i'>
        <template #img>
        	<b-row>
        		<b-col cols='12' sm='6' md='4' class='p-3'>
        			<b-card style='min-height: 250px;' class='pad'>
        				<div class="text-center">
	        				<b-img rounded='circle' style='height:80px; width:80px;' src='/img/logo1.svg'></b-img>
	        			</div>
						<div style="margin-top: 40px;">{{ts[0].testimony}}</div>
						<div><h2>--{{ts[0].name}}</h2></div>
				    </b-card>
        		</b-col>
        		<b-col cols='12' sm='6' md='4' class='p-3'>
        			<b-card style='min-height: 250px;' class='pad'>
        				<div class="text-center">
	        				<b-img rounded='circle' style='height:80px; width:80px;' src='/img/logo1.svg'></b-img>
	        			</div>
						<div style="margin-top: 40px;">{{ts[1].testimony}}</div>
						<div><h2>--{{ts[1].name}}</h2></div>
				    </b-card>
        		</b-col>
        		<b-col cols='12' sm='6' md='4' class='p-3'>
        			<b-card style='min-height: 250px;' class='pad'>
        				<div class="text-center">
	        				<b-img rounded='circle' style='height:80px; width:80px;' src='/img/logo1.svg'></b-img>
	        			</div>
						<div style="margin-top: 40px;">{{ts[2].testimony}}</div>
						<div><h2>--{{ts[2].name}}</h2></div>
				    </b-card>
        		</b-col>
            </b-row>
        </template>
      </b-carousel-slide>
    </b-carousel>

    <p class="mt-4">
      Testimonies Set: {{ slide + 1 }}
    </p>
  </div>
</template>

<script>
  export default {
  	name: 'Testimonies',
  	props : {
  		data: Array
  	},
    data() {
      return {
        slide: 0,
        sliding: null
      }
    },
    computed : {
    	fullwidth : function() {
    		return window.innerWidth;
    	}
    },
    methods: {
      onSlideStart(slide) {
        this.sliding = true
      },
      onSlideEnd(slide) {
        this.sliding = true
      }
    }
  };
</script>