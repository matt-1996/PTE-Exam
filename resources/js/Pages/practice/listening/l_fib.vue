<template>
    <MainLayout>
        <v-container>
        <Drawer :datas="Fibs" :links="links" title="Reading & Writing：Fill in the blanks" routeName="practice.l_fib.show" :image="image" />
        <v-row class="mt-2" justify="center" align="center" offset-md="1">
                <v-col cols="3">
                    <div class="">
                        <img width="200" :src="image" alt="">
                    </div>
                </v-col>
                <v-col cols="9" class="">
                    <h2 class="text-2xl my-2">Reading & Writing：Fill in the blanks
                        <span class="rounded-md text-sm text-white p-1 bg-green-500">
                        <v-icon class="p-1">mdi-school-outline</v-icon>
                        Study Guide
                    </span></h2>
                    <p>There are some words missing in the following text. Please select the correct word in the drop-down box.</p>
                </v-col>
                <v-divider inset thickness="1" class="border-opacity-100 border-gray-200"></v-divider>
            </v-row>
            <v-row>
                <v-col cols="12" sm="10">
                    <div class="py-10">
                        <span>
                            {{ fib.title }}
                        </span>
                    </div>
                </v-col>
                <v-col cols="12" sm="2">
                    <div class="" @click="showBookmarkList = !showBookmarkList">
                    <div class="mt-7 ml-15" >
                        <v-icon  :color="userBookmarksColor || 'gray'" size="30" :class="{userBookmarksColor : 'text-gray-500'}">mdi-bookmark</v-icon>
                    </div>
                </div>

                        <div v-if="showBookmarkList" @mouseover="showBookmarkList = true" class="mr-32 w-32 shadow-2xl drop-shadow-xl">
                            <div class="p-2 absolute top-0 right-2 z-10 bg-white" >
                                <div class="flex py-2 hover:bg-black cursor-pointer" v-for="bookamrk in bookamrks">
                                    <div class="">
                                        <v-icon size="30" :color="bookamrk.color">{{ bookamrk.icon }}</v-icon>
                                    </div>
                                    <div>
                                        <p class="text-gray-500" @click="bookmark(fib.id,bookamrk.color)">{{ bookamrk.title }}</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <vue-countdown v-if="prepare" :time=" 1 * fib.duration * 1000" v-slot="{ minutes,seconds }" @end="onPrepareEnd(fib.duration)">
                    <div class="text-red-400">Prepare: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>

                <vue-countdown v-if="timer" :time=" 1 * fib.duration * 1000" v-slot="{ minutes,seconds }" @end="onTimeEnd">
                    <div class="text-black">Time: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>
            </v-row>
            <v-row>
                <v-col>
                    <div v-for="file in files" :key="file.id">
                        <audio controls >
                            <!-- <source src="horse.ogg" type="audio/ogg"> -->
                            <source :src="publicPath + file.audio_path" type="audio/mpeg">
                            Your browser does not support the audio element.
                            </audio>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <!-- <p>{{ fib.context }}</p> -->
                    <fillInTheBlank :sentence="fib.context"></fillInTheBlank>
                </v-col>
            </v-row>
            <!-- <v-row v-if="!submited">
                <v-col>
                    <div v-for="answer in answers" :key="answer.id">
                        <v-checkbox

                            :label="answer.answer"
                            :value="answer.answer">
                    </v-checkbox>
                    </div>
                </v-col>
            </v-row> -->
            <v-row>
                <v-col>
                    <v-btn @click="submited = true">Submit</v-btn>
                </v-col>
            </v-row>
            <v-row v-if="submited">
                <v-col>
                    <div v-for="answer in answers" :key="answer.id">
                        <v-checkbox
                            :class="answer.is_correct ? 'text-green-700 py-2' : 'text-red-700'"
                            :label="answer.answer"
                            :model-value="answer.is_correct"
                            :disabled="disableState"
                            >
                    </v-checkbox>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <p class="text-black">AI Scoring and Audio Answer Download is available after submission.</p>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <!-- <v-btn>Submit</v-btn> -->
                </v-col>
                <v-col cols="auto">
                    <div v-if="previousPracticeId !== fib.id">
                        <Link :href="route('practice.l_fib.show' , previousPracticeId ?? fib.id)">
                            <v-btn >
                                Previous
                            </v-btn>
                        </Link>
                    </div>
                </v-col>
                <v-col cols="auto">
                    <div v-if="nextPracticeId !== 0">
                        <Link :href="route('practice.l_fib.show' , nextPracticeId ?? fib.id)">
                        <v-btn color="#29d2bf" class="text-white">
                            Next
                        </v-btn>
                    </Link>
                    </div>
                </v-col>
            </v-row>
            <v-row no-gutters>
                <v-col>
                    <div>
                        <v-btn color="#29d2bf" class="text-white" >
                            Submit
                        </v-btn>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import fillInTheBlank from '../../../Components/fillInTheBlank.vue'
