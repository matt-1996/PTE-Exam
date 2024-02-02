<template>
    <MainLayout>
        <v-container>
        <Drawer :datas="Ssts" :links="links" title="Summarize Spoken Text" routeName="practice.l_sst.show" :image="image" />
        <v-row class="mt-2" justify="center" align="center" offset-md="1">
                <v-col cols="3">
                    <div class="">
                        <img width="200" :src="image" alt="">
                    </div>
                </v-col>
                <v-col cols="9" class="">
                    <h2 class="text-2xl my-2">Summarize Spoken Text
                        <span class="rounded-md text-sm text-white p-1 bg-green-500">
                        <v-icon class="p-1">mdi-school-outline</v-icon>
                        Study Guide
                    </span></h2>
                    <p>You will hear a short report. Write a summary for a fellow student who was not present. You should write 50-70 words. You have 10 minutes to finish this task. Your response will be judged on the quality of your writing and on how well your response presents the key points presented in the lecture.</p>
                </v-col>
                <v-divider inset thickness="1" class="border-opacity-100 border-gray-200"></v-divider>
            </v-row>
            <v-row>
                <v-col cols="12" sm="10">
                    <div class="py-10">
                        <span>
                            {{ sst.title }}
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
                                        <p class="text-gray-500" @click="bookmark(sst.id,bookamrk.color)">{{ bookamrk.title }}</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <vue-countdown v-if="prepare" :time=" 1 * sst.duration * 1000" v-slot="{ minutes,seconds }" @end="onPrepareEnd(sst.duration)">
                    <div class="text-red-400">Prepare: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>

                <vue-countdown v-if="timer" :time=" 1 * sst.duration * 1000" v-slot="{ minutes,seconds }" @end="onTimeEnd">
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
            <v-row >
                <v-col>
                    <div>
                        <v-textarea
                            counter
                            label="Summarize">
                        </v-textarea>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <!-- <v-col>
                    <v-btn @click="submited = true">Submit</v-btn>
                </v-col> -->
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
                    <div v-if="previousPracticeId !== sst.id">
                        <Link :href="route('practice.l_sst.show' , previousPracticeId)">
                            <v-btn >
                                Previous
                            </v-btn>
                        </Link>
                    </div>
                </v-col>
                <v-col cols="auto">
                    <div v-if="nextPracticeId !== 0">
                        <Link :href="route('practice.l_sst.show' , nextPracticeId ?? sst.id)">
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
                        <v-btn @click="submited = true" color="#29d2bf" class="text-white" >
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
import axios from 'axios';
import Drawer from '../../../Components/Drawer.vue';
import nextPractice from '../../../Lib/nextPractice';
import previousPractice from '../../../Lib/previosPractice';
import { Link } from '@inertiajs/vue3'
import { ref,reactive,computed } from 'vue'
import { onMounted } from 'vue';
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

const Ssts = ref(0)
const links = ref(0)
const prepare = ref(true)
const timer = ref(false)
const drawer = ref(false)
const submited = ref(false)
const radios = ref(null)
const disableState = ref(true)
const publicPath = ref('../../../../..')
const image = ref(publicPath.value + '/images/sst_l_ai.png')

const props = defineProps({sst: Object, files: Object})

const practiceArray = reactive([])
    const nextPracticeId = ref(0)
    const previousPracticeId = ref(0)
    const currentPage = ref(props.sst.id)

function getSstsIndex(){
        axios.get(route('practice.l_sst.index')).then(function(res){
            Ssts.value = res.data.message
            drawer.value = true
            links.value = res.data.message.links
            nextPracticeId.value = nextPractice(currentPage, practiceArray, Ssts)
            previousPracticeId.value = previousPractice(currentPage, practiceArray , Ssts)
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
        getSstsIndex()
    });

</script>
