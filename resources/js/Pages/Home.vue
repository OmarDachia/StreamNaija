<script setup>
import { Head, Link } from '@inertiajs/vue3';
import BaseLayout from '@/Components/BaseLayout.vue';
// import imageUrl from '/images/gridallbum1.jpg'
import { router } from '@inertiajs/vue3';

defineOptions({ layout: BaseLayout})


import { ref, onMounted, computed } from 'vue';

const videos = ref([]);
const categories = ref([]);
const loading = ref(false);
const error = ref(null);
const selectedCategory = ref('all')
const searchQuery = ref('');
let lastVideo = ref({});

// const filteredVideos = computed(() => {
//     let filtered = videos.value;
    
//     // Apply category filter
//     if (selectedCategory.value !== 'all') {
//         filtered = filtered.filter(video => video.category_id === selectedCategory.value);
//     }
    
//     // Apply search filter
//     if (searchQuery.value) {
//         const query = searchQuery.value.toLowerCase();
//         filtered = filtered.filter(video => 
//             video.title.toLowerCase().includes(query)
//         );
//     }
    
//     return filtered;
// });

onMounted(async () => {
    try {
        loading.value = true;
        const response = await fetch(import.meta.env.VITE_API_BASE_URL + '/api/videos');
        if (!response.ok) throw new Error('Network response was not ok');
        videos.value = await response.json();
        videos.value = videos.value.data;

        lastVideo = videos.value[videos.value.length - 1];
        // console.log('Last video:', lastVideo);
        // category
        const cat_response = await fetch(import.meta.env.VITE_API_BASE_URL + '/api/categories');
        if (!cat_response.ok) throw new Error('Network response was not ok');
        categories.value = await cat_response.json();
        // console.log(categories);
    } catch (err) {
        error.value = err.message || 'Failed to fetch posts';
    } finally {
        loading.value = false;
    }
});

// Filter videos based on selected category
const filteredVideos = computed(() => {
    if (selectedCategory.value === 'all') {
        return videos.value;
    }
    return videos.value.filter(video => video.category_id === selectedCategory.value);
});

function playVideo(video) {
    router.post(route('videos.show'), {
        video: video
    });
}
</script>

<template>
    <Head title="Home" />
     <div id="theme" class="page-content">
        <div class="top">
            <div class="columns">
                <div class="column is-full featured_wrapper p-0">
                    <img :src="'/storage/' +  lastVideo.thumbnail_url" class="featured">
                    <!----<img src="/images/gridallbum10.png" class="featured">-->
                    <div class="title_wrapper">
                        <span class="has-text-white">Trending Today</span>
                        <h1 class="title is-1 has-text-white">{{lastVideo.title}}</h1>
                        <button class="button is-medium" @click="playVideo(lastVideo)">Watch It Now</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- Category Filter -->
            <div class="columns is-multiline p-0 pt-6">
                <div class="column is-full">
                    <div class="col-md-6">
                        <div class="field is-horizontal">
                            <div class="field-label is-normal">
                                <label class="label has-text-white">Filter by Category:</label>
                            </div>
                            
                            <div class="field-body">
                                <div class="field">
                                    <div class="control">
                                        <div class="select">
                                            <select v-model="selectedCategory">
                                                <option value="all">
                                                    All
                                                </option>
                                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                                    {{ category.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field">
                            
                            <div class="control has-icons-left">
                                <input 
                                    class="input" 
                                    type="text" 
                                    placeholder="Search by title..." 
                                    v-model="searchQuery"
                                >
                                <span class="icon is-small is-left">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            
            <div class="columns is-multiline p-0 pt-6 last">
                <div class="column is-full">
                    <p class="has-text-white">
                        {{ selectedCategory === 'all' ? 'All Videos Collection' : `${selectedCategory} Movies Collection` }}
                    </p>
                </div>
                
                <div class="column is-one-quarter" v-for="video in filteredVideos" :key="video.id">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img :src="'/storage/' + video.thumbnail_url || '/images/gridallbum1.png'" :alt="video.title">
                            </figure>
                            <div class="playButton floating-button"
                                @click="playVideo(video)">
                                <div class="playPause"></div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <h3 class="title is-5 has-text-white text-center">{{ video.title }}</h3>
                                <!-- <p class="subtitle is-6 has-text-grey-light">{{ video.category }}</p> -->

                                <h5 class=" has-text-white text-center">Category: {{video.category.name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</template>

<style scoped>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;800&display=swap");
    .field .control.has-icons-left .icon {
        color: #f40612;
        height: 2.5em;
    }

    .input {
        background-color: #2d2d2d;
        border-color: #4a4a4a;
        color: white;
    }

    .input::placeholder {
        color: #7a7a7a;
    }

    .label {
        color: white !important;
    }
    #theme{
        color: #fff;
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

    .select select {
        background-color: #2d2d2d;
        color: white;
        border-color: #4a4a4a;
    }

    .card {
        background-color: #1a1a1a;
        transition: transform 0.3s;
        height: 100%;
    }

    .card:hover {
        transform: scale(1.03);
    }

    .floating-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .card:hover .floating-button {
        opacity: 1;
    }

    .playButton {
        width: 50px;
        height: 50px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .playPause {
        width: 0;
        height: 0;
        border-top: 12px solid transparent;
        border-left: 20px solid #04B8CE;
        border-bottom: 12px solid transparent;
        margin-left: 5px;
    }
</style>
