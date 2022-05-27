<template>
	<section class="py-6 px-4 w-full md:w-2/3">
        <div  class="min-h-screen bg-white py-6 flex flex-col items-center">
            <div class="w-full max-w-xl border border-gray-300 rounded-2xl py-3 px-5 my-3" v-for="(post,i) in posts" :key="post.id">
                <Feed :feed="post" />
            </div>
        </div>
    </section>
</template>

<script>

    import { defineComponent } from 'vue'
    import Feed from './Feed';

	export default defineComponent({
        name : 'Feeds',

        components : {
            Feed
        },

        mounted(){
            axios.get('/posts').
            then((r)=>{
                this.posts = r.data.data;
            });

            Echo.channel('newPosting').listen('NewPost', (e) => {
                this.posts.unshift(e.post);
            });
        },

		data() {
            return{
                posts : {},            }
        },

        methods : {

            ago(time){

                return moment(time).fromNow();
            },
        }
	})
</script>