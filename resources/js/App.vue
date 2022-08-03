<template>
    <v-app id="inspire">
        <v-loader/>
        <router-view :key="$route.fullPath"></router-view>
    </v-app>
</template>

<script>
import VLoader from "./components/VLoader";
import NavBar from "./components/NavBar";

export default {
    name: "App",
    components: {NavBar, VLoader},
}
</script>