import { reactive,onMounted,ref,computed } from 'vue';
import nextPractice from '../../../Lib/nextPractice';
import previousPractice from '../../../Lib/previosPractice';
import { Link } from '@inertiajs/vue3'
import axios from 'axios';
import Drawer from '../../../Components/Drawer.vue';
import { usePage } from '@inertiajs/vue3'
const page = usePage()
const userBookmarks = computed(() => page.props?.bookmarks)
const userBookmarksColor = computed(() => page.props.bookmarks?.color)

const showBookmarkList = ref(false)
    const bookamrks = reactive([
        {title:"orange", icon:'mdi-bookmark' , color:'orange'},
        {title:"red", icon:'mdi-bookmark' , color:'red'},
        {title:"green", icon:'mdi-bookmark' , color:'green'},
        {title:"purple", icon:'mdi-bookmark' , color:'purple'},
        {title:"unmark", icon:"mdi-bookmark", color:"gray"}
    ])

    function bookmark(id,color){
        axios.post(route('bookmark.add',{'id' : id, 'color':color}))
            .then(function(){
                location.reload();
            })
    }

const Fibs = ref(0)
const links = ref(0)
const prepare = ref(true)
const timer = ref(false)
const drawer = ref(false)
const submited = ref(false)
const disableState = ref(true)
const publicPath = ref('../../../../../')
const image = ref(publicPath.value + 'images/fib_l_v2.png')

const props = defineProps({fib: Object,files:Object})

const practiceArray = reactive([])
    const nextPracticeId = ref(0)
    const previousPracticeId = ref(0)
    const currentPage = ref(props.fib.id)

const sentence = ref(`In today's fast-paced world, our [indiffrence]
to the environment is a pressing concern. The relentless exploitation of natural resources,[esclating]
pollution levels, and the looming threat of climate change have brought us to a critical juncture. The need for [proactive]
action to protect our planet has never been more urgent. One of the key contributors to environmental degradation is the excessive use of single-use plastics. These items, such as plastic bags and bottles, end up in our oceans and harm marine life. Using plastic [alternatives]
and recycling efforts are steps in the right direction, but a more comprehensive approach is required. Individuals, communities, governments, and industries all play a role in shaping the future of our planet. We must
[collectively] reduce our dependence on fossil fuels, promote renewable energy sources, and adopt sustainable practices in agriculture and manufacturing.`)

function getFibsIndex(){
        axios.get(route('practice.l_fib.index')).then(function(res){
            Fibs.value = res.data.message
            drawer.value = true
            links.value = res.data.message.links
            nextPracticeId.value = nextPractice(currentPage, practiceArray, Fibs)
            previousPracticeId.value = previousPractice(currentPage, practiceArray , Fibs)
        })
    }

    function onPrepareEnd(duration)
    {
        console.log(duration)
    }

    function onTimeEnd()
    {
        console.log('ended')
    }
    onMounted(() => {
        getFibsIndex()
    });


</script>
