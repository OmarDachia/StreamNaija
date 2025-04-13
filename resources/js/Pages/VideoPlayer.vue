<!-- <template>
    <div class="video-player">
    <video
      :src="src"
      controls
      classs="w-full max-w-3xl rounded shadow"
      class="video-js vjs-big-play-centered"
      :poster="poster"
    >
    </video>
  </div>
  </template>
  
  <script setup>
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

  </style> -->

  <template>
    <div class="video-player-container">
      
      <video
        ref="videoElement"
        :src="src"
        :poster="poster"
        class="video-js vjs-big-play-centered"
        @click="togglePlay"
        @timeupdate="updateProgress"
        tabindex="0"
        @keydown="handleContainerKeyDown"
      >
        Fail to loading video, please click here to return home.
        <button class="button is-medium" @click="goBack()">Home</button>
      </video>
      
      <div class="video-controls" :class="{ 'controls-visible': showControls }">
        <div class="progress-container" @click="seekVideo">
          <div class="progress-bar" :style="{ width: progress + '%' }"></div>
          <div class="progress-buffer" :style="{ width: bufferProgress + '%' }"></div>
        </div>
        
        <div class="controls-row">
          <button class="control-btn" @click="togglePlay">
            <i :class="[isPlaying ? 'fas fa-pause' : 'fas fa-play']"></i>
          </button>
          
          <div class="volume-control">
            <button class="control-btn" @click="toggleMute">
              <i :class="[isMuted ? 'fas fa-volume-mute' : volumeLevelClass]"></i>
            </button>
            <input
              type="range"
              min="0"
              max="1"
              step="0.01"
              v-model="volume"
              class="volume-slider"
              @input="updateVolume"
            />
          </div>
          
          <div class="time-display">
            {{ currentTimeFormatted }} / {{ durationFormatted }}
          </div>
          
          <button class="control-btn fullscreen-btn" @click="toggleFullscreen">
            <i :class="[isFullscreen ? 'fas fa-compress' : 'fas fa-expand']"></i>
          </button>
        </div>
      </div>

      <p id="videoControlsDesc" class="sr-only">
        Keyboard controls: Space or K to play/pause, M to mute, F for fullscreen,
        Arrow left/right to skip 5 seconds, Arrow up/down to adjust volume,
        0-9 to jump to percentage
      </p>
    </div>
  </template>
  
  <script setup>
  import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
  import 'video.js/dist/video-js.css';
  import '@fortawesome/fontawesome-free/css/all.css';
  
  const props = defineProps({
    src: String,
    poster: String
  });
  
  const videoElement = ref(null);
  const isPlaying = ref(false);
  const isMuted = ref(false);
  const volume = ref(0.7);
  const currentTime = ref(0);
  const duration = ref(0);
  const progress = ref(0);
  const bufferProgress = ref(0);
  const isFullscreen = ref(false);
  const showControls = ref(true);
  let controlsTimeout;
  
  const goBack = () => {
    router.visit("/"); // Or your appropriate back route
  };

  const handleContainerKeyDown = (e) => {
    // Prevent double handling when focus is on container
    if ([' ', 'f', 'm', 'k'].includes(e.key)) {
      e.preventDefault();
    }
  };

  // Computed properties
  const volumeLevelClass = computed(() => {
    if (volume.value === 0) return 'fas fa-volume-off';
    if (volume.value < 0.5) return 'fas fa-volume-down';
    return 'fas fa-volume-up';
  });
  
  const currentTimeFormatted = computed(() => {
    return formatTime(currentTime.value);
  });
  
  const durationFormatted = computed(() => {
    return formatTime(duration.value);
  });
  
  // Methods
  const togglePlay = () => {
    if (isPlaying.value) {
      videoElement.value.pause();
    } else {
      videoElement.value.play();
    }
    isPlaying.value = !isPlaying.value;
    resetControlsTimer();
  };
  
  const toggleMute = () => {
    isMuted.value = !isMuted.value;
    videoElement.value.muted = isMuted.value;
    resetControlsTimer();
  };
  
  const updateVolume = (e) => {
    videoElement.value.volume = volume.value;
    isMuted.value = volume.value === 0;
    resetControlsTimer();
  };
  
  const updateProgress = () => {
    if (!videoElement.value) return;
    currentTime.value = videoElement.value.currentTime;
    duration.value = videoElement.value.duration;
    progress.value = (currentTime.value / duration.value) * 100;
    
    // Calculate buffered progress
    if (videoElement.value.buffered.length > 0) {
      const bufferedEnd = videoElement.value.buffered.end(videoElement.value.buffered.length - 1);
      bufferProgress.value = (bufferedEnd / duration.value) * 100;
    }
  };
  
  const seekVideo = (e) => {
    if (!videoElement.value) return;
    
    // Use video element's width if clicking on video itself
    const target = e.currentTarget.classList.contains('video-js') 
      ? videoElement.value
      : e.currentTarget;
      
    const rect = target.getBoundingClientRect();
    const pos = Math.max(0, Math.min(1, (e.clientX - rect.left) / rect.width));
    
    // Ensure duration is available
    const seekTime = pos * (duration.value || videoElement.value.duration || 0);
    
    if (!isNaN(seekTime)) {
      videoElement.value.currentTime = seekTime;
      progress.value = pos * 100;
      resetControlsTimer();
    }
  };
  
  const toggleFullscreen = () => {
    if (!document.fullscreenElement) {
      videoElement.value.parentElement.requestFullscreen().catch(err => {
        console.error(`Error attempting to enable fullscreen: ${err.message}`);
      });
      isFullscreen.value = true;
    } else {
      document.exitFullscreen();
      isFullscreen.value = false;
    }
    resetControlsTimer();
  };
  
  const resetControlsTimer = () => {
    showControls.value = true;
    clearTimeout(controlsTimeout);
    controlsTimeout = setTimeout(() => {
      if (isPlaying.value) {
        showControls.value = false;
      }
    }, 3000);
  };
  
  const formatTime = (seconds) => {
    const minutes = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
  };
  
  // Lifecycle hooks
  onMounted(() => {
    videoElement.value.volume = volume.value;
    
    videoElement.value.addEventListener('loadedmetadata', () => {
      duration.value = videoElement.value.duration;
    });
    
    videoElement.value.addEventListener('waiting', () => {
      // Show loading state if needed
    });
    
    videoElement.value.addEventListener('playing', () => {
      isPlaying.value = true;
      resetControlsTimer();
    });
    
    videoElement.value.addEventListener('pause', () => {
      isPlaying.value = false;
      showControls.value = true;
      clearTimeout(controlsTimeout);
    });
    
    document.addEventListener('fullscreenchange', () => {
      isFullscreen.value = !!document.fullscreenElement;
    });
    
    // Hide controls when mouse leaves player
    videoElement.value.parentElement.addEventListener('mouseleave', () => {
      if (isPlaying.value) {
        showControls.value = false;
      }
    });
    
    // Show controls when mouse enters player
    videoElement.value.parentElement.addEventListener('mouseenter', () => {
      showControls.value = true;
      resetControlsTimer();
    });

    videoElement.value.addEventListener('loadedmetadata', () => {
      duration.value = videoElement.value.duration;
    });
    
    videoElement.value.addEventListener('durationchange', () => {
      duration.value = videoElement.value.duration;
    });

    const handleKeyDown = (e) => {
      if (!videoElement.value) return;
      
      switch (e.key) {
        case ' ':
        case 'k':
          e.preventDefault();
          togglePlay();
          break;
        case 'm':
          e.preventDefault();
          toggleMute();
          break;
        case 'f':
          e.preventDefault();
          toggleFullscreen();
          break;
        case 'ArrowLeft':
          e.preventDefault();
          skip(-5); // 5 seconds back
          break;
        case 'ArrowRight':
          e.preventDefault();
          skip(5); // 5 seconds forward
          break;
        case 'ArrowUp':
          e.preventDefault();
          adjustVolume(0.1); // Increase volume
          break;
        case 'ArrowDown':
          e.preventDefault();
          adjustVolume(-0.1); // Decrease volume
          break;
        case '0':
        case '1':
        case '2':
        case '3':
        case '4':
        case '5':
        case '6':
        case '7':
        case '8':
        case '9':
          e.preventDefault();
          seekToPercentage(Number(e.key) * 0.1); // Jump to 0%, 10%, etc.
          break;
      }
    };
  });
  
  // window.addEventListener('keydown', handleKeyDown);

  onBeforeUnmount(() => {
    clearTimeout(controlsTimeout);
    // window.removeEventListener('keydown', handleKeyDown);
  });

  const skip = (seconds) => {
    videoElement.value.currentTime += seconds;
    resetControlsTimer();
  };

  // Adjust volume by delta
  const adjustVolume = (delta) => {
    volume.value = Math.max(0, Math.min(1, volume.value + delta));
    videoElement.value.volume = volume.value;
    resetControlsTimer();
  };

  // Seek to percentage of video (0-1)
  const seekToPercentage = (percent) => {
    videoElement.value.currentTime = percent * duration.value;
    resetControlsTimer();
  };
  </script>
  
  <style scoped>
  .sr-only {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border-width: 0;
    }

    .video-player-container:focus {
      outline: 2px solid #f40612;
      outline-offset: 2px;
    }

    .control-btn:focus {
      outline: 2px solid white;
      outline-offset: 2px;
    }

  .video-player-container {
    position: relative;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    background: #000;
    border-radius: 8px;
    overflow: hidden;
  }
  
  video {
    width: 100%;
    height: auto;
    display: block;
    cursor: pointer;
  }
  
  .video-controls {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
    padding: 10px 15px;
    transform: translateY(100%);
    transition: transform 0.3s ease;
  }
  
  .controls-visible {
    transform: translateY(0);
  }
  
  .progress-container {
    position: relative;
    height: 5px;
    margin-bottom: 10px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
    cursor: pointer;
  }
  
  .progress-bar {
    position: absolute;
    height: 100%;
    background: #ff0000;
    border-radius: 3px;
    z-index: 2;
    transition: width 0.1s linear;
  }
  
  .progress-buffer {
    position: absolute;
    height: 100%;
    background: rgba(255, 255, 255, 0.4);
    border-radius: 3px;
    z-index: 1;
    transition: width 0.3s ease;
  }
  
  .controls-row {
    display: flex;
    align-items: center;
    gap: 15px;
  }
  
  .control-btn {
    background: transparent;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    padding: 5px;
    transition: all 0.2s ease;
  }
  
  .control-btn:hover {
    color: #ff0000;
    transform: scale(1.1);
  }
  
  .volume-control {
    display: flex;
    align-items: center;
    gap: 5px;
  }
  
  .volume-slider {
    width: 80px;
    height: 4px;
    appearance: none;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 2px;
    outline: none;
    opacity: 0;
    transition: opacity 0.3s ease, width 0.3s ease;
  }
  
  .volume-control:hover .volume-slider {
    opacity: 1;
  }
  
  .volume-slider::-webkit-slider-thumb {
    appearance: none;
    width: 12px;
    height: 12px;
    background: #ff0000;
    border-radius: 50%;
    cursor: pointer;
  }
  
  .time-display {
    color: white;
    font-size: 14px;
    margin-left: auto;
    margin-right: 10px;
  }
  
  .fullscreen-btn {
    margin-left: auto;
  }
  </style>