<template>
    <v-app id="inspire" >
      <!-- <v-system-bar>
        <v-spacer></v-spacer>

        <v-icon>mdi-square</v-icon>

        <v-icon>mdi-circle</v-icon>

        <v-icon>mdi-triangle</v-icon>
      </v-system-bar> -->

      <!-- <v-app-bar >
        <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

        <v-app-bar-title>Application</v-app-bar-title>
      </v-app-bar>

      <v-navigation-drawer
        v-model="drawer"
        temporary
      >

      </v-navigation-drawer> -->



<nav class="bg-white border-b border-b-gray-300 z-50">
    <div class="flex align-middle flex-wrap items-center mx-auto max-w-screen-xl p-4 ">
        <!-- <a href="https://flowbite.com" class="flex items-center space-x-3 rtl:space-x-reverse"> -->
            <img src="../../../public/images/header_logo.d5a605ec.png" class="h-12 pt-3" alt="" />
            <!-- <span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span> -->
        <!-- </a> -->
        <button data-collapse-toggle="mega-menu-full" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 " aria-controls="mega-menu-full" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div id="mega-menu-full" class="items-center justify-between font-medium hidden w-full md:flex md:w-auto md:order-1">
            <ul class="flex flex-col p-4 md:p-0 mt-4  rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white md ">
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#29d2bf] md:p-0  " aria-current="page">Home</a>
                </li>
                <li>
                    <button @click="megaMenu = !megaMenu" id="mega-menu-full-dropdown-button" data-collapse-toggle="mega-menu-full-dropdown" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded md:w-auto hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#29d2bf] md:p-0  ">PTE Practice <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
  </svg></button>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#29d2bf] md:p-0  ">Course</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#29d2bf] md:p-0  ">Circle</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#29d2bf] md:p-0  ">APP</a>
                </li>
            </ul>
            <div v-if="user" class="relative hidden sm:inline-flex md:inline-flex lg:inline-flex items-center justify-center ml-96 w-10 h-10 overflow-hidden rounded-full"
                :class="bg_color"
            >
            <Link :href="route('dashboard.settings.view')">
                <span class="font-medium text-gray-600">{{ user.name.charAt(0) + user.last_name.charAt(0) }}</span>
            </Link>
            </div>
        </div>
    </div>
    <div v-if="megaMenu" @mouseover="megaMenu = true" id="mega-menu-full-dropdown" class="mt-1 border-gray-200 shadow-sm bg-gray-50 md:bg-white border-y mt-2 absolute top-20 left-28">
        <div class="grid max-w-screen-xl px-4 py-5 mx-auto text-gray-900 sm:grid-cols-2 md:grid-cols-5 ">
            <ul>
                <span class="border-b-2 ml-5 text-lg text-black border-[#29d2bf]">Speaking</span>
                <li>
                    <Link :href="route('prctice.readAloud' , '8')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Read Aloud
                            <span class="font-semibold text-xs text-red-400"> AI Score</span>
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.repeat.sentence.show' , '3')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Repeat Sentence
                            <span class="font-semibold text-xs text-red-400"> AI Score</span>
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.DescribeImage.show' , '5')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Describe Image
                            <span class="font-semibold text-xs text-red-400"> AI Score</span>
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.retellLecture.show' , '6')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Re-tell Lecture
                            <span class="font-semibold text-xs text-red-400"> AI Score</span>
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.answerShortQuestion.show' , '7')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Answer Short Questions
                            <span class="font-semibold text-xs text-red-400"> AI Score</span>
                        </div>
                    </Link>
                </li>
            </ul>
            <ul>
                <span class="border-b-2 ml-5 text-lg text-black border-[#29d2bf]">Writing
                </span>
                <li>
                    <Link :href="route('practice.summarizeWrittenText.show' , '10')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Summarize Written Text
                            <span class="font-semibold text-xs text-red-400"> AI Score</span>
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.writeEssays.show' , '11')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Write Essay
                            <span class="font-semibold text-xs text-red-400"> AI Score</span>
                        </div>
                    </Link>
                </li>
            </ul>
            <ul>
                <span class="border-b-2 ml-5 text-lg text-black border-[#29d2bf]">Reading</span>
                <li>
                    <Link :href="route('practice.rw_fib.show' , '21')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Reading & Writing: fill in the blanks</div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.r_mcm.show' , '12')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Multiple Choice</div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.l_rop.show' , '19')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Re-order Paragraphs</div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.r_fib.show' , '22')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Reading: fill in the blanks</div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.r_mcs.show' , '13')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Multiple Choice (Single)</div>
                    </Link>
                </li>
            </ul>
            <ul>
                <span class="border-b-2 ml-5 text-lg text-black border-[#29d2bf]">Listening</span>
                <li>
                    <Link :href="route('practice.l_sst.show' , '17')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Summarize Spoken Text
                            <span class="font-semibold text-xs text-red-400"> AI Score</span>
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.l_mcm.show' , '14')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Multiple Choice</div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.l_fib.show' , '23')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Fill in the blanks</div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.l_hcs.show' , '20')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Highlight Correct Summary</div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.l_mcs.show' , '15')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Multiple Choice (Single)</div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.l_smw.show' , '16')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Select Missing Word</div>
                    </Link>
                </li>
                <li>
                    <Link href="#" class="block p-3  ">
                        <div class="text-sm text-gray-500">Highlight Incorrect Word</div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('practice.l_wfd.show' , '18')" class="block p-3  ">
                        <div class="text-sm text-gray-500">Write From Dictation</div>
                    </Link>
                </li>
            </ul>
            <div class="bg-gray-200 px-10 ">
            <ul >
                <span class="border-b-2 ml-5 text-lg text-black border-[#29d2bf]">More</span>
                <li>
                    <Link href="#" class="block p-3  ">
                        <div class="text-sm text-gray-500">Vocab Books</div>
                    </Link>
                </li>
                <li>
                    <Link href="#" class="block p-3  ">
                        <div class="text-sm text-gray-500">Shadowing</div>
                    </Link>
                </li>
                <li>
                    <Link href="#" class="block p-3  ">
                        <div class="text-sm text-gray-500">AI Score Report Analysis</div>
                    </Link>
                </li>
                <li>
                    <Link href="#" class="block p-3  ">
                        <div class="text-sm text-gray-500">AI Study Plan</div>
                    </Link>
                </li>
                <li>
                    <Link href="#" class="block p-3  ">
                        <div class="text-sm text-gray-500">Mock Tests</div>
                    </Link>
                </li>
                <li>
                    <Link href="#" class="block p-3  ">
                        <div class="text-sm text-gray-500">Study Materials Download</div>
                    </Link>
                </li>
            </ul>
            
        </div>
    </div>
