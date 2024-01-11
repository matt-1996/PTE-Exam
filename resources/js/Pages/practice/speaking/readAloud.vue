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
        <v-container class="z-50">

            <Drawer :datas="ReadAlouds" :links="links" :image="image" title="Read Aloud" routeName='prctice.readAloud' />
            <v-row class="mt-2" justify="center" align="center" offset-md="1">
                <v-col cols="3">
                    <div class="">
                        <img width="200" src="../../../../../public/images/ra_s_ai.png" alt="">
                    </div>
                </v-col>
                <v-col cols="9" class="">
                    <h2 class="text-2xl my-2">Read Aloud
                        <span class="rounded-md text-sm text-white p-1 bg-green-500">
                        <v-icon class="p-1">mdi-school-outline</v-icon>
                        Study Guide
                    </span></h2>
                    <p>Look at the text below. In 40 seconds, you must read this text aloud as naturally and clearly as possible. You have 40 seconds to read aloud.</p>
                </v-col>
                <v-divider inset thickness="1" class="border-opacity-100 border-gray-200"></v-divider>
            </v-row>
            <v-row cols="12" sm="10">
                <v-col cols="9">
                    <div class="py-10">
                        <span>
                            {{ reading.title }}
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
                                        <p class="text-gray-500" @click="bookmark(reading.id,bookamrk.color)">{{ bookamrk.title }}</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </v-col>
            </v-row>
            <v-row class="">
                <vue-countdown v-if="prepare" :time=" reading.duration * 1000" v-slot="{ minutes,seconds }" @end="onPrepareEnd(practiceDuration)">
                    <div class="text-red-400">Prepare: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>

                <vue-countdown v-if="timer" :time=" practiceDuration * 1000" v-slot="{ minutes,seconds }" @end="onTimeEnd">
                    <div class="text-black">Time: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>
            </v-row>
            <v-row>
                <v-col>
                    <div class="border border-dashed border-spacing-2 p-5">
                        {{ reading.context }}
                    </div>
                </v-col>
            </v-row>
            <v-row justify="center" align="center">
                <v-col>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full" :style="{width:   progressWidth / practiceDuration * 100  + '%' }"></div>
                    </div>
                    <div v-if="prepare" class="bg-gray-200 opacity-75 p-4 cursor-pointer"  @click="reading.duration = 0; practiceDuration = 20">
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

                   <audio v-if="showAudioPlayer" :src="AudioUrl" controls></audio>
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
            </v-row>
        </v-container>
    </MainLayout>
