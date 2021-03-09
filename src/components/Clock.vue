<template>
    <div>
        <!-- {{ timePassed/1000 }} -->
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
            seconds: 0
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
        }
    },
     
    mounted() {
        var self = this;
        
        setInterval(function() {
            var _hours = document.querySelectorAll('.hours');
            var _minutes = document.querySelectorAll('.minutes');
            var _seconds = document.querySelectorAll('.seconds');

            self.setNumber(_hours[0], Math.floor(self.seconds/10));
            self.setNumber(_hours[1], self.seconds%10);

            self.setNumber(_minutes[0], Math.floor(self.seconds/10));
            self.setNumber(_minutes[1], self.seconds%10);


            self.setNumber(_seconds[0], Math.floor(self.seconds/10) );
            self.setNumber(_seconds[1], self.seconds%10);
            self.seconds++;
        }, 1000);
    }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.clock {
  height:200px;
  position:relative;
  /* top:50%; */
  /* left:50%; */
  width:900px;
  /* margin-left:-450px; */
  /* margin-top:-100px; */
  text-align:center;
}

.digit {
  width:80px;
  height:110px;
  margin:0 5px;
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
  width:10px;
  height:10px;
  background:#c00;
  border-radius:50%;
  display:inline-block;
  position:relative;
  /* top:-90px; */
}

.digit .segment:nth-child(1) {
  top:10px;
  left:20px;
  right:20px;
  height:5px;
}

.digit .segment:nth-child(2) {
  top:20px;
  right:10px;
  width:5px;
  height:75px;
  height:calc(50% - 25px);
}

.digit .segment:nth-child(3) {
  bottom:20px;
  right:10px;
  width:5px;
  height:75px;
  height:calc(50% - 25px);
}

.digit .segment:nth-child(4) {
  bottom:10px;
  right:20px;
  height:5px;
  left:20px;
}

.digit .segment:nth-child(5) {
  bottom:20px;
  left:10px;
  width:5px;
  height:75px;
  height:calc(50% - 25px);
}

.digit .segment:nth-child(6) {
  top:20px;
  left:10px;
  width:5px;
  height:75px;
  height:calc(50% - 25px);
}

.digit .segment:nth-child(7) {
  bottom:95px;
  bottom:calc(50% - 5px);
  right:20px;
  left:20px;
  height:5px;
}
</style>
