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
        <div>
            <h3>Lascia un commento</h3>
            <form @submit.prevent="addComment()">
                <input type="text" id="name" placeholder="Inserisci il nome" v-model="formData.name">
                <textarea name="content" id="content" cols="30" rows="10" placeholder="Inserisci il testo del commento" v-model="formData.text"></textarea>

                <div v-if="formErrors.content" style="background: red, color: white">
                    <ul>
                        <li v-for="(error, index) in formErrors.content" :key="index">{{error}}</li>
                    </ul>

                </div>

                <button type="submit">Aggiungi Commento</button>                
            </form>

            <div v-show="commentSent" style="background: green; color: white; text-align: center">
                Commento in fase di approvazione!
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SinglePost",
    data(){
            return{
                post:{},
                formData: {
                    name: "",
                    text: "",
                    post_id:null
                },
                formErrors: {},
                commentSent: false
            }
        },

        created() {
            
            axios
            .get(`/api/posts/${this.$route.params.slug}`)
            .then((response) => {
                this.post = response.data;
                this.formData.post_id = this.post.id;
            })
            .catch((error) => {
                //handle error
                this.$router.push({name: 'page-404'});
            })
            
        },

        methods:{
            addComment(){
                axios
                .post(`/api/comments/`, this.formData)
                .then((response) => {
                    this.formData.name = "";
                    this.formData.text = "";
                    //mostro messaggio di avviso che il commento e' stato inserito
                    this.commentSent = true;
                }).catch((error) => {
                    // handle error
                    this.formErrors = error.response.data.errors;
                })
            }
        }
}
</script>

<style>

</style>