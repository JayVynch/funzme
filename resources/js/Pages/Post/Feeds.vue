<template>
	<section class="py-6 w-2/3">
                    
        <article v-for="(post,i) in posts" :key="post.id" class=" shadow-lg sm:rounded-lg mb-4 px-4 py-3 border">
            <div class="w-full flex">
                <figure class="w-1/4 flex justify-center items-baseline ">
                    <img class="rounded-full w-24 h-24" :src="$page.props.user.profile_photo_url">
                </figure>
                <div class="w-3/4 text-base">
                    <figure v-if="post.post_photos">
                        <img class="w-full h-56 object-cover" :src="post.postUrl">
                    </figure>
                    <div v-if="post.tweets" v-html="post.tweets" class="flex items-center">
                    </div>
                </div>
            </div>
            <div class="m-2 w-3/4 flex flex-col ml-auto">
                <hr>
                <div class="flex">
                    
                    <button class="inline-flex items-center px-4 py-2 bg-transparent border border-transparent rounded-md font-semibold text-xs text-blue-800 uppercase tracking-widest focus:outline-none transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 h-4" viewBox="0 0 24 24"><path d="M21.216 8h-2.216v-1.75l1-3.095v-3.155h-5.246c-2.158 6.369-4.252 9.992-6.754 10v-1h-8v13h8v-1h2l2.507 2h8.461l3.032-2.926v-10.261l-2.784-1.813zm.784 11.225l-1.839 1.775h-6.954l-2.507-2h-2.7v-7c3.781 0 6.727-5.674 8.189-10h1.811v.791l-1 3.095v4.114h3.623l1.377.897v8.328z"/></svg>
                        <span class="px-4">4</span>
                    </button> 
                    <button class="inline-flex items-center px-4 py-2 bg-transparent border border-transparent rounded-md font-semibold text-xs text-blue-800 uppercase tracking-widest focus:outline-none transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-6 h-6" viewBox="0 0 24 24"><path d="M20.5 13c-1.932 0-3.5 1.567-3.5 3.5s1.568 3.5 3.5 3.5 3.5-1.567 3.5-3.5-1.568-3.5-3.5-3.5zm1.5 4h-1v1h-1v-1h-1v-1h1v-1h1v1h1v1zm-13.001-5.9c0 1.692-.766 2.9-1.206 3.9h-1.397c.227-1 1.954-3.415 1.021-4.982-.55-.923-2.272-.924-2.819-.015-.507.841-.24 2.417.712 4.215.518.978.374 1.734.162 2.197-.406.889-1.303 1.317-2.316 1.612-2.01.588-1.825.055-1.825 1.973h-1.329l-.002-.618c0-1.262.099-1.989 1.59-2.333 1.719-.397 3.319-.745 2.545-2.209-2.361-4.457-.627-6.84 1.866-6.84 1.687 0 2.998 1.09 2.998 3.1zm5.691 1.395c.607 1.146.447 2.016.206 2.543-.66 1.445-2.472 1.863-4.39 2.305-1.252.29-1.172.588-1.172 2.657h-1.331l-.003-.825c0-1.681.132-2.652 2.119-3.111 2.293-.53 4.427-.994 3.394-2.946-3.147-5.941-.835-9.118 2.488-9.118 3.164 0 5.337 2.879 3.041 8h-1.483c1.159-2.325 1.428-4.326.708-5.533-.902-1.517-3.617-1.509-4.512-.022-.768 1.273-.426 3.478.935 6.05z"/></svg>
                    </button>
                    
                </div>
                <hr>
                <div class="px-4 py-3 relative">
                    <textarea class="rounded-lg w-full text-sm" cols="1" placeholder="comment" v-model="comment.reply"></textarea>
                    <button class="inline-flex items-center px-4 py-2 bg-transparent border border-transparent rounded-md font-semibold text-xs text-blue-800 uppercase tracking-widest focus:outline-none transition ease-in-out duration-150 absolute inset-y-0 flex items-center right-7 pr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-6 h-6" viewBox="0 0 24 24"><path d="M24 0l-6 22-8.129-7.239 7.802-8.234-10.458 7.227-7.215-1.754 24-12zm-15 16.668v7.332l3.258-4.431-3.258-2.901z"/></svg>
                    </button>
                </div>
            </div>
        </article>
    </section>
</template>

<script>
	export default{

        mounted(){
            axios.get('/posts').
            then((r)=>{
                this.posts = r.data.data;
            });
        },

		data() {
            return{
                posts : {},

                comment : {
                    reply : '' 
                }
            }
        }
	}
</script>