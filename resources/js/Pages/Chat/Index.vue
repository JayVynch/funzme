 <template>
 	<app-layout>
		<div class="w-screen">
	    	<div class="grid grid-cols-3 min-w-full border rounded" style="min-height: 100%;">		
				<ContactList :contacts="contacts"  @selected="startCoversationWith" />
				<Conversation :contact="selectedContact" :messages="messages"  @new="saveNewMessage" />	
			</div>
		</div>
	</app-layout>
</template>

<script>
	import { defineComponent } from 'vue'
	import AppLayout from '@/Layouts/AppLayout'
	import Conversation from './Conversation';
	import ContactList from './Contact';
 
	export default defineComponent({

		data (){
			return {
				selectedContact: null,
				messages: [],
				contacts: []
			} 
		},

		mounted() {
			this.liveListen();
					
			axios.get(`/users/${this.$page.props.user.id}/contacts`)
			.then((response) => {
				this.contacts = response.data;
			});	
		},

		methods: {

			startCoversationWith(contact){
				axios.get(`/users/${contact.id}/direct/messages`)
				.then((response) => {
					this.messages 			= response.data;
					this.selectedContact 	= contact;
				})

			},
			saveNewMessage(message){
				this.messages.push(message);
			},

			handleIncoming(message){
				if(this.selectedContact && message.sender == this.selectedContact.id){
					this.saveNewMessage(message);
				}
			},

			liveListen(){
				
				Echo.channel("DirectMessaging")
				.listen('NewChatMessage', (e) => {
				    this.handleIncoming(e.chat);
				});
				
			}
		},

		components : { Conversation, ContactList, AppLayout }
	})
</script>