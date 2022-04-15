<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Dashboard
            </h2>
        </template>

        <div class="md:py-12">
            <div class="w-full lg:max-w-7xl mx-auto px:2 md:px-6 lg:px-8 ">
                <div class="bg-pink-300 overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
        },
    })
</script>
