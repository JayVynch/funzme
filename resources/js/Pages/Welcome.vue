<template>
    <div class="bg-white">
        <div class="relative overflow-hidden">
            <Head title="Welcome" />
            <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
                <div v-if="canLogin" class="relative top-0 right-0 w-full sm:block">
                    <Popover as="header" class="relative">
                        <div class="bg-purple-900 pt-6">
                            <nav class="relative max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6" aria-label="Global">
                                <div class="flex items-center flex-1">&nbsp;</div>
                                <div class="hidden md:flex md:items-center md:space-x-6">
                                    <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 underline">
                                        Dashboard
                                    </Link>

                                    <template v-else>
                                        <div class="hidden md:flex md:items-center md:space-x-6">
                                            <Link :href="route('login')" class="text-base font-medium text-white hover:text-gray-300 ml-0">
                                                Log in
                                            </Link>

                                            <Link v-if="canRegister" :href="route('register')" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-pink-600 hover:bg-pink-700">
                                                Register
                                            </Link>
                                        </div>
                                    </template>
                                </div>
                            </nav>
                        </div>
                        <transition enter-active-class="duration-150 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
                            <PopoverPanel focus class="absolute top-0 inset-x-0 p-2 transition transform origin-top md:hidden">
                                <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                                    <div class="px-5 pt-4 flex items-center justify-between">
                                        <div>
                                            <jet-authentication-card-logo />
                                        </div>
                                        <div class="-mr-2">
                                            <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-600">
                                                <span class="sr-only">Close menu</span>
                                                <button class="h-6 w-6" aria-hidden="true">x</button>
                                            </PopoverButton>
                                        </div>
                                    </div>
                                    <div class="pt-5 pb-6">
                                        <div class="px-2 space-y-1">
                                          <a v-for="item in navigation" :key="item.name" :href="item.href" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-gray-50">{{ item.name }}</a>
                                        </div>
                                        <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 underline">
                                            Dashboard
                                        </Link>

                                        <template v-else>
                                            <div class="hidden md:flex md:items-center md:space-x-6">
                                                <Link :href="route('login')" class="text-base font-medium text-white hover:text-gray-300 ml-0">
                                                    Log in
                                                </Link>

                                                <Link v-if="canRegister" :href="route('register')" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-pink-600 hover:bg-pink-700">
                                                    Register
                                                </Link>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </PopoverPanel>
                        </transition>
                    </Popover>

                    <main>
                        <div class="pt-10 bg-purple-900 sm:pt-16 lg:pt-8 lg:pb-14 lg:overflow-hidden">
                            <div class="mx-auto max-w-7xl lg:px-8">
                                <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                                    <div class="mx-auto max-w-md px-4 sm:max-w-2xl sm:px-6 sm:text-center lg:px-0 lg:text-left lg:flex lg:items-center">
                                        <div class="lg:py-24">
                                          
                                            <h1 class="mt-4 tracking-tight font-extrabold text-white sm:mt-5 sm:text-6xl lg:mt-6 xl:text-6xl">
                                                <span class="block text-6xl">Purr</span>
                                                <span class="text-4xl pb-3 block bg-clip-text text-transparent bg-gradient-to-r from-teal-200 to-cyan-400 sm:pb-5">...let&apos;s shake purrs and connect </span>
                                            </h1>
                                            <p class="text-base text-gray-300 sm:text-xl lg:text-lg xl:text-xl">
                                                A Vynchie&apos;s Project
                                            </p>

                                            <div class="mt-10 sm:mt-12">
                                                <div class="flex items-center space-x-6 md:hidden">
                                                    <Link :href="route('login')" class="text-base font-medium text-white hover:text-gray-300 ml-0">
                                                        Log in
                                                    </Link>

                                                    <Link v-if="canRegister" :href="route('register')" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-pink-600 hover:bg-pink-700">
                                                        Register
                                                    </Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-12 -mb-16 sm:-mb-48 lg:m-0 lg:relative">
                                        <div class="mx-auto max-w-md px-4 sm:max-w-2xl sm:px-6 lg:max-w-none lg:px-0">
                                          <!-- Illustration taken from Lucid Illustrations: https://lucid.pixsellz.io/ -->
                                            <svg class="fill-current text-white w-full lg:absolute lg:inset-y-0 lg:left-0 lg:h-full lg:w-auto lg:max-w-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" >
                                                <path d="M11.954 11c3.33 0 7.057 6.123 7.632 8.716.575 2.594-.996 4.729-3.484 4.112-1.092-.271-3.252-1.307-4.102-1.291-.925.016-2.379.836-3.587 1.252-2.657.916-4.717-1.283-4.01-4.073.774-3.051 4.48-8.716 7.551-8.716zm10.793-4.39c1.188.539 1.629 2.82.894 5.27-.704 2.341-2.33 3.806-4.556 2.796-1.931-.877-2.158-3.178-.894-5.27 1.274-2.107 3.367-3.336 4.556-2.796zm-21.968.706c-1.044.729-1.06 2.996.082 5.215 1.092 2.12 2.913 3.236 4.868 1.87 1.696-1.185 1.504-3.433-.082-5.215-1.596-1.793-3.824-2.599-4.868-1.87zm15.643-7.292c1.323.251 2.321 2.428 2.182 5.062-.134 2.517-1.405 4.382-3.882 3.912-2.149-.407-2.938-2.657-2.181-5.061.761-2.421 2.559-4.164 3.881-3.913zm-10.295.058c-1.268.451-1.92 2.756-1.377 5.337.519 2.467 2.062 4.114 4.437 3.269 2.06-.732 2.494-3.077 1.377-5.336-1.125-2.276-3.169-3.721-4.437-3.27z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Feature section with screenshot -->
                        <div class="relative bg-gray-50 pt-16 sm:pt-24 lg:pt-32">
                            <div class="mx-auto max-w-md px-4 text-center sm:px-6 sm:max-w-3xl lg:px-8 lg:max-w-7xl">
                                <div>
                                    <h2 class="text-base font-semibold tracking-wider text-pink-600 uppercase">vynch</h2>
                                    <p class="mt-2 text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                                        BIO
                                    </p>
                                    <p class="mt-5 max-w-prose mx-auto text-xl text-gray-500">
                                        I am Jacob George, A Fullstack PHP Developer. Major in Backend. I use PHP Frameworks like Laravel, Symfony for backend web and api development. For Styling i use Tailwindcss(preference), Bootstrap. For client side I have experience with Javascript and use javascript frameworks like Vuejs, AlpineJs, InertiaJs, Laravel Livewire. I have experience with DevOpt. Server set-up (AWS, Linode, Digital Ocean). Lastly Websockets for real time effects
                                    </p>
                                    <p class="mt-5 max-w-prose mx-auto text-xl text-gray-500">
                                        This App was built with Laravel + Vuejs + Laravel Websocket + Laravel Jetstream + TailwindCSS. Hosted Using Ploi for provisioning on a Linode Server
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature section with screenshot -->
                        <!-- <div class="relative bg-gray-50 pt-16 sm:pt-24 lg:pt-32">
                            <div class="mx-auto max-w-md px-4 text-center sm:px-6 sm:max-w-3xl lg:px-8 lg:max-w-7xl">
                                <div>
                                    <h2 class="text-base font-semibold tracking-wider text-pink-600 uppercase">demo</h2>
                                    <p class="mt-2 text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                                        How To Install
                                    </p>
                                    <p class="mt-5 max-w-prose mx-auto text-xl text-gray-500">
                                        <ul class="text-base font-semibold tracking-wider text-gray-600 ">
                                            <li>
                                                Clone or Fork Repo
                                            </li>
                                            <li>
                                                Run Composer update or Dump autoload
                                            </li>
                                            <li>
                                                Setup Your database
                                            </li>
                                            <li>
                                                Run Migration
                                            </li>
                                            <li>
                                                Run php artisan serve
                                            </li>
                                            <li>
                                                Run npm run dev or watch / yarn run dev(watch)
                                            </li>
                                            <li>
                                                Run php artisan websockets:serve
                                            </li>
                                            <li>
                                                Then Xplore
                                            </li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div> -->
                    </main>
                    <footer class="bg-gray-50" aria-labelledby="footerHeading">
                        <h2 id="footerHeading" class="sr-only">Footer</h2>
                        <div class="max-w-md mx-auto pt-12 px-4 sm:max-w-7xl sm:px-6 lg:pt-16 lg:px-8">
                            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                                <div class="space-y-8 xl:col-span-1">
                                    <div class="bg-purple-900 rounded-full px4 py-2 w-20 flex justify-center items-center">
                                        <jet-authentication-card-logo />
                                    </div>
                                    <p class="text-gray-500 text-base">
                                        Follow me on instagram, facebook, linkedIn, twitter. Hit me up for jobs or just to say hi
                                    </p>
                                    <div class="flex space-x-6">
                                        <a href="https://www.facebook.com/tammyvynch" class="text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Facebook</span>
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                              <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                            </svg>
                                        </a>

                                        <a href="https://instagram.com/tvynch" class="text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Instagram</span>
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                            </svg>
                                        </a>

                                        <a href="https://linkedin.com/in/jayvynch" class="text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Linkedin</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="current-fill h-6 w-6" viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                            </svg>
                                        </a>

                                        <a href="https://twitter.com/tvynch" class="text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Twitter</span>
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                              <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                            </svg>
                                        </a>

                                        <a href="https://github.com/JayVynch" class="text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">GitHub</span>
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                              <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-12 border-t border-gray-200 py-8">
                                <p class="text-base text-gray-400 xl:text-center">
                                    &copy; 2021 vynchie, Inc. All rights reserved.
                                </p>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent, h } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'

    const navigation = [
        { name: 'Product', href: '#' },
        { name: 'Features', href: '#' },
        { name: 'Marketplace', href: '#' },
        { name: 'Company', href: '#' },
    ]


    export default defineComponent({
        components: {
            Head,
            Link,
            Popover,
            PopoverButton,
            PopoverPanel,
            JetAuthenticationCardLogo,
        },

        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        },

        setup() {
            return {
              navigation,
            }
        },
    })
</script>
