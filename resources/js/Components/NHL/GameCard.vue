<template>
    <div class="p-2 h-96 max-w-xl w-full">
        <div class="rounded-lg h-full dark:bg-gray-800 bg-teal-400 p-2 dark:text-white text-center">
            <div class="h-1/2 pb-2">
                <img :src="torontoMapleLeafsLogo" class="h-3/5 w-full object-contain" alt="NHL Team logo"/>
                <h2>Toronto Maple Leafs</h2>
                <h1 class="text-2xl font-bold">4</h1>
            </div>
            <hr />
            <div class="h-1/2 pt-2">
                <h1 class="text-2xl font-bold">4</h1>
                <h2>Boston Bruins</h2>
                <img :src="bostonBruinsLogo" class="h-3/5 w-full object-contain" alt="NHL Team logo"/>
            </div>
        </div>
    </div>
</template>

<script setup>
import torontoMapleLeafsLogo from '../../../assets/nhl/teams/toronto_maple_leafs/toronto-maple-leafs-logo.pngc.png'
import bostonBruinsLogo from '../../../assets/nhl/teams/boston_bruins/boston-bruins-logo.png'
</script>
