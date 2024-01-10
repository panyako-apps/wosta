
<script setup>
const props = defineProps({
    text: {
        type:String, 
        default: 'Loading...'
    },

    hasText: {
        type: Boolean,
        default: false
    }

});

</script>

<template>
    <div class="flex flex-col items-center">
        <div class="spin"></div>
        <div v-if="hasText" class="mt-6">
            {{text}}
        </div>
    </div>

</template>

<style>
@keyframes spinner {
        0% {
          transform: translate3d(-50%, -50%, 0) rotate(0deg);
        }
        100% {
          transform: translate3d(-50%, -50%, 0) rotate(360deg);
        }
      }
      .spin::before {
        animation: 1.5s linear infinite spinner;
        animation-play-state: inherit;
        border: solid 5px #cfd0d1;
        border-bottom-color: #0369a1;
        border-radius: 50%;
        content: "";
        height: 40px;
        width: 40px;
        position: absolute;
        /* top: 10%;
        left: 10%; */
        transform: translate3d(-50%, -50%, 0);
        will-change: transform;
      }
</style>