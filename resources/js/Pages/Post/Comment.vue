<template>
	<app-layout>
		<div class="md:py-12">
            <div class="w-full lg:max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				    <div class="md:p-6 px-2 py-2 md:py-0 md:px-20 bg-white border-b border-gray-200">

				    	<div class="text-2xl flex flex-col w-full justify-center items-center">
				    		<Link :href="route('dashboard')" class="flex w-full text-xs text-blue-600">
				    			posts
				    		</Link>
							<section class="py-2 md:py-6 px-4 w-full md:w-2/3">
						        <div  class="min-h-screen bg-white md:py-6 flex flex-col items-center">
						            <div class="w-full max-w-xl border border-gray-300 rounded-2xl py-3 px-4 md:px-5 my-3">
						                <div class="flex">
						                    <Link :href="route('users.page',$page.props.postWithComments.user.username)" class="mr-2">
						                        <img class="rounded-full w-16 h-16" :src="$page.props.postWithComments.user.profile_photo_url" :alt="$page.props.user.name" />
						                    </Link>
						                    <div>
						                        <div class="flex space-x-1">
						                            <Link :href="route('users.page',$page.props.postWithComments.user.username)" class="font-bold">{{ $page.props.postWithComments.user.name }}</Link>
						                        </div>
						                        <Link :href="route('users.page',$page.props.postWithComments.user.username)" class="text-gray-500 text-sm">@{{ $page.props.postWithComments.user.username }}</Link>
						                    </div>
						                </div>

						                <div class="py-3">
						                    <figure v-if="$page.props.postWithComments.post_photos">
						                        <img class="w-full h-56 object-cover" :src="$page.props.postWithComments.postUrl">
						                    </figure>
						                    <div v-if="$page.props.postWithComments.tweets" v-html="$page.props.postWithComments.tweets" class="text-lg"></div>
						                    <div class="flex">
						                        <p class="text-gray-500 pt-1 text-xs">{{ ago }}</p>
						                        
						                    </div>
						                </div>

						                <div class="flex space-x-5 pt-3 text-gray-500 border-t border-gray-300">
						            
						                    <likes :likings="$page.props.postWithComments.isLiked" :postId="$page.props.postWithComments.id" :countedLikes="$page.props.postWithComments.likes_count" :detect="'post'"></likes>
						        
						                    <div class="flex space-x-2 inline-flex items-center" >
						                        <span class="text-xs">comments</span>
						                        <span class="text-sm">{{ countComment }}</span>
						                    </div>
						                </div>
						            </div>
						            
						            <!-- display comments -->
						           <!--  <div class="w-full max-w-xl border border-gray-300 rounded-2xl py-3 px-4 md:px-5 my-3">
						            	<div v-for="(comment,i) in comments" :key="comment.id" class="border-gray-300 mt-4 py-3">
						                	<div class="flex">
							                    <div class="mr-2">
							                        <img class="rounded-full w-16 h-16" :src="comment.commenter.profile_photo_url" :alt="comment.commenter.name" />
							                    </div>
							                    <div>
							                        <div class="flex space-x-1">
							                            <span class="font-bold">{{ comment.commenter.name }}</span>
							                        </div>
							                        <div class="text-gray-500 text-sm">@{{ comment.commenter.username }}</div>
							                    </div>
							                </div>

							                <div class="py-3">
							                    <figure v-if="comment.comment_upload">
							                        <img class="w-full h-56 object-cover" :src="comment.commentUrl">
							                    </figure>
							                    <div v-if="comment.reply" v-html="comment.reply" class="text-lg"></div>
							                    <div class="flex">
							                        <p class="text-gray-500 pt-1 text-xs">{{ commentTime(comment.created_at) }}</p>
							                        
							                    </div>

							                    <div class="flex space-x-5 pt-3 text-gray-500 border-t border-gray-300"> -->
						            				<!-- like button -->
								                   <!--  <likes :likings="comment.isLiked" :postId="comment.id" :countedLikes="comment.likes_count" :detect="'comment'"></likes>
								                </div>
							                </div>
						                </div>
						            </div>
 -->
						            <div class="flow-root w-full max-w-xl py-3 px-4 md:px-5 my-3">
						            	<ul role="list" class="-mb-8">
									      	<li v-for="(comment,i) in comments" :key="comment.id">
										        <div class="relative pb-8">
										          	<span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" style="top: 1.25rem;left: 1.25rem; margin-left: -1px;width: 0.125rem;"/>
										          	<div class="relative flex items-start space-x-3">
										              	<div class="relative">
										                	<img class="h-10 w-10 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white" :src="comment.commenter.profile_photo_url" :alt="comment.commenter.name" />

										                	<span class="absolute -bottom-0.5 -right-1 bg-white rounded-tl px-0.5 py-px" style="top: 1.875rem;
															    right: -0.25rem;
															    padding-top: 1px;
															    padding-bottom: 1px;
															    padding-left: 0.125rem;
															    padding-right: 0.125rem;">
										                  		<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
																  	<path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
																</svg>
										                	</span>
										              	</div>
										              	<div class="min-w-0 ml-3 flex-1">
										                	<div>
										                  		<div class="text-sm">
										                    		<a href="#" class="font-medium text-gray-900">{{ comment.commenter.name }}</a>
										                  		</div>
										                  		<p class="mt-0.5 text-sm text-gray-500">{{ commentTime(comment.created_at) }}</p>
										                	</div>
										                	<div class="mt-2 text-sm text-gray-700">
										                  		<figure v-if="comment.comment_upload">
											                        <img class="w-full h-56 object-cover" :src="comment.commentUrl">
											                    </figure>
											                    <div v-if="comment.reply" v-html="comment.reply" class="text-lg"></div>
											                    <div class="flex">
											                        <p class="text-gray-500 pt-1 text-xs">{{ commentTime(comment.created_at) }}</p>
											                        
											                    </div>

											                    <div class="flex space-x-5 pt-3 text-gray-500 border-t border-gray-300">
										            				<!-- like button -->
												                    <likes :likings="comment.isLiked" :postId="comment.id" :countedLikes="comment.likes_count" :detect="'comment'"></likes>
												                </div>
										                	</div>
										              </div>
										          	</div>
										        </div>
									      	</li>
									    </ul>
						            </div>
						            

						            
						            <!-- make a comment -->
						                
					                <div class="px-2 w-full relative border-gray-300 fixed bottom-0">
									  	<div class="flex flex-row  items-center  bottom-0 my-2 w-full">
										    <div
										      class="flex flex-row border-gray items-center w-full border-b h-12 px-2"
										    >
											    <div class="w-full">
											        <textarea rows="2" class="border rounded-lg border-transparent w-full text-sm h-10 flex items-center" cols="2" placeholder="Reply post..." v-model="form.reply"></textarea>
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

										        

										      	</div>
										    </div>
									    </div>
									    <div class="justify-end w-full flex">
									        <button
									         	id="self"
									        	class="focus:outline-none flex items-center justify-center h-10 w-8 hover:text-green-600 text-green-400"
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
									      	<!-- image button -->
										    <button
									          	id="capture"      
									          	class="focus:outline-none flex items-center justify-center h-10 w-8 hover:text-green-600 text-green-400 "
									          	@click="openModal"
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
						        </div>

						        <!-- modal for comment with images -->
						        <form @submit.prevent="submit" class="w-2/3">
						        	<input ref="comment_upload"  accept="image/*" @change="photoPreview" type="file" class="hidden" />
				                    <comment-image-modal :show="showable" @close="closeModal">
				                        <template #title>
				                            upload photos
				                        </template>
				                        <template #content>
				                            <div class="my-2 flex justify-center items-center" v-show="! preview" >
				                            	<svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-blue-400 h-24 w-24" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" @click="openFile">
												  	<path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
												</svg>
				                                <!-- <img src="/storage/static/user.png" :alt="$page.props.user.name" class="h-48 w-48 object-cover cursor-pointer" > -->
				                            </div>
				                            <div class="my-2 flex justify-center items-center" v-show="preview">
				                                <span class="block rounded-full w-48 h-48 cursor-pointer"
				                                      :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + preview + '\');'" @click="openFile">
				                                </span>
				                            </div>
				                            <div class="px-2 py-3 relative border-t border-gray-300 fixed bottom-0">
										  	<div class="flex flex-row  items-center  bottom-0 my-2 w-full">
											    <div
											      class="flex flex-row border-gray items-center w-full border rounded-3xl h-12 px-2"
											    >
												    <div class="w-full">
												        <textarea rows="2" class="border rounded-2xl border-transparent w-full focus:outline-none text-sm h-10 flex items-center" cols="2" placeholder="Reply post..." v-model="form.reply"></textarea>
											      	</div>
											    </div>
											    <div class="ml-3 mr-2">
											        <button
											         	id="self"
											        	class="flex items-center justify-center h-10 w-10 mr-2 rounded-full bg-gray-200 hover:bg-gray-300 text-indigo-800 text-white focus:outline-none"
											        	@click="setImageForPost"
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
				                        </template>
				                    </comment-image-modal>
				                </form>
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
	import CommentImageModal from '@/Pages/Post/PostImage'

	export default defineComponent({
		name : 'Comments',

		components : {
			AppLayout,
			Likes,
			CommentImageModal,
			Head,
			Link,
		},

		props : {

			postId : {
				type : Number
			}
		},

		mounted(){

			Echo.channel('newCommenting').listen('NewComment', (e) => {
                this.comments.unshift(e.comment);
            });

			this.comments = this.$page.props.postWithComments.comments;

			this.countComment = this.$page.props.postWithComments.comments_count;
		},

		data(){
			return {
				form : {
					reply : '',
					comment_image : '',
					postId : this.$page.props.postWithComments.id
				},

				countComment : 0,

				comments : {},

				showComment : false,

				showable : false,

				preview : null,
			}
		},

		methods : {

            makeAComment(){
                if(this.form.reply.length > 1 || this.form.comment_image){

                    this.$inertia.post(`/posts/${this.$page.props.postWithComments.id}/comment`,this.form);
                    
                    this.form.reply = '';

                    this.form.comment_image = null;

                    this.updateCommentCount();

                    this.showable = false;
                  
                }
            },

            updateCommentCount(){
            	this.countComment ++ ;
            },

            commentTime(time){

                return moment(time).fromNow();
            },

            setImageForPost(){
                if (this.$refs.comment_upload) {

                    this.form.comment_image = this.$refs.comment_upload.files[0];

                    this.makeAComment();
                }

            },

            photoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.preview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.comment_upload.files[0]);
            },

            openModal(){
                this.showable = true;
            },

            closeModal(){
            	this.showable = false;
            },

            openFile(){
                
                this.$refs.comment_upload.click()
            },
        },

        computed : {

        	ago(){

                return moment(this.$page.props.postWithComments.created_at).fromNow();
            },
        }
	})
</script>