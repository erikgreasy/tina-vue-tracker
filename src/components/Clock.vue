<template>
    <div>
        <!-- https://www.cssscript.com/animated-digital-led-clock-with-javascript-and-css/ -->
        <div class="clock">
        <div class="digit hours">
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
        </div>

        <div class="digit hours">
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
        </div>

        <div class="separator"></div>

        <div class="digit minutes">
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
        </div>

        <div class="digit minutes">
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
        </div>

        <div class="separator"></div>

        <div class="digit seconds">
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
        </div>

        <div class="digit seconds">
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
            <div class="segment"></div>
        </div>
        </div>
    </div>
</template>

<script>
export default {
    
    name: 'Clock',
    props: [
        'timePassed'
    ],
    watch: {
      timePassed: function(oldVal, newVal) {
        console.log(oldVal)
        if(newVal != null) {
          this.setClock(newVal);
        } else {
          this.setClock(oldVal)
        }

        console.log(oldVal)
      }
    },
    data() {
        return {

            digitSegments: [
                [1,2,3,4,5,6],
                [2,3],
                [1,2,7,5,4],
                [1,2,7,3,4],
                [6,7,2,3],
                [1,6,7,3,4],
                [1,6,5,4,3,7],
                [1,2,3], 
                [1,2,3,4,5,6,7],
                [1,2,7,3,6]
            ],
        }
    },
    methods: {
        setNumber(digit, number) {
            var segments = digit.querySelectorAll('.segment');
            var current = parseInt(digit.getAttribute('data-value'));

            // only switch if number has changed or wasn't set
            if (!isNaN(current) && current != number) {
                // unset previous number
                this.digitSegments[current].forEach(function(digitSegment, index) {
                setTimeout(function() {
                    segments[digitSegment-1].classList.remove('on');
                }, index*45)
                });
            }
            
            if (isNaN(current) || current != number) {
                // set new number after
                var self = this;
                setTimeout(function() {
                    self.digitSegments[number].forEach(function(digitSegment, index) {
                        setTimeout(function() {
                        segments[digitSegment-1].classList.add('on');
                        }, index*45)
                    });
                }, 250);
                digit.setAttribute('data-value', number);
            }
        },
        setClock(seconds) {
            var _hours = document.querySelectorAll('.hours');
            var _minutes = document.querySelectorAll('.minutes');
            var _seconds = document.querySelectorAll('.seconds');

            var self = this;

            let hours = Math.floor(seconds/360);
            seconds -= 360*hours;

            let minutes = Math.floor(seconds/60);
            seconds = seconds - 60*minutes;

            self.setNumber(_hours[0], Math.floor(hours/10));
            self.setNumber(_hours[1], hours%10);

            self.setNumber(_minutes[0], Math.floor(minutes/10));
            self.setNumber(_minutes[1], minutes%10);

            self.setNumber(_seconds[0], Math.floor(seconds/10) );
            self.setNumber(_seconds[1], seconds%10);
        }
    },

}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.clock {
  /* height:200px; */
  position:relative;
  width:100%;
  text-align:center;
  margin-bottom: 30px;
}

.digit {
  width:50px;
  height:70px;
  margin:0;
  position:relative;
  display:inline-block;
}

.digit .segment {
  background:#c00;
  border-radius:5px;
  position:absolute;
  opacity:0.05;
  transition:opacity 0.2s;
  -webkit-transition:opacity 0.2s;
  -ms-transition:opacity 0.2s;
  -moz-transition:opacity 0.2s;
  -o-transition:opacity 0.2s;
}

.digit .segment.on, .separator {
  opacity:1;
  box-shadow:0 0 50px rgba(255,0,0,0.7);
  transition:opacity 0s;
  -webkit-transition:opacity 0s;
  -ms-transition:opacity 0s;
  -moz-transition:opacity 0s;
  -o-transition:opacity 0s;
}

.separator {
  width:5px;
  height:5px;
  background:#c00;
  border-radius:50%;
  display:inline-block;
  position:relative;
  /* top:-90px; */
}

.digit .segment:nth-child(1) {
  top:10px;
  left:15px;
  right:15px;
  height: 3px;
}

.digit .segment:nth-child(2) {
  top:15px;
  right:10px;
  width:3px;
  height:50px;
  height:calc(50% - 20px);
}

.digit .segment:nth-child(3) {
  bottom:14px;
  right:10px;
  width:3px;
  height:75px;
  height:calc(50% - 20px);
}

.digit .segment:nth-child(4) {
  bottom:10px;
  right:15px;
  height:3px;
  left:15px;
}

.digit .segment:nth-child(5) {
  bottom:15px;
  left:10px;
  width:3px;
  height:75px;
  height:calc(50% - 20px);
}

.digit .segment:nth-child(6) {
  top:20px;
  left:10px;
  width:3px;
  height:75px;
  height:calc(50% - 20px);
}

.digit .segment:nth-child(7) {
  bottom:95px;
  bottom:calc(50% - 5px);
  right:15px;
  left:15px;
  height:3px;
}
</style>
