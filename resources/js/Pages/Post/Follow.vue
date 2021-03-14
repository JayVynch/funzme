<template>
	<div>
		<button class="inline-flex items-center px-2 py-2 bg-transparent border border-gray-300 rounded-2xl font-semibold text-xs uppercase tracking-widest focus:outline-none transition ease-in-out duration-150 font-bold hover:bg-blue-800" @click="getFollow">
			<span class="mr-2"></span>{{ followOption }}
			<span class="ml-2"></span>
		</button>

		<!-- modal for follow/unfollow -->
	    <follow-unfollow-modal :show="showable">
            <template #title>
            </template>
            <template #content>
                <div class="flex flex-col mt-7 justify-center items-center w-full">
                    <span>Are you sure you want to unfollow ?</span>
    
                    <button class="bg-red-500 border-none px-4 py-2 rounded-xl cursor-pointer text-white shadow-xl hover:shadow-inner transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105 mt-4" @click="unfollowThem">
                    	Unfollow
                    </button>
                </div>
            </template>
        </follow-unfollow-modal>
    </div>
</template>

<script>
	import FollowUnfollowModal from '@/Pages/Post/PostImage'

	export default {
		name : 'Follow',

		props : {

			email : {
				type : String
			},

			isFollower : {
				type : Boolean
			}
		},

		data(){
			return {
				showable : false,

				FollowStatus : this.isFollower
			}
		},

		methods : {

			getFollow(){
				if (this.isFollower == true) {
					this.openModal()
				}else{
					this.followThem()
				}
			},

			followThem(){
				axios.post(`/users/${this.email}/follow`,{
					emial : this.email
				}).then( ()=>{
					this.showable = true
				})
			},

			unfollowThem(){
				axios.delete(`/users/${this.email}/unfollow`,{
					emial : this.email
				}).then( ()=>{
					this.showable = false
				})
			},

			openModal(){
                this.showable = true;
            },
		},

		computed : {

			followOption(){
				return this.FollowStatus   ? 'Following' : 'Follow'
			}
		},

		components : {
			FollowUnfollowModal,
		}
	}
</script>