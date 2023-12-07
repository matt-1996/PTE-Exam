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
            <v-navigation-drawer
            class="overflow-y-auto pl-10"
            v-if="drawer"
            :width="1200"
            permanent
            location="right"
      >

      <div style="position: fixed;
                top: 60%;
                right: 98%;
                cursor: pointer;"  @click="drawer = !drawer">

                <div style="background-color: #ff6666;
                    width: 64px;
                    height: 64px;
                    border-radius: 50%;">


                <div style="display: flex;
                    -moz-box-align: center;
                    align-items: center;
                    height: 100%;
                    -moz-box-pack: center;
                    justify-content: center;
                    transition: all 0.3s ease 0s;
                    transform: rotate(90deg) translateY(5px);">
                    <div style="font-size: 16px; color: #fff;">
                        <svg class="text-white" viewBox="0 0 10 6" width="1em" height="1em" ><path d="M1.06 1.177l4 3.909L9.039 1.06" stroke="#999" stroke-width="1.5" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>
                </div>
            </div>
            </div>
        <template v-slot:prepend>
            <div class="my-3 ml-5 py-3 ">
            <v-row   align="center" >
                <v-col cols="auto" offset="0">
                    <!-- <div class=""> -->
                        <img width="70" src="../../../../../public/images/ra_s_ai.png" alt="">
                    <!-- </div> -->
                </v-col>
                <v-col cols="3" offset="0" class="">
                    <h2 class="text-3xl  my-2">Read Aloud</h2>

                    </v-col>
                    <v-col offset="4" class="mr-10">
                        <div class="w-full">
                            <v-text-field
                                class="rounded-3xl"
                                append-inner-icon="magnify"
                                type="text"
                                density="compact"
                                placeholder="Search"
                                prepend-inner-icon="mdi-magnify"
                                variant="outlined"
                                @click:append-inner="visible = !visible">
                             </v-text-field>
                        </div>
                    </v-col>
                    </v-row>

                <v-row class="my-3">
                    <v-col cols="1">
                        <v-btn
                        class=""
                        variant="flat"
                        color="#f5f6f7">
                        <span class="text-[#5fdfd2]">New</span>
                        <v-icon color="#5fdfd2">mdi-swap-vertical</v-icon>
                    </v-btn>
                    </v-col>


                    <v-col cols="1">
                        <button id="dropdownDefaultButton" @click="dropDownToggle = !dropDownToggle" data-dropdown-toggle="dropdown" class="text-cyan-300 text-sm bg-[#f5f6f7] font-medium rounded-lg px-5 py-2.5 text-center inline-flex items-center" type="button">
                            <span class="text-gray-400">Mark</span>
                            <svg class="w-2.5 h-2.5 ms-3 text-gray-400" fill="#fff" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div v-if="dropDownToggle" id="dropdown" class="z-10  bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                            <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#" class="block px-4 py-2 text-gray-400 hover:bg-[#29d2bf]/10">All Marked</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-gray-400 hover:bg-[#29d2bf]/10">Orange</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-gray-400 hover:bg-[#29d2bf]/10">Red</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-gray-400 hover:bg-[#29d2bf]/10">Green</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-gray-400 hover:bg-[#29d2bf]/10">Purple</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-gray-400 hover:bg-[#29d2bf]/10">Not Marked</a>
                            </li>
                            </ul>
                        </div>

                    </v-col>

                    <v-col cols="3">
                        <button id="dropdownDefaultButton" @click="dropDownPracticeToggle = !dropDownPracticeToggle" data-dropdown-toggle="dropdown" class="text-cyan-300 text-sm bg-[#f5f6f7] font-medium rounded-lg px-5 py-2.5 text-center inline-flex items-center" type="button">
                            <span class="text-gray-400">Prac Status</span>
                            <svg class="w-2.5 h-2.5 ms-3 text-gray-400" fill="#fff" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div v-if="dropDownPracticeToggle" id="dropdown" class="z-10  bg-white divide-y divide-gray-100 rounded-lg shadow w-44 ">
                            <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#" class="block px-4 py-2 text-gray-400 hover:bg-[#29d2bf]/10">Practiced</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-gray-400 hover:bg-[#29d2bf]/10">Unpracticed</a>
                            </li>
                            </ul>
                        </div>

                    </v-col>

                </v-row>

                <v-row class="" align="center">
                    <v-col cols="4">
                        <span class="text-gray-400">Done 0 , Found 2832 Questions</span>
                    </v-col>
                    <v-col cols="8" offset="10" class="-mt-11">
                        <div class="text-red-400 text-md inline-block">
                            <span class="text-red-400 text-md inline-block">
                                    <svg viewBox="0 0 25 24" width="1em" height="1em" fill="currentColor"><g fill-rule="nonzero" fill="none"><path d="M24.5 0v24H.5V0h24zm-1 1h-22v22h22V1z" fill="none"></path><path d="M18.923 10.749h-5.356v-7.5h-2.144v7.5H6.067v10.006h12.856V10.749zM14.644 9.5h4.288c.29-.001.567.13.75.355.206.25.319.565.317.89v10.01A1.167 1.167 0 0118.932 22H6.067a.96.96 0 01-.747-.351 1.384 1.384 0 01-.32-.883V10.76a1.177 1.177 0 011.067-1.256h4.288V3.245A1.167 1.167 0 0111.423 2h2.144c.29-.001.567.13.75.355.206.25.319.565.317.89l.01 6.259V9.5zM8.75 18.249c.146 0 .285.065.377.178a.7.7 0 01.161.445v1.879H8.211v-1.875a.59.59 0 01.538-.623l.001-.004zm3.75-.623c.146 0 .285.065.377.178a.7.7 0 01.162.445v2.5h-1.077v-2.5a.583.583 0 01.538-.618v-.005zm3.75.623c.146 0 .285.065.377.178a.7.7 0 01.161.445v1.879h-1.067v-1.875a.69.69 0 01.156-.445.477.477 0 01.374-.178l-.001-.004zM6.067 14.503h12.856v1.245H6.067v-1.245z" fill="#F66"></path></g></svg>
                            </span>
                            Reset Prac Status
                            <span>
                            </span>
                        </div>
                    </v-col>
                </v-row>

                <v-row align="center">
                    <v-col cols="12">
                        <ul v-for="ReadAloud in ReadAlouds" :key="ReadAloud.id" class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <a :href="route('prctice.readAloud', ReadAloud.id)">
                            <li class="py-5 sm:pb-4" >
                                <div class="flex text-gray-700 items-center space-x-4 rtl:space-x-reverse">
                                    {{ReadAloud.title}}
                                    <div class="flex-1 min-w-0 ">
                                        <span class="rounded-md py-1 px-3 mx-8 text-white text-xs bg-[#cccccc]">
                                            {{ReadAloud.code}}
                                        </span>

                                    </div>
                                    <div class="flex-shrink items-center text-base font-semibold text-gray-900">
                                        <span class="rounded-md py-1 px-3 mx-8 text-white text-sm bg-[#cccccc]">
                                            Undone
                                        </span>
                                    </div>
                                </div>
                            </li>
                        </a>
                            <v-divider thickness="1" color="#cccccc" class="border-opacity-25 border-gray-100"></v-divider>
                        </ul>
                    </v-col>
                </v-row>
                <v-row align="center" justify="center">
                    <v-col v-for="link in links" :key="link" cols="auto">
                        <div class="flex cursor-pointer" >

                            <!-- <div > -->
                                <a @click="getPaginateData(link.url)" v-html="link.label" :class="{ 'border-2 border-cyan-300' : link.active == true , 'border border-gray-700' : link.active == false}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500  rounded-lg hover:bg-gray-100 hover:text-gray-700 ">
                                </a>
                            <!-- </div> -->
                        </div>
                    </v-col>
                </v-row>
    </div>
          <!-- <v-list-item
            lines="two"
            prepend-avatar="https://randomuser.me/api/portraits/women/81.jpg"
            title="Jane Smith"
            subtitle="Logged in"
          ></v-list-item> -->
        </template>

        <v-divider></v-divider>

        <!-- <v-list density="compact" nav>
          <v-list-item prepend-icon="mdi-home-city" title="Home" value="home"></v-list-item>
          <v-list-item prepend-icon="mdi-account" title="My Account" value="account"></v-list-item>
          <v-list-item prepend-icon="mdi-account-group-outline" title="Users" value="users"></v-list-item>
        </v-list> -->
      </v-navigation-drawer>
            <div style="position: absolute;
                top: calc(50% - 32px);
                right: -32px;
                cursor: pointer;"  @click="drawer = !drawer">

                <div style="background-color: rgb(255, 102, 102);
                    width: 64px;
                    height: 64px;
                    border-radius: 50%;">


                <div style="display: flex;
                    -moz-box-align: center;
                    align-items: center;
                    height: 100%;
                    -moz-box-pack: center;
                    justify-content: center;
                    transition: all 0.3s ease 0s;
                    transform: rotate(90deg) translateY(12px);">
                    <div style="font-size: 16px; color: rgb(255, 255, 255);">
                        <svg class="text-white" viewBox="0 0 10 6" width="1em" height="1em" ><path d="M1.06 1.177l4 3.909L9.039 1.06" stroke="#999" stroke-width="1.5" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>
                </div>
            </div>
            </div>
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
            <v-row>
                <v-col>
                    <div class="py-10">
                        <span>
                            {{ reading.title }}
                        </span>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <vue-countdown v-if="prepare" :time=" reading.duration * 1000" v-slot="{ minutes,seconds }" @end="onPrepareEnd(reading.duration)">
                    <div class="text-red-400">Prepare: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>

                <vue-countdown v-if="timer" :time=" reading.duration * 1000" v-slot="{ minutes,seconds }" @end="onTimeEnd">
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
                        <div class="bg-blue-600 h-2.5 rounded-full" :style="{width:   progressWidth / reading.duration * 100  + '%' }"></div>
                    </div>
                    <div class="bg-gray-200 opacity-75 p-4">
                        <div class="text-center">
                            Click to Start
                        </div>
                        <div class="text-center mt-2">
                            <v-icon @click="voiceRecorder.record(reading.duration)" class="bg-gray-400 rounded-full p-6">mdi-microphone</v-icon>
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
                    <v-btn>Submit</v-btn>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import axios from 'axios';
import voiceRecorder from '../../../Lib/recorder'
// import {InertiaLink} from "@inertiajs/inertia-vue3";
import { ref } from 'vue'
import { onMounted } from 'vue';


    const prepare = ref(true)
    const timer = ref(false)
    const drawer = ref(false)
    const dropDownPracticeToggle = ref(false)
    const dropDownToggle = ref(false)
    const ReadAlouds = ref(0);
    const links = ref(0)
    const progressWidth = ref(1)
    const AudioUrl = ref()
    const showAudioPlayer = ref(false)
    const snackbar = ref(false)
    defineProps({ reading: Object })

    function onPrepareEnd(seconds)
    {
        console.log("Counter Ended " + seconds)
        prepare.value = false
        timer.value = true
        var audio = new Audio('../../../../../sounds/beep.wav');
        audio.play();
        voiceRecorder.record(seconds,progressWidth,snackbar,AudioUrl,showAudioPlayer)


    }

    // function record(timeToRecord)
    // {
    // const TimetoRecordinMiliSecond = timeToRecord * 1000
    // const TimetoPlayinMiliSecond = TimetoRecordinMiliSecond + 1000
    //   let audioRecorder;
    //   let audioChunks = [];
    //   navigator.mediaDevices.getUserMedia({ audio: true })
    //      .then(stream => {

    //         // Initialize the media recorder object
    //         audioRecorder = new MediaRecorder(stream);

    //         setInterval(function(){
    //             if(!(progressWidth.value >= timeToRecord))
    //             {
    //                 // if(progressWidth !>= )
    //                 progressWidth.value += 1
    //             }else{
    //             }
    //         },1000)

    //         // dataavailable event is fired when the recording is stopped
    //         audioRecorder.addEventListener('dataavailable', e => {
    //            audioChunks.push(e.data);
    //         });

    //         audioChunks = [];
    //            audioRecorder.start();
    //            console.log('Recording started! Speak now.');

    //         setTimeout(() => {
    //             audioRecorder.stop();
    //             var audio = new Audio('../../../../../sounds/beep.wav');
    //             audio.play();
    //             snackbar.value = true
    //            console.log('Recording stopped! Click on the play button to play the recorded audio.')
    //         }, TimetoRecordinMiliSecond );

    //         setTimeout(() => {
    //             const blobObj = new Blob(audioChunks, { type: 'audio/webm' });
    //            const audioUrl = URL.createObjectURL(blobObj);
    //            const audio = new Audio(audioUrl);
    //         //    audio.play();
    //            console.log('Playing the recorded audio!');
    //            console.log(audioUrl)
    //            AudioUrl.value = audioUrl
    //            showAudioPlayer.value = true
    //         }, TimetoPlayinMiliSecond);


    //         playButton.addEventListener('click', () => {
    //            const blobObj = new Blob(audioChunks, { type: 'audio/webm' });
    //            const audioUrl = URL.createObjectURL(blobObj);
    //            const audio = new Audio(audioUrl);
    //            audio.play();
    //            output.innerHTML = 'Playing the recorded audio!';
    //         });
    //      }).catch(err => {

    //         // If the user denies permission to record audio, then display an error.
    //         console.log('Error: ' + err);
    //      });
    // }

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

    // function recordAudio() {
    //   var device = navigator.mediaDevices.getUserMedia({ audio: true });
    //   device.then((stream) => {
    //     // use this!
    //     this.recorder = new MediaRecorder(stream);
    //     mediaRecorder.start();
    //     const audioChunks = [];
    //     this.recorder.ondataavailable = (e) => {
    //         audioChunks.push(e.data);
    //     };

    //     mediaRecorder.addEventListener("stop", () => {
    //         const audioBlob = new Blob(audioChunks);
    //         const audioUrl = URL.createObjectURL(audioBlob);
    //         const audio = new Audio(audioUrl);
    //         audio.play();
    // });

    //     setTimeout(() => {
    //     mediaRecorder.stop();
    //     }, 10000);
    //   });
    // }
    function getReadAloudIndex(){
        axios.get(route('practice.readAloud.Index')).then(function(res){
            ReadAlouds.value = res.data.message.data
            drawer.value = true
            links.value = res.data.message.links
            console.log(links)
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
