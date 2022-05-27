<template>
	<app-layout>
		<div class="md:py-12">
            <div class="w-full lg:max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				    <div class="md:p-6 px-2 md:px-20 bg-white border-b border-gray-200">
				    	<div class="text-2xl flex flex-col w-full justify-center items-center">
							
							<!-- simple profile details of user  -->
							<div class="top h-64 w-full bg-pink-700 overflow-hidden relative rounded-lg" >
							    
							    <div class="flex flex-col justify-center items-center relative h-full bg-black bg-opacity-50 text-white">
							      	<img  :src="profiler.profile_photo_url" :alt="profiler.name" class="h-24 w-24 object-cover rounded-full">
							      	<h1 class="text-2xl font-semibold">{{ profiler.name }}</h1>
							      	<div class="text-white text-sm">@{{ profiler.username }}</div>
							      	
							      	<div class="py-2 space-x-2 absolute right-3 bottom-0" :class="classes">
										<follow :email="profiler.email" :isFollower="follows" @followAction="actionForFollow"></follow>
									</div>
									<div
										class="py-4 flex justify-center items-center w-full divide-x divide-gray-400 divide-solid">
										<h4 class="text-sm font-semibold px-2">Joined {{ ago(profiler.created_at) }}</h4>
										<span class="text-center text-sm px-2">
											<span class="font-bold text-white">{{ countFollower }}</span>
											<span class="text-white"> followers</span>
										</span>
										<span class="text-center text-sm px-2">
											<span class="font-bold text-white">{{ profiler.countFollowing }}</span>
											<span class="text-white"> following</span>
										</span>
									</div>
							    </div>
							</div>

							<!-- timeline of user -->
							<section class="py-6 px-4 w-full md:w-2/3">
						        <div  class="min-h-screen bg-white py-6 flex flex-col items-center">
						            <div class="w-full max-w-xl border border-gray-300 rounded-2xl py-3 px-5 my-3" v-for="(post,i) in tweets" :key="post.id">
						                <div class="flex">
						                    <div class="mr-2">
						                        <img class="rounded-full w-16 h-16" :src="post.user.profile_photo_url" :alt="post.user.name" />
						                    </div>
						                    <div>
						                        <div class="flex space-x-1">
						                            <span class="font-bold">{{ post.user.name }}</span>
						                        </div>
						                        <div class="text-gray-500 text-xs">@{{ post.user.username }}</div>
						                    </div>
						                </div>

						                <div class="py-3">
						                    <figure v-if="post.post_photos">
						                        <img class="w-full h-56 object-cover" :src="post.postUrl">
						                    </figure>
						                    <div v-if="post.tweets" v-html="post.tweets" class="text-lg"></div>
						                    <div class="flex">
						                        <p class="text-gray-500 pt-1 text-xs">{{ ago(post.created_at) }}</p>
						                        
						                    </div>
						                </div>

						                <div class="flex space-x-5 pt-3 text-gray-500 border-t border-gray-300">
						            
						                    <likes :likings="post.isLiked" :postId="post.id" :countedLikes="post.likes_count" :detect="'post'"></likes>
						        
						                    <Link class="flex space-x-2 inline-flex items-center" :href="route('post.comments',post.id)">
						                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
						                            <g>
						                                <path
						                                    d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z">
						                                </path>
						                            </g>
						                        </svg>
						                        <span class="text-sm">{{ post.comments_count }}</span>
						                    </Link>
						                </div>
						            </div>
						        </div>
						    </section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</app-layout>

</template>

<script>
	import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
	import AppLayout from '@/Layouts/AppLayout'
	import moment from 'moment'
    import Likes from './Like'
    import PostComment from './Comment'
    import Follow from './Follow'
    

	export default defineComponent({
		name : 'Profile',

		components : {
			AppLayout,
			Likes,
			PostComment,
			Follow,
			Head,
			Link
		},

		props : ['tweets','profiler','followership'],

		data(){
			return {
				follows : 			this.followership,
				countFollowing : 	this.profiler.countFollowing,
				countFollower : 	this.profiler.countFollower,
			}
		},

		methods : {

        	ago(time){

                return moment(time).fromNow();
            },

            actionForFollow(action){
            	this.follows = action;
            	if (action == true) { this.countFollower ++ }

     			if (action == false) { this.countFollower -- }       	
            }
        },

        computed : {

        	classes(){
        		return this.profiler.id == this.$page.props.user.id ? 'hidden' : 'flex'
        	}
        }        
    })
</script>