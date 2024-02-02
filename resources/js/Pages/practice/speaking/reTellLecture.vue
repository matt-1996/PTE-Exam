<template>
    <MainLayout title="questions">
        <v-snackbar
      v-model="snackbar"
    >
      Times up
      <template v-slot:actions>
        <v-btn
          color="pink"
          variant="text"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
        <v-container>

            <Drawer :datas="retellLectures" :links="links" title="Re-tell Lecture" :image="image" routeName="practice.retellLecture.show" />

            <v-row class="mt-2" justify="center" align="center" offset-md="1">
                <v-col cols="3">
                    <div class="">
                        <img width="200" :src="publicPath + 'images/rl_s_ai.png'" alt="">
                    </div>
                </v-col>
                <v-col cols="9" class="">
                    <h2 class="text-2xl my-2">Re-tell Lecture
                        <span class="rounded-md text-sm text-white p-1 bg-green-500">
                        <v-icon class="p-1">mdi-school-outline</v-icon>
                        Study Guide
                    </span></h2>
                    <p>You will hear a lecture. After listening to the lecture, in 10 seconds, please speak into the microphone and retell what you have just heard from the lecture in your own words. You will have 40 seconds to give your response.</p>
                </v-col>
                <v-divider inset thickness="1" class="border-opacity-100 border-gray-200"></v-divider>
            </v-row>
            <v-row>
                <v-col cols="12" sm="10">
                    <div class="py-10">
                        <span>
                            {{ retellLecture.title }}
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
                                        <p class="text-gray-500" @click="bookmark(retellLecture.id,bookamrk.color)">{{ bookamrk.title }}</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <vue-countdown v-if="prepare" :time=" 1 * retellLecture.duration * 1000" v-slot="{ minutes,seconds }" @end="onPrepareEnd(practiceDuration)">
                    <div class="text-red-400">Prepare: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>

                <vue-countdown v-if="timer" :time=" 1 * practiceDuration * 1000" v-slot="{ minutes,seconds }" @end="onTimeEnd">
                    <div class="text-black">Time: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>
            </v-row>
            <v-row>
                <v-col cols="5">
                    <audio-player
                        ref="audioPlayer"
                        :audio-list="audioList.map(elm => elm.url)"
                        :before-play="handleBeforePlay"
                        theme-color="#ff2929"
                        />
                    <!-- <div v-for="file in files" :key="file.id">
                        <audio controls >
                            <source :src="publicPath + file.audio_path" type="audio/mpeg">
                            Your browser does not support the audio element.
                            </audio>
                        </div> -->
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <audio v-if="showAudioPlayer" :src="AudioUrl" controls></audio>
                </v-col>
            </v-row>
            <v-row justify="center" align="center">
                <v-col>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full" :style="{width:   progressWidth / practiceDuration * 100  + '%' }"></div>
                    </div>
                    <div v-if="prepare" class="bg-gray-200 opacity-75 p-4 cursor-pointer"  @click="retellLecture.duration = 0; practiceDuration = 20">
                        <div class="text-center">
                            Click to Start
                        </div>
                        <div class="text-center mt-2">
                            <v-icon class="bg-gray-400 rounded-full p-6">mdi-microphone</v-icon>
                        </div>
                    </div>
                    <div v-show="timer && practiceDuration != 0" id="stop" class="bg-gray-200 opacity-75 p-4 cursor-pointer" @click="practiceDuration = 0">
                        <div class="text-center">
                            Click to End
                        </div>
                        <div class="text-center mt-2">
                            <v-icon color="red" class="bg-gray-400 rounded-full p-6">mdi-microphone</v-icon>
                        </div>
                    </div>
                    <div v-if="practiceDuration == 0" class="bg-gray-200 opacity-75 p-4 cursor-pointer">
                        <div class="text-center">
                            Done
                        </div>
                        <div class="text-center mt-2">
                            <v-icon class="bg-gray-400 rounded-full p-6">mdi-microphone</v-icon>
                        </div>
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
                    <div v-if="previousPracticeId !== retellLecture.id">
                        <Link :href="route('practice.retellLecture.show' , previousPracticeId)">
                            <v-btn >
                                Previous
                            </v-btn>
                        </Link>
                    </div>
                </v-col>
                <v-col cols="auto">
                    <div v-if="nextPracticeId !== 0">
                        <Link :href="route('practice.retellLecture.show' , nextPracticeId)">
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
import axios from 'axios';
import { Link } from '@inertiajs/vue3'
import nextPractice from '../../../Lib/nextPractice';
import previousPractice from '../../../Lib/previosPractice';
import Drawer from '../../../Components/Drawer.vue'
import voiceRecorder from '../../../Lib/recorder'
import { ref,reactive,computed } from 'vue'
import { onMounted } from 'vue';
import AudioPlayer from '@liripeng/vue-audio-player'
import { usePage } from '@inertiajs/vue3'
const page = usePage()
const userBookmarks = computed(() => page.props?.bookmarks)
const userBookmarksColor = computed(() => page.props.bookmarks?.color)
const props = defineProps({ retellLecture : Object , files: Object})

const practiceArray = reactive([])
    const nextPracticeId = ref(0)
    const previousPracticeId = ref(0)
    const currentPage = ref(props.retellLecture.id)

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


    const prepare = ref(true)
    const timer = ref(false)
    const drawer = ref(false)
    const dropDownPracticeToggle = ref(false)
    const dropDownToggle = ref(false)
    const retellLectures = ref(0);
    const AudioUrl = ref()
    const showAudioPlayer = ref(false)
    const links = ref(0)
    const publicPath = ref('../../../../../')
    const progressWidth = ref(1)
    const snackbar = ref(false)
    const image = ref(publicPath.value + '/images/rl_s_ai.png')

    const audioList = ref([
        {
          name: 'audio1',
          url:  props.files[0].audio_path
        }
      ])

    

    const practiceDuration = ref(props.retellLecture.duration)

    function onPrepareEnd(seconds)
    {
        console.log("Counter Ended " + seconds)
        prepare.value = false
        timer.value = true
        var audio = new Audio('../../../../../sounds/beep.wav');
        audio.play();
        voiceRecorder.record(seconds,progressWidth,snackbar,AudioUrl,showAudioPlayer,practiceDuration)

    }

    function getPaginateData(url)
    {
        // console.log(url)
        axios.get(url).then(function(res){
            retellLectures.value = res.data.message.data
            drawer.value = true
            links.value = res.data.message.links
            console.log(links)
        })
    }


    function getretellLectureIndex(){
        axios.get(route('practice.retellLecture.index')).then(function(res){
            retellLectures.value = res.data.message.data
            drawer.value = true
            links.value = res.data.message.links
            nextPracticeId.value = nextPractice(currentPage, practiceArray, retellLectures)
            previousPracticeId.value = previousPractice(currentPage, practiceArray , retellLectures)
        })
    }
    onMounted(() => {
        getretellLectureIndex()
    });

</script>
<style>
.bbuErs .wrapper {
	display: flex;
	-moz-box-align: center;
	align-items: center;
	height: 100%;
	-moz-box-pack: center;
	justify-content: center;
	transition: all 0.3s ease 0s;
	transform: rotate(90deg) translateY(12px);
}
</style>
