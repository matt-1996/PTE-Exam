<template>
    <MainLayout title="questions">
        <v-container>
            <Drawer :datas="summarizeWrittenText" :links="links" title="Summarize Written Text" routeName="practice.summarizeWrittenText.show" :image="image" />

            <v-row class="mt-2" justify="center" align="center" offset-md="1">
                <v-col cols="3">
                    <div class="">
                        <img width="200" :src="publicPath + 'images/swt_w_ai.png'" alt="">
                    </div>
                </v-col>
                <v-col cols="9" class="">
                    <h2 class="text-2xl my-2">Summarize Written Text
                        <span class="rounded-md text-sm text-white p-1 bg-green-500">
                        <v-icon class="p-1">mdi-school-outline</v-icon>
                        Study Guide
                    </span></h2>
                    <p>Read the passage below and summarize it using one sentence. Type your response in the box at the bottom of the screen. You have 10 minutes to finish this task. Your response will be judged on the quality of your writing and on how well your response presents the key points in the passage.</p>
                </v-col>
                <v-divider inset thickness="1" class="border-opacity-100 border-gray-200"></v-divider>
            </v-row>
            <v-row>
                <v-col>
                    <div class="py-10">
                        <span>
                            {{ summarizeWrittenText.title }}
                        </span>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <vue-countdown v-if="prepare" :time=" 1 * summarizeWrittenText.duration * 1000" v-slot="{ minutes,seconds }" @end="onPrepareEnd">
                    <div class="text-red-400">Prepare: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>

                <vue-countdown v-if="timer" :time=" 1 * summarizeWrittenText.duration * 1000" v-slot="{ minutes,seconds }" @end="onTimeEnd">
                    <div class="text-black">Time: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>
            </v-row>
            <v-row>
                <v-col>
                    <div>
                        <p class="text-gray-700">{{ summarizeWrittenText.context }}</p>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <!-- <div class="border border-dashed border-spacing-2 p-5">
                        {{ reading.context }}
                    </div> -->

                    <div>
                        <v-textarea
                            counter
                            label="Summarize">
                        </v-textarea>
                    </div>
                </v-col>
            </v-row>
            <v-row justify="center" align="center">
                <v-col>
                    <!-- <div class="bg-gray-200 opacity-75 p-4">
                        <div class="text-center">
                            Click to Start
                        </div>
                        <div class="text-center mt-2">
                            <v-icon id="start" @click="startRecording()" class="bg-gray-400 rounded-full p-6">mdi-microphone</v-icon>
                            <v-icon id="stop" class="bg-gray-400 rounded-full p-6">mdi-microphone</v-icon>
                            <v-icon id="play" class="bg-gray-400 rounded-full p-6">mdi-microphone</v-icon>
                        </div>
                    </div> -->
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import axios from 'axios';
import Drawer from '../../../Components/Drawer.vue';
import { ref } from 'vue'
import { onMounted } from 'vue';


    const prepare = ref(true)
    const timer = ref(false)
    const drawer = ref(false)
    const dropDownPracticeToggle = ref(false)
    const dropDownToggle = ref(false)
    const summarizeWrittenTexts = ref(0);
    const links = ref(0)
    const publicPath = ref('../../../../../../')
    const image = ref(publicPath.value + '/images/swt_w_ai.png')
    defineProps({ summarizeWrittenText : Object })

    function onPrepareEnd()
    {
        console.log("Counter Ended")
        prepare.value = false
        timer.value = true

    }

    function getPaginateData(url)
    {
        // console.log(url)
        axios.get(url).then(function(res){
            summarizeWrittenTexts.value = res.data.message.data
            drawer.value = true
            links.value = res.data.message.links
            console.log(links)
        })
    }



    function getSummarizeWrittenTextIndex(){
        axios.get(route('practice.summarizeWrittenText.index')).then(function(res){
            summarizeWrittenTexts.value = res.data.message.data
            drawer.value = true
            links.value = res.data.message.links
            console.log(summarizeWrittenTexts)
        })
    }
    onMounted(() => {
        getSummarizeWrittenTextIndex()
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
