<script setup>
import { Head, Link } from '@inertiajs/vue3';
import BaseLayout from '@/Components/BaseLayout.vue';
import VideoPlayer from '@/Pages/VideoPlayer.vue';
import { computed,  ref, onMounted } from 'vue';

defineOptions({ layout: BaseLayout})

const props = defineProps({
    video: Object,
});

const videoUrl = computed(() => '/storage/'+props.video.video_url);
const posterUrl = computed(() => '/storage/'+props.video.thumbnail_url || 'storage/images/fallback.jpg');

// onMounted(async () => {
//     console.log(props.video);
//     videoUrl = `/storage/${props.video.video_url}`;

//     console.log(videoUrl);
    
// });	
// const videoUrl = `/storage/${props.filename}`;
</script>

<template>
    <Head title="Latest Videos" />
    <div class="page-content">
        <section id="video" class="content-section">
            <div class="row">
                <div class="col-md-12">
                    <VideoPlayer :src="videoUrl"/>
                </div>
            </div>
        </section>
    </div>
</template>
