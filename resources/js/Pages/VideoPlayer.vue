<template>
    <div class="video-player">
    <video
      :src="src"
      controls
      classs="w-full max-w-3xl rounded shadow"
      class="video-js vjs-big-play-centered"
      :poster="poster"
    >
      <!-- <source :src="src" /> -->
      <!-- Your browser does not support the video tag. -->
    </video>
  </div>
  </template>
  
  <script setup>
  import videojs from 'video.js';
  import 'video.js/dist/video-js.css';
  import '@videojs/http-streaming';
  import { defineProps } from 'vue';
  
  const videoUrl = '/videos/me.mp4';
  
    defineProps({
      src: String,
      poster: String
    });
  </script>
  
  <style>
  .video-player {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 60vh;
  }

  .video-js {
      width: 100%;
      height: 100%;
      min-height: 400px; /* Minimum height */
  }

  </style>