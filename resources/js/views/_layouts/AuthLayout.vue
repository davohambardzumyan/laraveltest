<template>
    <v-main class="main">
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4 lg3 class="relative-position">
                    <div class="text-xs-center mb-5">
                        <v-img class="mx-auto" src="/img/logo.png" :alt="$store.getters.appName" :width="'50px'"/>
                    </div>
                    <slot></slot>
                </v-flex>
            </v-layout>
        </v-container>
    </v-main>
</template>

<script>
export default {
    name: "AuthLayout",
}
</script>
