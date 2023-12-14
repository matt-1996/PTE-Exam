<template>
    <MainLayout>
        <v-container>
        <Drawer :datas="Mcses" :links="links" title="Multiple Choice (Multiple)" routeName="practice.l_mcs.show" :image="image" />
        <v-row class="mt-2" justify="center" align="center" offset-md="1">
                <v-col cols="3">
                    <div class="">
                        <img width="200" :src="image" alt="">
                    </div>
                </v-col>
                <v-col cols="9" class="">
                    <h2 class="text-2xl my-2">Multiple Choice (Single)
                        <span class="rounded-md text-sm text-white p-1 bg-green-500">
                        <v-icon class="p-1">mdi-school-outline</v-icon>
                        Study Guide
                    </span></h2>
                    <p>Listen to the recording and answer the single-choice question by selectingthe correct response . Only one response is correct.</p>
                </v-col>
                <v-divider inset thickness="1" class="border-opacity-100 border-gray-200"></v-divider>
            </v-row>
            <v-row>
                <v-col>
                    <div class="py-10">
                        <span>
                            {{ mcs.title }}
                        </span>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <vue-countdown v-if="prepare" :time=" 1 * mcs.duration * 1000" v-slot="{ minutes,seconds }" @end="onPrepareEnd(mcs.duration)">
                    <div class="text-red-400">Prepare: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>

                <vue-countdown v-if="timer" :time=" 1 * mcs.duration * 1000" v-slot="{ minutes,seconds }" @end="onTimeEnd">
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
            <v-row v-if="!submited">
                <v-col>
                    <div v-for="answer in answers" :key="answer.id">
                    <v-radio-group v-model="radios">
                            <v-radio
                            :value="answer.id"
                            :label="answer.answer"
                            >
                    </v-radio>
                </v-radio-group>
            </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <v-btn @click="submited = true">Submit</v-btn>
                </v-col>
            </v-row>
            <v-row v-if="submited">
                <v-col>
                    <v-radio-group >
                        <div v-for="answer in answers" :key="answer.id">
                            <v-radio
                            :class="answer.is_correct ? 'text-green-700 py-2' : 'text-red-700'"
                            :label="answer.answer"
                            :model-value="answer.is_correct"
                            :v-model="answer.is_correct"
                            :disabled="disableState"
                            readonly
                            >
                    </v-radio>
                </div>
                        </v-radio-group>
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

const Mcses = ref(0)
const links = ref(0)
const prepare = ref(true)
const timer = ref(false)
const drawer = ref(false)
const submited = ref(false)
const radios = ref(null)
const disableState = ref(true)
const publicPath = ref('../../../../../')
const image = ref(publicPath.value + '/images/mcs_l_v2.png')

defineProps({mcs: Object, files: Object, answers: Object})

function getMcsesIndex(){
        axios.get(route('practice.l_mcs.index')).then(function(res){
            Mcses.value = res.data.message
            drawer.value = true
            links.value = res.data.message.links
            console.log(Mcses)
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
        getMcsesIndex()
    });

</script>
