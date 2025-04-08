<script setup>
import { Head, Link } from '@inertiajs/vue3';
import BaseLayout from '@/Components/BaseLayout.vue';
import VideoPlayer from '@/Pages/VideoPlayer.vue';

defineOptions({ layout: BaseLayout})

</script>

<template>
    <Head title="Latest Videos" />
        <!-- <div class="flex flex-col items-center justify-center min-h-screen py-6 sm:py-12 lg:py-24">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900">Welcome to Videossss</h1>
                <p class="mt-4 text-lg text-gray-600">This is a simple example of a Vue 3 application using Videossss.</p>
            </div>
            <div class="mt-8">
                <Link href="/dashboard" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Go to Video</Link>
            </div>
        </div> -->
        <div class="page-content">
            <section id="video" class="content-section">
                <div class="row">
                    <!-- <div class="col-md-12">
                        <div class="section-heading">
                            <h1>This is a <em>company</em> presentation.</h1>
                            <p>Praesent pellentesque efficitur magna, sed pellentesque neque malesuada vitae.</p>
                        </div>
                        <div class="text-content">
                            <p>In eget ipsum sed lorem vehicula luctus. Curabitur non dolor rhoncus, hendrerit justo sit amet, vestibulum turpis. Pellentesque id auctor tellus, vel ultricies augue. Duis condimentum aliquet blandit. Fusce rhoncus et eros ut pharetra. Phasellus convallis ultricies ligula ac gravida.</p>
                        </div>
                        <div class="accent-button button">
                            <a href="#blog">Continue Reading</a>
                        </div>
                    </div> -->
                    <div class="col-md-12">
                        <!-- videoSrc="{{ asset('storage/videos/me.mp4') }}" -->
                        <!-- <VideoPlayer
                            videoSrc="{{ asset('storage/videos/me.mp4') }}"
                            poster="{{ asset('storage/videos/img1.jpg') }}"
                            class="video-js vjs-big-play-centered"
                            controls
                            preload="auto"
                            width="100%"
                            height="100%">
                            <source src="{{ asset('storage/videos/1.mp4') }}" type="video/mp4">
                        </VideoPlayer> -->
                        <!-- <div class="box-video">
                            <div class="bg-video" style="background-image: url(https://unsplash.imgix.net/photo-1425036458755-dc303a604201?fit=crop&fm=jpg&q=75&w=1000);">
                                <div class="bt-play">Play</div>
                            </div> -->
                            <!-- <div class="video-container"> -->
                                <!-- <iframe width="100%" height="520" src="https://www.youtube.com/embed/j-_7Ub-Zkow?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen="allowfullscreen"></iframe> -->
                                <div class="video-inner ">
                                    <div class="agileits-main">
                                        <!-- <h1 class="agileits-w3layouts">Colored video player</h1> -->
                                        <div class="wthree-row w3-agile">
                                            <div id="videoContainer">
                                                <div class="overlay">
                                                    <div class="button agileinfo"></div>
                                                </div>
                                                <div id="video" class="col-md-12">
                                                    <video id ="v_play" src="/storage/videos/me.mp4"></video>
                                                    <!-- <p>Your user agent does not support this Video element.</p> -->
                                                </div>
                                                <div id="controls">
                                                    <div class="playButton">
                                                        <div class="playPause"></div>
                                                    </div>
                                                    <div class="ProgressContainer">
                                                        <div class="timer intialTime"> 00:00 </div>
                                                        <div class="progressBar">
                                                            <div class="progress"></div>
                                                        </div>
                                                        <div class="time"> 00:00 </div>
                                                        <div class="timer fullTime"> 00:00 </div>
                                                    </div>
                                                    <div class="volume">
                                                        <div class="icon"></div>
                                                        <div class="intensityBar">
                                                            <div class="intensity"></div>
                                                        </div>
                                                    </div>
                                                    <div class="scale">
                                                        <div class="icon"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>
            </section>
        </div>
</template>
