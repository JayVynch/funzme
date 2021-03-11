<template>
	<div class="flex">
		<button class="inline-flex items-center px-2 py-2 bg-transparent border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none transition ease-in-out duration-150" :class="classes" @click="makeLike">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
	            <g><path
	                    d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12zM7.354 4.225c-2.08 0-3.903 1.988-3.903 4.255 0 5.74 7.034 11.596 8.55 11.658 1.518-.062 8.55-5.917 8.55-11.658 0-2.267-1.823-4.255-3.903-4.255-2.528 0-3.94 2.936-3.952 2.965-.23.562-1.156.562-1.387 0-.014-.03-1.425-2.965-3.954-2.965z">
	                </path>
	            </g>
	        </svg>
        </button> 
        <span class="px-1 text-xs text-blue-800 flex items-center justify-center">{{ likes_count }}</span>
	</div>
</template>

<script>
	export default {
		name : 'Likes',

		props : [
			'likings',
			'postId',
			'countedLikes',
			'detect',
		],

		data(){
			return {
				likeable : this.likings ,
				likes_count : this.countedLikes
			}
		},

		methods : {

			makeLike(){

				if (this.likeable) {
					if (this.detect == 'post') {

						axios.delete(`/posts/${this.postId}/like`,{
							postId : this.postId
						});
					}

					if (this.detect == 'comment') {
						axios.delete(`/comments/${this.postId}/like`,{
							postId : this.postId
						});
					}

					this.likeable = false;
					this.likes_count --;
				}else{

					if (this.detect == 'post') {
						axios.post(`/posts/${this.postId}/like`,{
							postId : this.postId
						});
					}

					if (this.detect == 'comment') {
						axios.post(`/comments/${this.postId}/like`,{
							postId : this.postId
						});
					}

					this.likeable = true;
					this.likes_count ++;
				}
			},
		},

		computed: {
			classes (){
				return  [this.likeable ? "text-red-800" : "text-gray-800"];
			},
		}

	}
</script>