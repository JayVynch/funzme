<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-pink-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-700 active:bg-pink-900 focus:outline-none focus:border-pink-900 focus:shadow-outline-pink transition ease-in-out duration-150">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
