<template>
	<div class="flex flex-col bg-white border-r border-gray-300 w-2/6">
        <div class="my-3 mx-3 ">
            <div class="relative text-gray-600 focus-within:text-gray-400">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 text-gray-500"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input
                    aria-placeholder="Search contact"
                    placeholder="Search contacts"
                    class="py-2 pl-10 block w-full rounded bg-white border-gray-300 outline-none focus:text-gray-700 focus:border-purple-700"
                    type="search"
                    name="search"
                    required
                    autocomplete="search"
                />
            </div>
        </div>

        <h2 class="text-gray-600 border-t border-b border-gray-300 text-lg p-3">Chats</h2>

        <ul class="overflow-auto flex-1 pr-6s">
            <li
                v-for="contact in contacts.contacts"
                :key="contact.id"
                @click="selectContact(contact)"
            >
                <div
                    :class="[selectedContact?.id == contact.id ? 'bg-gray-100' : '']"
                    class="border-b cursor-pointer border-gray-300 hover:bg-gray-200 pr-6 pl-3 py-3 flex items-center text-sm transition duration-150 ease-in-out">
                    <img
                        class="h-10 w-10 rounded-full object-cover mr-3"
                        :src="contact.profile_photo_url"
                        :alt="contact.username"
                    />

                    <div class="w-full pb-2">
                        <div class="flex justify-between">
                            <span class="block ml-2 font-semibold text-base text-gray-600 ">{{ contact.name }}</span>
                            <span class="block ml-2 text-xs text-gray-600">5 minutes</span>
                        </div>
                        <span class="block ml-2 text-sm text-gray-600">Hello world!!</span>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
	import moment from 'moment'
    export default {
        props: {
            contacts: {
                type: Object,
                default: () => ({})
            }
        },
        emits : ['selected'],

        data() {
            return {
                selectedContact: null,
            }
        },

        methods: {
            selectContact(contact){
                if (this.selectedContact?.id !== contact.id) {
                    this.selectedContact = contact;
                    this.$emit('selected', contact);
                }
            }
        }

    }
</script>
