<template>
	<div class="ml-3 relative flex justify-center items-center">
        <notification-dropdown align="right" width="60">
            <template #trigger>
                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out " @click="getNotification">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 h-4 text-red-700" viewBox="0 0 24 24">
                    	<path d="M15.137 3.945c-.644-.374-1.042-1.07-1.041-1.82v-.003c.001-1.172-.938-2.122-2.096-2.122s-2.097.95-2.097 2.122v.003c.001.751-.396 1.446-1.041 1.82-4.667 2.712-1.985 11.715-6.862 13.306v1.749h20v-1.749c-4.877-1.591-2.195-10.594-6.863-13.306zm-3.137-2.945c.552 0 1 .449 1 1 0 .552-.448 1-1 1s-1-.448-1-1c0-.551.448-1 1-1zm3 20c0 1.598-1.392 3-2.971 3s-3.029-1.402-3.029-3h6z"/>
                	</svg>
                </button>
            </template>

            <template #content>
                <div v-if="hasNotification" class="absolute right-0 origin-top-right block mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20" style="width:20rem;">
		            <div class="py-2">
		                <inertia-link v-for="(notification, i ) in notifications" :key="notification.id" :href="notification.data.link" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2" @click="markAsRead(notification.id)">
		                    <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">
		                    <div class="text-gray-600 text-sm w-full mx-2 flex flex-col">
		                        <div class="font-bold w-full">{{ notification.data.message }}
		                        </div>
		                        <div class="text-xs w-full flex justify-end">{{ ago(notification.created_at)  }}</div>
		                    </div>
		                </inertia-link>
		                
		            </div>
		            <inertia-link :href="route('dashboard')" class="block bg-gray-800 text-white text-center font-bold py-2">See all notifications</inertia-link>
		        </div>
            </template>
        </notification-dropdown>
    </div>
</template>

<script>
	import NotificationDropdown from '@/Jetstream/Dropdown'
	import moment from 'moment'

	export default {

		components : {
			NotificationDropdown
		},

		data(){
			return {
				notifications : [],

				hasNotification : false,

				id : null,
			}
		},

		mounted(){

			this.getNotifications();

			Echo.private(`App.Models.User.${this.$page.props.user.id}`).
			notification((n) => {
				var notification = new Array();
				var id = n.id;
				var data = {};
				data['id'] = n.id;
				data['data'] = n;
				notification[0] = data;
				this.notifications.unshift(data);

				// setTimeout( () => this.getNotifications(),500);
			})
		},

		methods : {

			getNotifications(){
				axios.get(`/users/${this.$page.props.user.username}/notifications`).
				then( (e) => {
					this.notifications = e.data.notifications;
				})
			},

            ago(time){

                return moment(time).fromNow();
            },

            getNotification(){
            	return this.hasNotification = !this.hasNotification;
            },

            markAsRead(id){
            	axios.post('/notifications/' + id,{
            		id : id
            	})
            },
        }
	}
</script>