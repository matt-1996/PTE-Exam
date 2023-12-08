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
                    <div v-if="prepare" class="bg-gray-200 opacity-75 p-4">
                        <div class="text-center">
                            Click to Start
                        </div>
                        <div class="text-center mt-2">
                            <v-icon @click="voiceRecorder.record(reading.duration)" class="bg-gray-400 rounded-full p-6">mdi-microphone</v-icon>
                        </div>
                    </div>
                    <div v-if="timer" id="stopButton" class="bg-gray-200 opacity-75 p-4">
                        <div class="text-center">
                            Click to End
                        </div>
                        <div class="text-center mt-2">
                            <v-icon color="red" class="bg-gray-400 rounded-full p-6">mdi-microphone</v-icon>
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
import Drawer from '../../../Components/Drawer.vue'
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
    const publicPath = ref('../../../../../')
    const image = ref(publicPath.value + '/images/ra_s_ai.png')
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
