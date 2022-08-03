<template>
    <dashboard-layout>
        <h1>Page 1</h1>
        <v-btn @click="click">
            Hello
        </v-btn>
        <h1>{{$store.getters.user.first_name}}</h1>
    </dashboard-layout>
</template>

<script>
import DashboardLayout from "./_layouts/DashboardLayout";
export default {
    name: "Page1",
    components: {DashboardLayout},
    methods: {
        click(){
            this.$toast("I'm a toast!");
        }
    }
}
</script>

<style scoped>

</style>
