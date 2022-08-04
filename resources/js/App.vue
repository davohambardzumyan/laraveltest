<template>
    <v-app id="inspire">
        <v-loader/>
        <router-view :key="$route.fullPath"></router-view>
    </v-app>
</template>

<script>
import VLoader from "./components/VLoader";

export default {
    name: "App",
    components: {VLoader},
}
</script>
