<template>
	<div class="flex">
		<button class="inline-flex items-center px-4 py-2 bg-transparent border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none transition ease-in-out duration-150" :class="classes" @click="makeLike">
            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 h-4" viewBox="0 0 24 24"><path d="M21.216 8h-2.216v-1.75l1-3.095v-3.155h-5.246c-2.158 6.369-4.252 9.992-6.754 10v-1h-8v13h8v-1h2l2.507 2h8.461l3.032-2.926v-10.261l-2.784-1.813zm.784 11.225l-1.839 1.775h-6.954l-2.507-2h-2.7v-7c3.781 0 6.727-5.674 8.189-10h1.811v.791l-1 3.095v4.114h3.623l1.377.897v8.328z"/></svg>
        </button> 
        <span class="px-4 text-xs text-blue-800 flex items-center justify-center">{{ likes_count }}</span>
	</div>
</template>

<script>
	export default {
		name : 'Likes',

		props : ['likings','postId', 'countedLikes'],

		data(){
			return {
				likeable : this.likings ,
				likes_count : this.countedLikes
			}
		},

		methods : {

			makeLike(){

				if (!this.likeable) {

					// axios.post(`/posts/${this.postId}/like`,{
					// 	postId : this.postId
					// });

					this.likeable = true;
				}else{

					this.likeable = false;
				}
			},
		},

		computed: {
			classes (){
				return  [this.likings ? "text-blue-800" : "text-gray-800"];
			},
		}

	}
</script>