<template>
<div v-if="user" class="relative z-10 hidden sm:inline-flex md:inline-flex lg:inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full"
                :class="bg_color">
    <span class="font-medium text-gray-600">{{ user.name.charAt(0) + user.last_name.charAt(0) }}</span>
    <!-- <span class="bottom-0 left-10 absolute z-50 w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span> !-->
    </div> 
</template>

<script setup>
import { computed,ref } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const user = computed(() => page.props.auth?.user)

const bg_color = ref('bg-gray-200')

</script>