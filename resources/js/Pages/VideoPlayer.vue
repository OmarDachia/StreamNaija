<template>
    <div data-vjs-player>
      <video
        ref="videoElement"
        class="video-js vjs-big-play-centered"
        controls
        preload="auto"
        :poster="poster"
      >
        <source :src="videoSrc" type="application/x-mpegURL">
      </video>
    </div>
  </template>
  
  <script>
  import videojs from 'video.js';
  import 'video.js/dist/video-js.css';
  import '@videojs/http-streaming';
  
  export default {
    props: {
      videoSrc: {
        type: String,
        required: true
      },
      poster: {
        type: String,
        default: ''
      }
    },
    mounted() {
      this.player = videojs(this.$refs.videoElement, {
        html5: {
          vhs: {
            overrideNative: true,
            enableLowInitialPlaylist: true,
            smoothQualityChange: true,
            maxPlaylistRetries: 3
          }
        },
        autoplay: false,
        controls: true,
        responsive: true,
        fluid: true
      });
      
      // Handle errors
      this.player.on('error', () => {
        const error = this.player.error();
        console.error('VideoJS Error:', error);
      });
    },
    beforeUnmount() {
      if (this.player) {
        this.player.dispose();
      }
    }
  };
  </script>
  
  <style>
  .video-js {
    width: 100%;
    height: 100%;
  }
  </style>