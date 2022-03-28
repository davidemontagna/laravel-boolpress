<template>
    <div>
        <h1>{{post.title}}</h1>
        <div v-html="post.content"></div>
        <p v-if="post.category">Category: {{post.category.name}}</p>
        <div v-if="post.tags.length > 0">
            Tags:
            <ul>
                <li v-for="tag in post.tags" :key="tag.id">{{tag.name}}</li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "SinglePost",
    data(){
            return{
                post:{}
            }
        },

        methods:{
            getPost: function (){
                axios
                .get(`/api/posts/${this.$route.params.slug}`)
                .then((response) => {
                    this.post = response.data;
                })
                .catch((error) => {
                    //handle error
                    this.$router.push({name: 'page-404'});
                })
            }
        },

        created(){
            this.getPost()
        }
}
</script>

<style>

</style>