<template>
    <div class="p-2 h-96 max-w-xl w-full">
        <div class="rounded-lg h-full dark:bg-gray-800 bg-teal-400 p-2 dark:text-white text-center">
            <div class="h-1/2 pb-2">
                <img :src="getLogoPath(game.home_team_name)" class="h-3/5 w-full object-contain" alt="NHL Team logo"/>
                <h2>{{ game.home_team_name }}</h2>
                <h1 class="text-2xl font-bold">{{ game.home_score }}</h1>
            </div>
            <hr />
            <div class="h-1/2 pt-2">
                <h1 class="text-2xl font-bold">{{ game.away_score}}</h1>
                <h2>{{ game.away_team_name }}</h2>
                <img :src="getLogoPath(game.away_team_name)" class="h-3/5 w-full object-contain" alt="NHL Team logo"/>
            </div>
        </div>
    </div>
</template>

<script setup>
import torontoMapleLeafsLogo from '../../../assets/nhl/teams/toronto_maple_leafs/logo.png'
import bostonBruinsLogo from '../../../assets/nhl/teams/boston_bruins/logo.png'

const props = defineProps({
    game: Object
});
function getLogoPath(teamName) {
    const cleanTeamName = teamName
        .replaceAll('.', '')
        .replaceAll(' ', '_')
        .replaceAll('é', 'e') // for Montréal Canadiens
        .toLowerCase()

    console.log(cleanTeamName)

    const logoPath = `../../../assets/nhl/teams/${cleanTeamName}/logo.png`

    return new URL(logoPath, import.meta.url).href
}
</script>
