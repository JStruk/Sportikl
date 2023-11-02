<template>
    <Layout>
        <div class="text-center text-4xl font-bold underline pt-4">
            Some sort of {league_name} header will go here
        </div>
        <div class="flex w-full justify-center">
            <div class="mt-10 grid justify-items-center grid-cols-1 sm:grid-cols-2 sm:w-3/4 w-full p-2 items-center">
                <GameCard/>
                <GameCard/>
                <GameCard/>
                <GameCard/>
            </div>
        </div>

    </Layout>
</template>

<script setup>
import Layout from "../Layouts/Layout.vue";
import GameCard from "../Components/NHL/GameCard.vue";
</script>
