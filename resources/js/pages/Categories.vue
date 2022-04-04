<template>
    <div class="container-grid">
        <div v-for="category in categories" :key="category.slug" class="category">
            <div class="title">{{category.name}} ({{category.posts.length}})</div>
            <router-link :to="{name: 'single-category', params: {slug: category.slug}}">Visualizza Categoria</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "Categories",
    data() {
        return{
            categories: []
        }
    },
    created() {
        axios
        .get("/api/categories")
        .then((response) => {
            this.categories = response.data;
        })
    }
}
</script>

<style lang="scss" scoped>
.category{
    width: 100%;
    background: #fff;

    .title{
        font-size: 2.25rem;
        font-weight: bold;
        padding: 5px;
    }
}
</style>