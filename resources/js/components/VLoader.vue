<template>
    <div v-if="$store.getters.isLoaderProcessing" class="loader-container">
        <div class="lds-dual-ring"></div>
    </div>
</template>

<script>
export default {
    name: "VLoader"
};
</script>

<style>
.loader-container{
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: #202938;
    position: fixed;
    z-index: 99999 !important;
    opacity: 1;
    transition: all 2s linear;
}
.lds-dual-ring {
    z-index: 9999;
    display: inline-block;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.lds-dual-ring:after {
    content: " ";
    display: block;
    width: 46px;
    height: 46px;
    margin: 1px;
    border-radius: 50%;
    border: 5px solid;
    border-color: #24695c transparent #24695c transparent;
    animation: lds-dual-ring 1.2s linear infinite;
}

@keyframes lds-dual-ring {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>

