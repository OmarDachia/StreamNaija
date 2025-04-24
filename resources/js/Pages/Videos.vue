<script setup>
import { Head, Link } from '@inertiajs/vue3';
import BaseLayout from '@/Components/BaseLayout.vue';
import VideoPlayer from '@/Components/VideoPlayer.vue';
import { computed,  ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

defineOptions({ layout: BaseLayout})

const props = defineProps({
    video: Object,
});

const videoUrl = computed(() => '/storage/'+props.video.video_url);
const posterUrl = computed(() => '/storage/'+props.video.thumbnail_url || 'storage/images/fallback.jpg');

onMounted(async () => {
    
    if (!hasValidSource.value) {
      goBack();
    }
    
});	

const hasValidSource = computed(() => {
    return props.video && props.video !== null && props.video.video_url !== undefined;
  });

  // Redirect back function
  const goBack = () => {
    router.visit("/"); // Or your appropriate back route
  };
// const videoUrl = `/storage/${props.filename}`;
</script>

<template>
    <Head title="Latest Videos" />
    <div class="page-content">
        <section id="video" class="content-section">
            <div class="row">
                <div class="col-md-12">
                    <div v-if="hasValidSource">
                        <VideoPlayer :src="videoUrl" class="video-player"/>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>
    .video-container {
        width: 100%;
        height: 100%;  /* Or specific height like 70vh */
        margin: 0;
        padding: 0;
    }

    .video-wrapper {
        padding: 0 !important;  /* Remove any padding */
        position: relative;
    }

    .video-player {
        width: 100%;
        height: 100%;
        object-fit: cover;  /* Maintain aspect ratio while filling container */
    }
</style>
