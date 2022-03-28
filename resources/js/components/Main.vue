<template>
    <main>
        <!-- La key serve ad aggiornare e cambiare sempre l'url mantenendo la medesima rotta' -->
        <router-view :key="$route.path"></router-view>
    </main>
</template>

<script>
    export default {
        name: "Main",
        
    }
</script>

<style lang="scss" scoped>

</style>