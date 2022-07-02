<script setup>
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
</script>

<template>
    <GuestLayout title="Home">
        <div>
            <Carousel :autoplay="4000" :wrap-around="true">
                <Slide v-for="slide in images" :key="slide">
                    <div class="carousel__item">
                        <img :src="slide" />
                    </div>
                </Slide>

                <template #addons>
                    <Navigation />
                </template>
            </Carousel>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="rounded bg-gray-300 p-4">
                    <h1 class="text-lg text-center font-bold">Getting started</h1>
                </div>
                <div class="rounded bg-gray-300 p-4">
                    <h1 class="text-lg text-center font-bold">Who are we?</h1>
                </div>
                <div class="rounded bg-gray-300 p-4">
                    <h1 class="text-lg text-center font-bold">Contact us</h1>
                    <p>Email: pravin.vaz@vuw.ac.nz</p>
                    <p>Ph: +64 4 463 6765</p>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script>
    export default {
        data: () => {
            return {
                // Set slider images here
                images: [
                    'https://images.pexels.com/photos/1476321/pexels-photo-1476321.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                    'https://images.pexels.com/photos/221185/pexels-photo-221185.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                    'https://images.pexels.com/photos/177598/pexels-photo-177598.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
                ]
            }
        },
    }
</script>

<style>
    @import 'vue3-carousel/dist/carousel.css';
    .carousel__prev {
        transform: translate(20%, -50%);
    }

    .carousel__next {
        transform: translate(-20%, -50%);
    }
</style>
