<template>
	<app-layout>
	    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

	    	<div class="text-2xl flex flex-col w-full justify-center items-center">
				<section class="py-6 w-2/3">

			        <div  class="min-h-screen bg-white py-6 flex flex-col">
			            <div class="w-full max-w-xl border border-gray-300 rounded-2xl py-3 px-5 my-3">
			                <div class="flex">
			                    <div class="mr-2">
			                        <img class="rounded-full w-16 h-16" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
			                    </div>
			                    <div>
			                        <div class="flex space-x-1">
			                            <span class="font-bold">{{ $page.props.user.name }}</span>
			                        </div>
			                        <div class="text-gray-500 text-md">@elonmusk</div>
			                    </div>
			                </div>

			                <div class="py-3">
			                    <figure v-if="$page.props.postWithComments.post_photos">
			                        <img class="w-full h-56 object-cover" :src="$page.props.postWithComments.postUrl">
			                    </figure>
			                    <div v-if="$page.props.postWithComments.tweets" v-html="$page.props.postWithComments.tweets" class="text-lg"></div>
			                    <div class="flex">
			                        <p class="text-gray-500 pt-1 text-xs">{{ ago($page.props.postWithComments.created_at) }}</p>
			                        
			                    </div>
			                </div>

			                <div class="flex space-x-5 pt-3 text-gray-500 border-t border-gray-300">
			            
			                    <likes :likings="$page.props.postWithComments.isLiked" :postId="$page.props.postWithComments.id" :countedLikes="$page.props.postWithComments.likes_count"></likes>
			        
			                    <div class="flex space-x-2 inline-flex items-center" >
			                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
			                            <g>
			                                <path
			                                    d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z">
			                                </path>
			                            </g>
			                        </svg>
			                        <span class="text-sm">{{ $page.props.postWithComments.comments_count }}</span>
			                    </div>

			                    <!-- follow -->
			                    <button class="inline-flex items-center px-4 py-2 bg-transparent border border-transparent rounded-md font-semibold text-xs text-blue-800 uppercase tracking-widest focus:outline-none transition ease-in-out duration-150">
			                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-6 h-6" viewBox="0 0 24 24"><path d="M20.5 13c-1.932 0-3.5 1.567-3.5 3.5s1.568 3.5 3.5 3.5 3.5-1.567 3.5-3.5-1.568-3.5-3.5-3.5zm1.5 4h-1v1h-1v-1h-1v-1h1v-1h1v1h1v1zm-13.001-5.9c0 1.692-.766 2.9-1.206 3.9h-1.397c.227-1 1.954-3.415 1.021-4.982-.55-.923-2.272-.924-2.819-.015-.507.841-.24 2.417.712 4.215.518.978.374 1.734.162 2.197-.406.889-1.303 1.317-2.316 1.612-2.01.588-1.825.055-1.825 1.973h-1.329l-.002-.618c0-1.262.099-1.989 1.59-2.333 1.719-.397 3.319-.745 2.545-2.209-2.361-4.457-.627-6.84 1.866-6.84 1.687 0 2.998 1.09 2.998 3.1zm5.691 1.395c.607 1.146.447 2.016.206 2.543-.66 1.445-2.472 1.863-4.39 2.305-1.252.29-1.172.588-1.172 2.657h-1.331l-.003-.825c0-1.681.132-2.652 2.119-3.111 2.293-.53 4.427-.994 3.394-2.946-3.147-5.941-.835-9.118 2.488-9.118 3.164 0 5.337 2.879 3.041 8h-1.483c1.159-2.325 1.428-4.326.708-5.533-.902-1.517-3.617-1.509-4.512-.022-.768 1.273-.426 3.478.935 6.05z"/></svg>
			                    </button>
			                </div>
			            </div>
			        </div>
					
					<div class="px-2 py-3 relative">
					  	<div class="flex flex-row  items-center  bottom-0 my-2 w-full">
						    <div
						      class="flex flex-row border-gray items-center w-full border rounded-3xl h-12 px-2"
						    >
							    <div class="w-full">
							        <textarea rows="2" class="border rounded-2xl border-transparent w-full focus:outline-none text-sm h-10 flex items-center" cols="2" placeholder="Reply post..." v-model="comment.reply"></textarea>
						      	</div>
						      	<div class="flex flex-row">
							      	<!-- Attachment button -->
							        <!-- <button class="focus:outline-none flex items-center justify-center h-10 w-8 hover:text-blue-600  text-blue-400">
							          <svg
							            class="w-5 h-5 "
							            fill="none"
							            stroke="currentColor"
							            viewBox="0 0 24 24"
							            xmlns="http://www.w3.org/2000/svg"
							          >
							            <path
							              stroke-linecap="round"
							              stroke-linejoin="round"
							              stroke-width="2"
							              d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
							            ></path>
							          </svg>
							        </button> -->

						        <!-- image button -->
							        <button
							          id="capture"      
							          class="focus:outline-none flex items-center justify-center h-10 w-8 hover:text-green-600 text-green-400 ml-1 mr-2"
							        >
							          <svg
							            class="w-5 h-5"
							            fill="none"
							            stroke="currentColor"
							            viewBox="0 0 24 24"
							            xmlns="http://www.w3.org/2000/svg"
							          >
							            <path
							              stroke-linecap="round"
							              stroke-linejoin="round"
							              stroke-width="2"
							              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
							            ></path>
							          </svg>
							        </button>

						      	</div>
						    </div>
						    <div class="ml-3 mr-2">
						        <button
						         	id="self"
						        	class="flex items-center justify-center h-10 w-10 mr-2 rounded-full bg-gray-200 hover:bg-gray-300 text-indigo-800 text-white focus:outline-none"
						        	@click="makeAComment"
						      	>
							        <svg
							          class="w-5 h-5 transform rotate-90 -mr-px"
							          fill="none"
							          stroke="currentColor"
							          viewBox="0 0 24 24"
							          xmlns="http://www.w3.org/2000/svg"
							        >
							          <path
							            stroke-linecap="round"
							            stroke-linejoin="round"
							            stroke-width="2"
							            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
							          ></path>
							        </svg>
						      	</button>
						    </div>
					    </div>
				  	</div>
			    </section>
			</div>
		</div>
	</app-layout>

</template>

<script>
	import AppLayout from '@/Layouts/AppLayout'
	import moment from 'moment'
	import Likes from './Like'

	export default{
		name : 'Comments',

		components : {
			AppLayout,
			Likes
		},

		props : {

			postId : {
				type : Number
			}
		},

		data(){
			return {
				comment : {
					reply : ''
				},

				comments : {}
			}
		},

		methods : {

            makeAComment(){
                if(this.comment.reply.length > 4){
                    // this.$inertia.post(`/posts/${this.postId}/comment`,this.comment);
                    this.comment.reply = '';
                }
            },

            ago(time){

                return moment(time).fromNow();
            },
        }


	}
</script>