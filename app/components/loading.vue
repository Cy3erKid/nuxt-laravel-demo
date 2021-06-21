<template>
   <div class="loading" v-if="loading">
      <div class="spinner">
         <div class="bounce1"></div>
         <div class="bounce2"></div>
         <div class="bounce3"></div>
      </div>
    </div>
</template>
<script>
export default {
    data() {
       return {
          loading: false
       }
    },
    methods: {
        start(){
            this.loading = true;
        },
        finish(){
            this.loading = false;
        }
    },
};
</script>
<style scoped>
.loading{
   position: fixed;
   z-index: 9999;
   width: 100%;
   height: 100%;
   display: block;
   margin: 0 auto;
   background: #0f0e9f;
}
.spinner {
   margin: 100px auto 0;
   width: 100%;
   text-align: center;
   position: absolute;
   display: block;
   top: 35%;

}

.spinner > div {
   width: 18px;
   height: 18px;
   background-color: #fff;

   border-radius: 100%;
   display: inline-block;
   -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
   animation: sk-bouncedelay 1.4s infinite ease-in-out both;
}

.spinner .bounce1 {
   -webkit-animation-delay: -0.32s;
   animation-delay: -0.32s;
}

.spinner .bounce2 {
   -webkit-animation-delay: -0.16s;
   animation-delay: -0.16s;
}

@-webkit-keyframes sk-bouncedelay {
   0%,
   80%,
   100% {
      -webkit-transform: scale(0);
   }
   40% {
      -webkit-transform: scale(1);
   }
}

@keyframes sk-bouncedelay {
   0%,
   80%,
   100% {
      -webkit-transform: scale(0);
      transform: scale(0);
   }
   40% {
      -webkit-transform: scale(1);
      transform: scale(1);
   }
}
</style>
