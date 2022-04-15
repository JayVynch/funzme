<template>
    <div class="bg-purple-900 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    	<div class="w-full px-4 flex items-center justify-center flex-col my-auto min-h-screen">
	        <div>
	            <slot name="logo" />
	        </div>

	        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
	            <slot />
	        </div>
	    </div>
    </div>
</template>
