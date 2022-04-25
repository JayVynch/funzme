<template>
    <form v-if="contact?.name" @submit.prevent="send" class="py-4 px-3 flex items-center justify-between border-t border-gray-300">
        <button class="outline-none focus:outline-none" type="button">
            <svg class="text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </button>

        <!-- <button class="outline-none focus:outline-none ml-1">
            <svg class="text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
            </svg>
        </button> -->

        <input
            aria-placeholder="Write your message..."
            placeholder="Write your message..."
            class="py-4 mx-3 pl-5 block w-full rounded bg-white border-gray-300 outline-none focus:border-purple-700" type="text" v-model="message"
        />
        <!-- <textarea aria-placeholder="Write your message..." rows="2" placeholder="Write your message..."
            class="mx-3 block w-full rounded resize-none bg-white border-gray-300 outline-none focus:border-purple-700"
            type="text" v-model="message"></textarea> -->

        <button class="outline-none focus:outline-none" type="submit">
            <svg class="text-gray-400 h-7 w-7 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
            </svg>
        </button>
    </form>
</template>

<script>
// import ChatUpload from './ChatUpload';

export default {
    props: {
        contact: {
            type: Object,
            default: () => ({})
        }
    },
    data() {
        return {
            message: '',
            upload: false,
            uploads: ''
        }
    },

    emits: ['send', 'fileReady'],

    methods: {

        send() {

            // e.preventDefault();
            if (this.message == '') {
                return;
            }

            this.$emit('send', this.message);
            this.message = '';
        },

        prepareUpload(file) {

            this.uploads = file;

            this.$emit('fileReady', this.uploads);
        },

        popUp() {
            this.upload = true;
        }
    },

    // components : { ChatUpload }
}
</script>
