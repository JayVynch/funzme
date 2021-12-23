<template>
	<div class="col-span-1 bg-white border-r border-gray-300">
        <div class="my-3 mx-3 ">
            <div class="relative text-gray-600 focus-within:text-gray-400">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 text-gray-500"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input aria-placeholder="search contact" placeholder="search contacts"
                class="py-2 pl-10 block w-full rounded bg-gray-100 outline-none focus:text-gray-700" type="search" name="search" required autocomplete="search" />
            </div>
        </div>

        <ul class="overflow-auto" style="height: 500px;">
            <h2 class="ml-2 mb-2 text-gray-600 text-lg my-2">Chats</h2>
            <li v-for="(contact, index) in contacts.contacts" :key="contact.id" @click="selectedContact(index,contact)" >
                <a :class="` border-b{index == selected ? ' bg-gray-100' : ' hover:bg-gray-100'  } border-gray-300 px-3 py-2 cursor-pointer flex items-center text-sm focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out`">
                    <img class="h-10 w-10 rounded-full object-cover"
                    :src="contact.profile_photo_url"
                    :alt="contact.username" />
                    <div class="w-full pb-2">
                        <div class="flex justify-between">
                            <span class="block ml-2 font-semibold text-base text-gray-600 ">{{ contact.name }}</span>
                            <span class="block ml-2 text-sm text-gray-600">5 minutes</span>
                        </div>
                        <span class="block ml-2 text-sm text-gray-600">Hello world!!</span>
                    </div>
                </a>
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
                default: {}
            }
        },
        emits : ['selected'],
         
        data() {
            return {
                selected: 0
            }
        },

        methods: {
            selectedContact(index, contact){
                this.selected = index;
                this.$emit('selected', contact);
            }
        }
       
    }
</script>