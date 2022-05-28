<template>
    <div class="flex sm:hidden items-center justify-center w-3/4 relative">
        <!-- component -->
        <div class="relative text-gray-600 w-full">
            <button type="button" class="flex text-sm w-full justify-end border-2 border-transparent rounded-full" @click="beginSearch">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        
            <search-modal :show="search" @close="closeModal">
                <template #title>
                    <div class="flex justify-between">
                        <h2>
                            Search
                        </h2>
                        <button class="w-10 h-10 rounded-full flex items-center justify-center text-purple-900 hover:text-pink-700" @click="closeModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                    </div>
                </template>
                <template #content>
                    <div >
                        <input type="search" v-model="keyword" placeholder="Search with first or last name" class="bg-white h-10 px-5 pr-10 rounded-lg text-sm focus:outline-none w-full
                        ">
                        <div v-if="users.length > 0" class="    w-full border mt-2 rounded-lg border-gray-300 bg-white divide-y divide-gray-100 py-2 px-4 z-50">
                            <Link :href="route('users.page',user.username)" class="flex px-4 py-2 space-y-2 w-full border-gray-300" v-for="(user,i) in users" :key="user.id">
                                <div class="mr-2 flex items-center justify-center">
                                    <img class="rounded-full w-8 h-8" :src="user.profile_photo_url" :alt="user.name" />
                                </div>
                                <div>
                                    <div class="flex space-x-1">
                                        <span class="font-bold">{{ user.name }}</span>
                                    </div>
                                    <div class="text-gray-500 text-sm">@{{ user.username }}</div>
                                </div>
                            </Link>
                        </div>
                    </div>
                </template>
            </search-modal>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import SearchModal from '@/Pages/Post/PostImage'

    export default defineComponent({
        data() {
            return {
                keyword: null,
                users: [],
                search : false,
            };
        },
        watch: {
            keyword(after, before) {
                this.getResults();
            }
        },
        methods: {
            getResults() {
                if(this.keyword != ''){
                    axios.get('/users/search', { params: { keyword: this.keyword } })
                    .then(res => {
                        console.log(res)
                        this.users = res.data.users
                    })
                    .catch(error => {});
                }else{
                    this.users = [];
                }
            },
            beginSearch(){
                this.search = true;
            },
            closeModal(){
                this.search = false;
            }
        },

        components:{
            Head,
            Link,
            SearchModal
        }
    })
</script>