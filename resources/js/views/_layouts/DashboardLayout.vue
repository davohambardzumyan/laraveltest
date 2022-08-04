<template>
    <div class="dashboard-layout">
        <v-navigation-drawer
            v-model="drawer"
            app
        >
            <v-list-item>
                <v-list-item-content class="text-center" >
                    <v-list-item-title class="text-h6">
                        {{ authUserFullName }}
                    </v-list-item-title>
                    <v-list-item-subtitle>
                        {{ $store.getters.user.email }}
                    </v-list-item-subtitle>
                    <v-list-item-subtitle>
                        ({{ $store.getters.user.role.toUpperCase() }})
                    </v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <v-list
                dense
                nav
            >
                <v-list-item
                    v-for="item in items"
                    :key="item.title"
                    :to="item.to"
                    link
                >
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-spacer></v-spacer>
            <v-btn @click="logout">
                <v-icon>logout</v-icon>
            </v-btn>
        </v-app-bar>

        <v-main>
            <slot></slot>
        </v-main>
    </div>
</template>

<script>
import auth from "../../repository/auth";

export default {
    name: "DashboardLayout",
    computed: {
        authUserFullName() {
            return this.$store.getters.fullName
        }
    },
    data: () => ({
        drawer: null,
        items: [
            {title: 'Tickets', icon: 'mdi-ticket', to: '/tickets'},
            {title: 'My Profile', icon: 'mdi-account', to: '/profile'},
        ]
    }),
    methods: {
        async logout() {
            this.$store.commit('startLoader');
            await auth.logout().then(() => {
                this.$store.dispatch('logout')
                this.$router.push('/login')
            }).finally(() => {
                this.$store.commit('stopLoader');
            });
        }
    }
}
</script>
