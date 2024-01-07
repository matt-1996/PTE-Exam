<template>
    <MainLayout title="questions">
        <v-container>

            <Drawer title="Describe Image" :datas="DescribeImages" :links="links" :image="image" routeName="practice.DescribeImage.show"/>
            <v-row class="mt-2" justify="center" align="center" offset-md="1">
                <v-col cols="3">
                    <div class="">
                        <img width="200" :src="publicPath + 'images/di_s_ai.png'" alt="">
                    </div>
                </v-col>
                <v-col cols="9" class="">
                    <h2 class="text-2xl my-2">Describe Image
                        <span class="rounded-md text-sm text-white p-1 bg-green-500">
                        <v-icon class="p-1">mdi-school-outline</v-icon>
                        Study Guide
                    </span></h2>
                    <p>Look at the graph below. In 25 seconds, please speak into the microphone and describe in detail what the graph is showing. You will have 40 seconds to give your response.</p>
                </v-col>
                <v-divider inset thickness="1" class="border-opacity-100 border-gray-200"></v-divider>
            </v-row>
            <v-row>
                <v-col>
                    <div class="py-10">
                        <span>
                            {{ DescribeImage.title }}
                        </span>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <vue-countdown v-if="prepare" :time=" 1 * DescribeImage.duration * 1000" v-slot="{ minutes,seconds }" @end="onPrepareEnd(practiceDuration)">
                    <div class="text-red-400">Prepare: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>

                <vue-countdown v-if="timer" :time=" 1 * practiceDuration * 1000" v-slot="{ minutes,seconds }" @end="onTimeEnd">
                    <div class="text-black">Time: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>
            </v-row>
            <v-row>
                <v-col cols="auto">
                    <div v-for="file in files" :key="file.id">
                        <img width="700" :src="publicPath + file.image_path" alt="">
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <v-col>
                        <audio v-if="showAudioPlayer" :src="AudioUrl" controls></audio>
                    </v-col>
                </v-col>
            </v-row>
            <v-row justify="center" align="center">
                <v-col>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full" :style="{width:   progressWidth / practiceDuration * 100  + '%' }"></div>
                    </div>
                    <div v-if="prepare" class="bg-gray-200 opacity-75 p-4 cursor-pointer"  @click="DescribeImage.duration = 0; practiceDuration = 20">
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
        </v-container>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import axios from 'axios';
import Drawer from '../../../Components/Drawer.vue'
import voiceRecorder from '../../../Lib/recorder'
import { ref } from 'vue'
import { onMounted } from 'vue';


    const prepare = ref(true)
    const timer = ref(false)
    const drawer = ref(false)
    const dropDownPracticeToggle = ref(false)
    const dropDownToggle = ref(false)
    const DescribeImages = ref(0);
    const links = ref(0)
    const progressWidth = ref(1)
    const AudioUrl = ref()
    const showAudioPlayer = ref(false)
    const snackbar = ref(false)
    const publicPath = ref('../../../../../')
    const image = ref(publicPath.value + '/images/di_s_ai.png')
    const props = defineProps({ DescribeImage : Object , files: Object})

    const practiceDuration = ref(props.DescribeImage.duration)


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
            DescribeImages.value = res.data.message.data
            drawer.value = true
            links.value = res.data.message.links
            console.log(links)
        })
    }


    function getDescribeImageIndex(){
        axios.get(route('practice.DescribeImage.index')).then(function(res){
            DescribeImages.value = res.data.message.data
            drawer.value = true
            links.value = res.data.message.links
            console.log(DescribeImages)
        })
    }
    onMounted(() => {
        getDescribeImageIndex()
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
