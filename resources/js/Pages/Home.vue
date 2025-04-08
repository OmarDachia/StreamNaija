<script setup>
import { Head, Link } from '@inertiajs/vue3';
import BaseLayout from '@/Components/BaseLayout.vue';
// import imageUrl from '/images/gridallbum1.jpg'

defineOptions({ layout: BaseLayout})


import { ref, onMounted } from 'vue';

const videos = ref([]);
const loading = ref(false);
const error = ref(null);

onMounted(async () => {
    try {
        loading.value = true;
        const response = await fetch(import.meta.env.VITE_API_BASE_URL + '/api/videos');
        if (!response.ok) throw new Error('Network response was not ok');
        videos.value = await response.json();
        videos.value = videos.value.data;
        console.log(videos.value);
    } catch (err) {
        error.value = err.message || 'Failed to fetch posts';
    } finally {
        loading.value = false;
    }
});

</script>

<template>
    <Head title="Welcome" />
    <div id ="theme" class="page-content">
        <div class="top">
            <div class="columns">
                <div class="column is-full featured_wrapper p-0">
                    <img src="/images/gridallbum1.png" class="featured">
                    <div class="title_wrapper">
                        <span class="has-text-white">Trending Today</span>
                        <h1 class="title is-1 has-text-white">The Untold Story of the great Lorem Ipsum</h1>
                        <button class="button is-medium">Watch It Now</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="columns is-multiline p-0 pt-6 last">
                <div class="column is-full">
                    <p class="has-text-white">Action Movies Collection</p>
                </div>
                
                <div class="column is-one-quarter" v-for="video in videos" :key="video.id">
                    {{ video.title }}
                    <img src="/images/gridallbum1.png">

                    <!-- <button class="floating-button">
                        <i class="playButton"></i> 
                    </button> -->

                    <div class="playButton floating-button">
                        <div class="playPause"></div>
                    </div>

                </div>
                
            </div>
            
        </div> 
    </div>
</template>

<style scoped>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;800&display=swap");
    .playButton .playPause {
        width: 25px;
        height: 25px;
        background: url(../images/play-xxl.png);
        -webkit-background-size: 100%;
        -moz-background-size: 100%;
        background-size: 100%;
    }

    #theme{
        color: #fff;
    }
    
    .floating-button {
        position: absolute;
        bottom: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        /* background-color: #ff0000; */
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        /* box-shadow: 0 2px 5px rgba(0,0,0,0.3); */
        transition: all 0.3s ease;
    }

    .floating-button:hover {
        transform: scale(2.2);
        /* background-color: #cc0000; */
    }

    .column.is-one-quarter {
        position: relative; /* Needed for absolute positioning of the button */
    }
    .container {
        padding-bottom: 3rem;
    }
    img {
        -webkit-box-reflect: below 5px
            linear-gradient(transparent, transparent, rgba(0, 0, 0, 0.4));
        -webkit-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }
    .container img:hover {
        -webkit-transform: scale(1.1);
        -ms-transform: scale(1.1);
        transform: scale(1.1);
    }
    .last {
        margin-top: 6.5rem;
    }
    .featured_wrapper {
        position: relative;
    }
    .featured_wrapper img {
        width: 100%;
        width: 100%;
        height: 350px;
        -o-object-fit: cover;
        object-fit: cover;
        -o-object-position: top;
        object-position: top;
    }
    .title_wrapper {
        position: absolute;
        width: 100%;
        left: 2rem;
        bottom: 2rem;
        padding: 20px 40px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }
    .title_wrapper h1 {
        width: 70%;
    }
    button {
        background: #f40612 !important;
        color: #fff !important;
        font-size: 18px;
        padding: 0.5rem 3rem;
        outline: none;
        border: 0 !important;
    }
    @media (max-width: 768px) {
        .title_wrapper {
            text-align: center;
            left: 0;
        }
        .title_wrapper h1 {
            font-size: 32px !important;
            width: 100%;
        }
        .container {
            padding: 20px;
        }
    }
    @media (max-width: 480px) {
        .column.is-one-quarter img {
            width: 100%;
            margin-bottom: 7rem;
        }
    }
</style>
