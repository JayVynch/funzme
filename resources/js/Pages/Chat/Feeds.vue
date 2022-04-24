<template>
    <div class="overflow-y-auto flex flex-grow py-4 relative bg-gray-50">
        <div class="absolute top-0 left-0 w-full h-full px-4" ref="chatPage" >
            <div
                v-for="message in messages"
                :key="message.id"
                class="`w-full flex"
                :class="[message.sender == contact.id ? ' justify-start ' : ' justify-end']">
                <div
                    class="rounded-lg px-5 py-2 my-2 mx-2 relative border"
                    :class="`${message.sender == contact.id ? ' bg-white  border-gray-300' : 'bg-purple-100 border-purple-300'}`"
                    style="max-width: 55%;">
                    <span class="block">{{ message.message }}</span>
                    <span class="block text-xs text-right text-gray-500 mt-1s">{{ ago(message.created_at) }}</span>
                </div>
            </div>

            <div ref="chatEnd"></div>

            <div class="flex flex-col h-full" v-if="contact?.name && !hasMessages">
                <p class="mt-auto text-center py-3 text-gray-500">No messages with {{ contact?.name }}</p>
            </div>

            <div class="flex flex-col h-full justify-center items-center" v-if="!contact?.name">
                <p class="py-3 text-gray-500">Please select a contact to chat with</p>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    props: {
        contact: {
            type: Object
        },
        messages: {
            type: Array,
            required: true
        },
        animateScroll: {
            type: Boolean,
            default: false,
        }
    },
    data() {
        return {
            chatObserver: null,
        }
    },
    computed: {
        hasMessages() {
            return this.messages.length > 0;
        }
    },
    methods: {
        scrollChat(messages, oldMessages) {
            const target = this.$refs.chatEnd;
            const targetParent = this.$el;

            const opts = {
                root: targetParent,
                threshold: 1.0,
            };

            // scrolls chat to bottom on initial messages
            if (oldMessages?.length === 0) {
                this.$el.scrollTop = this.$refs.chatPage.scrollHeight;
            }

            const observer = new IntersectionObserver(([entry]) => {
                if (!entry.isIntersecting) {
                    entry.target.scrollIntoView({ behavior: this.animateScroll ? 'smooth' : 'auto' });
                }
            }, opts);

            this.chatObserver = observer;
            this.chatObserver.observe(target);
        },

        ago(time) {
            return moment(time).fromNow();
        },

    },
    watch: {
        messages: {
            handler(messages, oldMessages) {
                this.$nextTick(() => this.scrollChat(messages, oldMessages));
            },
            immediate: true,
            deep: true,
        }
    },
    unmounted() {
        this.chatObserver?.disconnect();
    },
}
</script>

<style scoped>
.scroll {
    overflow: auto;
}

.chatbox-messages .message.reply figure {
    margin-left: 0px !important;
}
</style>