</div>
</nav>


      <v-main class="bg-[#fafafa]">
        <slot />
      </v-main>
      <footer>
        <div class="w-screen bg-[#292933] p-4">
            <div>
                <span class="text-gray-500 pl-32">
                    Language: English  Persian
                </span>
            </div>
            <v-divider inset thickness="2" color="#fff" class="border-opacity-70 mt-2 border-gray-100"></v-divider>
            <div class="grid max-w-screen-xl px-4 py-5 mx-auto text-gray-900 sm:grid-cols-4 md:grid-cols-4 ">
                <ul>
                <span class="ml-5 text-base text-gray-300">Pearson PTE</span>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">Pearson Official Website
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">Pearson PTE Mock Tests
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">Book PTE Tests
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">Contact Pearson PTE
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
                <li>
                    <span class="ml-5 text-base text-gray-300">Contact Us</span>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">Email: support@apeuni.com
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">Telegram: t.ne/pteapeuni
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">PartnerShip: Partnership@apeuni.com
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
            </ul>
            <ul>
                <li>
                    <span class="ml-5 text-base text-gray-300">PTE Course</span>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">PTE Speaking Course
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">PTE Writing Course
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">PTE Reading Course
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">PTE Listening Course
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
            </ul>
            <ul>
                <li>
                    <span class="ml-5 text-base text-gray-300">PTE Resources</span>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">Study Materials Download
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
            </ul>
            <ul>
                <li>
                    <span class="ml-5 text-base text-gray-300">APP Download</span>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">APEUni iOS APP
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
                <li>
                    <Link :href="route('prctice.readAloud' , '1')" class="block ml-5">
                        <div class="text-base text-gray-500 hover:text-[#29d2bf]">APEUni Android APP
                            <!-- <span class="font-semibold text- text-red-400"> AI Score</span> -->
                        </div>
                    </Link>
                </li>
            </ul>
        </div>
        <v-divider inset thickness="2" color="#fff" class="border-opacity-70 mt-2 border-gray-100"></v-divider>
        <ul>
            <span class="text-gray-400 ml-20">Shenzhen APEUni Education Technology Co., Ltd.</span>
        </ul>
        </div>
      </footer>
    </v-app>
  </template>
<script setup>
  import { ref } from 'vue'
  import { Link } from '@inertiajs/vue3'
  import { computed } from 'vue'
  import { usePage } from '@inertiajs/vue3'

const page = usePage()

const user = computed(() => page.props.auth?.user)

  const bg_color = ref('bg-gray-200')
  const drawer = ref(null)
  const megaMenu = ref(false)
</script>

<script>
  export default {
    data: () => ({ drawer: null }),
  }
</script>
