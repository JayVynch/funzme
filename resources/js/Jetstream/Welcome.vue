<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

            <div class="mt-8 text-2xl flex flex-col w-full justify-center items-center">
                <form @submit.prevent="submit" class="w-2/3">
                    <textarea class="w-full rounded-lg" v-model="form.post" placeholder="what&apos;s on your mind..."></textarea>
                    <div class="flex justify-between">
                        <button class="ml-4 inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-blue transition ease-in-out duration-150" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 h-4" viewBox="0 0 24 24"><path d="M24 0l-6 22-8.129-7.239 7.802-8.234-10.458 7.227-7.215-1.754 24-12zm-15 16.668v7.332l3.258-4.431-3.258-2.901z"/></svg>
                        </button>
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 h-4" viewBox="0 0 24 24"><path d="M18 5l-2-3h-8l-2 3h-6v17h24v-17h-6zm4 7h-4.079c.581 3.754-2.312 7-5.921 7-3.612 0-6.501-3.248-5.921-7h-4.079v-5h5.07l2-3h5.859l2 3h5.071v5zm-10-3c-2.243 0-4 1.73-4 3.939 0 2.239 1.794 4.061 4 4.061s4-1.822 4-4.061c0-2.209-1.757-3.939-4-3.939zm-.436 3.555c-.632.503-1.461.5-1.852-.006-.39-.506-.194-1.324.438-1.827.632-.502 1.461-.499 1.851.007.391.505.195 1.323-.437 1.826z"/></svg>
                        </button>
                    </div>
                </form>

                <Post />
            </div>
        </div>

        
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
    import Post from '@/Pages/Post/article.vue'

    export default {
        components: {
            JetApplicationLogo,
            Post
        },

        data() {
            return{
                form:{
                    post: '',
                },
            }
        }
    }
</script>