</template>
<style scoped>
.v-icon.outlined {
                  border: 1px solid currentColor;
                  border-radius:50%;
                  height: 56px;
                  width: 56px;
}
</style>
<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import axios from 'axios';
import Drawer from '../../../Components/Drawer.vue'
import voiceRecorder from '../../../Lib/recorder'
// import {InertiaLink} from "@inertiajs/inertia-vue3";
import { ref,reactive,watch,computed } from 'vue'
import { onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3'
const page = usePage()
const userBookmarks = computed(() => page.props?.bookmarks)
const userBookmarksColor = computed(() => page.props.bookmarks?.color)
// import { reactive } from 'node_modules_old/@vue/reactivity/dist/reactivity';


    const prepare = ref(true)
    const timer = ref(false)
    const drawer = ref(false)
    const dropDownPracticeToggle = ref(false)
    const dropDownToggle = ref(false)
    const ReadAlouds = ref(0);
    const links = ref(0)
    const selectedBookmark = ref()
    // const audioRecorder = ref()
    const progressWidth = ref(1)


    const AudioUrl = ref()
    const showAudioPlayer = ref(false)
    const snackbar = ref(false)
    // const audioChunks = reactive([])
    const publicPath = ref('../../../../../')
    const showBookmarkList = ref(false)
    const bookamrks = reactive([
        {title:"orange", icon:'mdi-bookmark' , color:'orange'},
        {title:"red", icon:'mdi-bookmark' , color:'red'},
        {title:"green", icon:'mdi-bookmark' , color:'green'},
        {title:"purple", icon:'mdi-bookmark' , color:'purple'},
        {title:"unmark", icon:"mdi-bookmark", color:"gray"}
    ])
    const image = ref(publicPath.value + '/images/ra_s_ai.png')
    // const stopButtone = ref(stopButton)
    const props = defineProps({ reading: Object })

    const practiceDuration = ref(props.reading.duration)

    function getSelected(title)
    {
        console.log(title)
    }

    function bookmark(id,color){
        axios.post(route('bookmark.add',{'id' : id, 'color':color}))
            .then(function(){
                location.reload();
            })
    }

   function recorder(timeToRecord,progressWidth,snackbar,AudioUrl,showAudioPlayer){
     const stopButton = document.getElementById('stop')
        console.log(document.getElementById("stop"))
        const TimetoRecordinMiliSecond = timeToRecord * 1000
        const TimetoPlayinMiliSecond = TimetoRecordinMiliSecond + 1000

      navigator.mediaDevices.getUserMedia({ audio: true })
         .then(stream => {
            // Initialize the media recorder object
            let audioRecorder;
            let audioChunks = [];

            audioRecorder = new MediaRecorder(stream);

            setInterval(function(){
                if(!(progressWidth.value >= timeToRecord))
                {
                    // if(progressWidth !>= )
                    progressWidth.value += 1
                }else{
                }
            },1000)

            // dataavailable event is fired when the recording is stopped
            audioRecorder.addEventListener('dataavailable', e => {
               audioChunks.push(e.data);
            });

            audioChunks = [];
               audioRecorder.start();
               console.log('Recording started! Speak now.');

            setTimeout(() => {
                audioRecorder.stop();
                var audio = new Audio('../../../../../sounds/beep.wav');
                audio.play();
                snackbar.value = true
               console.log('Recording stopped! Click on the play button to play the recorded audio.')
            }, TimetoRecordinMiliSecond );

            setTimeout(() => {
                const blobObj = new Blob(audioChunks, { type: 'audio/webm' });
               const audioUr = URL.createObjectURL(blobObj);
               const audio = new Audio(audioUr);
            //    audio.play();
               console.log('Playing the recorded audio!');
               console.log(audioUr)
               AudioUrl.value = audioUr
               showAudioPlayer.value = true
            }, TimetoPlayinMiliSecond);

            //stop recording when the stop button is clicked
            stopButton.addEventListener('click', () => {
               audioRecorder.stop();
               var audio = new Audio('../../../../../sounds/beep.wav');
               audio.play();
               snackbar.value = true
              console.log('Recording stopped! Click on the play button to play the recorded audio.')

              setTimeout(() => {
               const blobObj = new Blob(audioChunks, { type: 'audio/webm' });
              const audioUr = URL.createObjectURL(blobObj);
              const audio = new Audio(audioUr);
           //    audio.play();
              console.log('Playing the recorded audio!');
              console.log(audioUr)
              AudioUrl.value = audioUr
              showAudioPlayer.value = true
           }, 1000);
            });


            // play the recorded audio when the play button is clicked
            playButton.addEventListener('click', () => {
               const blobObj = new Blob(audioChunks, { type: 'audio/webm' });
               audioUrl.value = URL.createObjectURL(blobObj);
               const audio = new Audio(audioUrl);
               audio.play();
               output.innerHTML = 'Playing the recorded audio!';
            });
         }).catch(err => {

            // If the user denies permission to record audio, then display an error.
            console.log('Error: ' + err);
         });
    }

    function recordAudio()
    {

    }
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
            ReadAlouds.value = res.data.message.data
            drawer.value = true
            links.value = res.data.message.links
            console.log(links)
        })
    }


    function getReadAloudIndex(){
        axios.get(route('practice.readAloud.Index')).then(function(res){
            ReadAlouds.value = res.data.message.data
            drawer.value = true
            links.value = res.data.message.links
            console.log(ReadAlouds)
        })
    }
    onMounted(() => {
        getReadAloudIndex()
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
