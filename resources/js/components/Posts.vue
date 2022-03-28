<template>
    <div >
        <div v-for="post in posts" :key="post.id" class="mt-5">
            <ul>
                <li>ID: {{post.id}}</li>
                <li>Title: {{post.title}}</li>
                <li>Content: {{post.content}}</li>
                <li v-if="post.category">Category: {{post.category.name}}</li>
                <li>Tag:
                    <ul>
                        <li v-for="tag in post.tags" :key="tag.slug"> {{tag.name}}</li>
                    </ul>
                </li>
            </ul>
            <router-link :to="{ name: 'single-post', params: { slug: post.slug } }">Visualizza Post</router-link>
            
        </div>
        
    </div>
</template>

<script>
export default {
    name: "Posts",
    data(){
            return{
                posts:[]
            }
        },

        methods:{
            getPosts: function (){
                axios
                .get("/api/posts")
                .then((response) => {
                    this.posts = response.data;
                })
            }
        },

        created(){
            this.getPosts()
        }
}
</script>

<style>

</style>