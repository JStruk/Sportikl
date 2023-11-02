<template>
    <main class="min-h-screen">
        <Header />
        <article>
            <slot />
        </article>
        <Footer class="sticky top-[100vh]" />
    </main>
</template>

<script setup>
import Header from '../Components/Header.vue';
import Footer from '../Components/Footer.vue';
</script>
