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
                        <VideoPlayer :src="`storage/videos/01JRE4Q4J8N7JRRKZ80V3GZ211.mp4`" />
                    </div>
                </div>
            </section>
        </div>
</template>
