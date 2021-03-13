<template>
	<button class="inline-flex items-center px-2 py-2 bg-transparent border border-gray-300 rounded-2xl font-semibold text-xs uppercase tracking-widest focus:outline-none transition ease-in-out duration-150 font-bold hover:bg-blue-800" @click="followThem">
		<span class="mr-2"></span>{{ followOption }}
		<span class="ml-2"></span>
	</button>
</template>

<script>
	
	export default {
		name : 'Follow',

		props : {

			email : {
				type : String
			},

			isFollowing : {
				type : Boolean
			}
		},

		methods : {

			followThem(){
				axios.post(`/users/${this.email}/follow`,{
					emial : this.email
				})
			},
		},

		computed : {

			followOption(){
				return this.isFollowing ? 'Following' : 'Follow'
			}
		}
	}
</script>