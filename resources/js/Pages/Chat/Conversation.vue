<template>
    <div class="flex-1 bg-white flex flex-col">
        <div class="flex items-center border-b border-gray-300 pl-3 py-3" v-if="contact">
            <img class="h-10 w-10 rounded-full object-cover" :src="contact.profile_photo_url" :alt="contact.username" />
            <span class="block ml-2 font-bold text-base text-gray-600">{{ contact.name }}</span>
            <!-- <span class="connected text-green-500 ml-2" >
                    <svg width="6" height="6">
                        <circle cx="3" cy="3" r="3" fill="currentColor"></circle>
                    </svg>
                </span> -->
        </div>

        <div class="flex flex-col flex-1">
            <Feeds :messages="messages" :contact="contact" animateScroll></Feeds>
            <Composer @send="sendMessage" :contact="contact" @fileReady="persist"></Composer>
        </div>
    </div>
</template>

<script>
import Feeds from './Feeds';
import Composer from './Composer';

export default {
    props: {
        contact: {
            type: Object,
            default: null
        },

        messages: {
            type: Array,
            default: []
        },

    },

    emits: ['new'],

    methods: {

        sendMessage(text) {

            if (!this.contact) {
                return;
            }

            axios.post(`/users/${this.contact.id}/direct/message`, {
                contact_id: this.contact.id,
                message: text
            }).then((response) => {
                this.$emit('new', response.data.message);
            })
        },

        persist(file) {

            let form = new FormData();

            form.append('message', file);

            form.append('contact_id', this.contact.id)

            axios.post('/chat/fileupload', form)
                .then((response) => {
                    this.$emit('new', response.data);
                    // window.location.reload();
                })
                .catch(error => {
                    flash('Something went wrong, image size must be max 3mb');
                    // window.location.reload();
                });
        },
    },

    components: { Feeds, Composer }
}
</script>
