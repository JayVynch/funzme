<template>
	<ul>
        <li class="clearfix2">
            <div ref="feed"  class="w-full flex${message.sender == contact.id ? ' justify-start ' : ' justify-end'  }" v-for="message in messages" :key="message.id">
                <div class="bg-gray-100 rounded px-5 py-2 my-2 mx-2 text-gray-700 relative" style="max-width: 300px;">
                    <span class="block">{{ message.message }}</span>
                    <span class="block text-xs text-right">{{ ago(message.created_at) }}</span>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
	import moment from 'moment'
    export default{
        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                required: true
            }
        },

        data() {
            return {
                textType : 0,
            }
        },

        methods : {

        	ago(time){

                return moment(time).fromNow();
            },

            scrollToBottom(){
                // this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            }
        },

        computed : {

            checkMessage(){

                return (this.messages.indexOf('/home')) ? this.textType = 1 : this.textType = 0 ;
            }
        },

        watch: {
            contact(contact){
                this.scrollToBottom();
            },
            messages(messages){
                this.scrollToBottom();

                if(this.messages.includes('/home')) { this.textType = 1 } else { this.textType = 0 ; }
            }
        }
    }
</script>
<style scoped>
    .scroll{
        overflow:auto;
    }

    .chatbox-messages .message.reply figure{
        margin-left: 0px !important; 
    }
</style>