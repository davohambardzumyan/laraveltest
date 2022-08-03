<template>
<ul>
    <li>
        <router-link :to="{name:'Home'}">
            Home
        </router-link>
    </li>
    <li>
        <router-link :to="{name:'Page1'}">
            Page1
        </router-link>
    </li>
    <li>
        <router-link :to="{name:'Page2'}">
            Page2
        </router-link>
    </li>
    <li>
        <router-link :to="{name:'Dashboard'}">
            Dashboard
        </router-link>
    </li>
    <li>
        <router-link :to="{name:'Profile'}">
            Profile
        </router-link>
    </li>
    <li>
        <router-link :to="{name:'Login'}">
            Login
        </router-link>
    </li>
    <li>
        <router-link :to="{name:'Registration'}">
            Registration
        </router-link>
    </li>
    <li v-if="$store.getters.isAuthenticated">
        <a @click="logout">
            Logout
        </a>
    </li>
    <slot></slot>
</ul>
</template>

<script>
import auth from "../repository/auth";

export default {
    name: "NavBar",
    methods:{
        logout(){
            auth.logout().then(()=>{
                this.$store.dispatch('logout')
                this.$router.push('/login')
            })
        }
    }
}
</script>
