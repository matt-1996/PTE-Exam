<template>
<MainLayout>
    <v-container>
        <v-row>
            <v-col cols="3">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>

<aside side id="logo-sidebar" class="relative border-gray-100 top-0 left-0 z-40 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full  py-4 border overflow-y-auto bg-white">
      <!-- <Link href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
         <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
         <span class="self-center text-xl font-semibold whitespace-nowrap">Flowbite</span>
      </Link> -->
      <div class="ml-4">
          <Avatar />
          <span class="ml-2">{{ user.name }}</span>
      </div>
      <div class="border-b-2 border-gray-200 p-2">

      </div>
      <ul class="space-y-2 font-medium">
         <li :class="{'bg-gray-300 border border-r-2 border-black' : route().current('dashboard.home')}">
            <Link :href="route('dashboard.home')"  class="flex items-center p-4 text-gray-900 rounded-lg group">
              <v-icon>mdi-home</v-icon>
               <span class="ms-3">Home</span>
            </Link>
         </li>
         <li :class="{'bg-gray-300 border border-r-2 border-gray-400' : route().current('dashboard.my-cources')}">
            <Link :href="route('dashboard.my-cources')" class="flex items-center p-4 text-gray-900 rounded-lg group">
                <v-icon>mdi-video</v-icon>
               <span class="flex-1 ms-3 whitespace-nowrap">My Courses</span>
               <!-- <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full">Pro</span> -->
            </Link>
         </li>
         <li :class="{'bg-gray-300 border border-r-2 border-gray-400' : route().current('user.dashboard.study-center')}">
            <Link href="#" class="flex items-center p-4 text-gray-900 rounded-lg group">
                <v-icon>mdi-book</v-icon>
               <span class="flex-1 ms-3 whitespace-nowrap">Study Center</span>
               <!-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">3</span> -->
            </Link>
         </li>
         <li :class="{'bg-gray-300 border border-r-2 border-gray-400' : route().current('user.dashboard.mock-test')}">
            <Link href="#" class="flex items-center p-4 text-gray-900 rounded-lg group">
                <v-icon>mdi-pen</v-icon>
               <span class="flex-1 ms-3 whitespace-nowrap">Mock Tests</span>
            </Link>
         </li>
         <li :class="{'bg-gray-300 border border-r-2 border-gray-400' : route().current('user.dashboard.vocab-books')}">
            <Link href="#" class="flex items-center p-4 text-gray-900 rounded-lg group">
                <v-icon>mdi-note</v-icon>
               <span class="flex-1 ms-3 whitespace-nowrap">Vocab Books</span>
            </Link>
         </li>
         <li :class="{'bg-gray-300 border border-r-2 border-gray-400' : route().current('dashboard.settings.view')}">
            <Link :href="route('dashboard.settings.view')" class="flex items-center p-4 text-gray-900 rounded-lg group">
                <v-icon>mdi-cog</v-icon>
               <span class="flex-1 ms-3 whitespace-nowrap">Settings</span>
            </Link>
         </li>
         <li :class="{'bg-gray-300 border border-r-2 border-gray-400' : route().current('dashboard.vip-center')}">
            <Link :href="route('dashboard.vip-center')" class="flex items-center p-4 text-gray-900 rounded-lg group">
                <v-icon>mdi-crown</v-icon>
               <span class="flex-1 ms-3 whitespace-nowrap">VIP Center</span>
            </Link>
         </li>
         <li :class="{'bg-gray-300 border border-r-2 border-gray-400' : route().current('user.dashboard.notification-center')}">
            <Link href="#" class="flex items-center p-4 text-gray-900 rounded-lg group">
                <v-icon>mdi-bell</v-icon>
               <span class="flex-1 ms-3 whitespace-nowrap">Notification Center</span>
            </Link>
         </li>
         <li :class="{'bg-gray-300 border border-r-2 border-gray-400' : route().current('dashboard.faq')}">
            <Link :href="route('dashboard.faq')" class="flex items-center p-4 text-gray-900 rounded-lg group">
                <v-icon>mdi-help</v-icon>
               <span class="flex-1 ms-3 whitespace-nowrap">Help Q&A</span>
            </Link>
         </li>
         <li :class="{'bg-gray-300 border border-r-2 border-gray-400' : route().current('dashboard.contact-us')}">
            <Link :href="route('dashboard.contact-us')" class="flex items-center p-4 text-gray-900 rounded-lg group">
                <v-icon>mdi-chat</v-icon>
               <span class="flex-1 ms-3 whitespace-nowrap">Contact Us</span>
            </Link>
         </li>
         <li :class="{'bg-gray-300 border border-r-2 border-gray-400' : route().current('user.dashboard.logout')}">
            <Link href="#" class="flex items-center p-4 text-gray-900 rounded-lg group">
                <v-icon>mdi-logout</v-icon>
               <span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
            </Link>
         </li>
      </ul>
   </div>
</aside>

            </v-col>
            <v-col cols="9">
                <v-main class="bg-[#fafafa]">
                     <slot />
                </v-main>
            </v-col>
        </v-row>

</v-container>

</MainLayout>
</template>

<script setup>
import MainLayout from '../Layouts/MainLayout.vue'
import Avatar from '../Components/Avatar.vue'
import { computed,ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'


const page = usePage()

const user = computed(() => page.props.auth?.user)
</script>