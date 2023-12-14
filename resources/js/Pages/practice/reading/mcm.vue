<template>
    <MainLayout>
        <v-container>
        <Drawer :datas="Mcms" :links="links" title="Multiple Choice (Multiple)" routeName="practice.r_mcm.show" :image="image" />
        <v-row class="mt-2" justify="center" align="center" offset-md="1">
                <v-col cols="3">
                    <div class="">
                        <img width="200" :src="image" alt="">
                    </div>
                </v-col>
                <v-col cols="9" class="">
                    <h2 class="text-2xl my-2">Multiple Choice (Multiple)
                        <span class="rounded-md text-sm text-white p-1 bg-green-500">
                        <v-icon class="p-1">mdi-school-outline</v-icon>
                        Study Guide
                    </span></h2>
                    <p>Listen to the recording and answer the question by selecting all the correct responses. You will need to select more than one response.</p>
                </v-col>
                <v-divider inset thickness="1" class="border-opacity-100 border-gray-200"></v-divider>
            </v-row>
            <v-row>
                <v-col>
                    <div class="py-10">
                        <span>
                            {{ mcm.title }}
                        </span>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <vue-countdown v-if="prepare" :time=" 1 * mcm.duration * 1000" v-slot="{ minutes,seconds }" @end="onPrepareEnd(mcm.duration)">
                    <div class="text-red-400">Prepare: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>

                <vue-countdown v-if="timer" :time=" 1 * mcm.duration * 1000" v-slot="{ minutes,seconds }" @end="onTimeEnd">
                    <div class="text-black">Time: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>
            </v-row>
            <v-row>
                <v-col>
                    <p>{{ mcm.context }}</p>
                </v-col>
            </v-row>
            <v-row v-if="!submited">
                <v-col>
                    <div v-for="answer in answers" :key="answer.id">
                        <v-checkbox

                            :label="answer.answer"
                            :value="answer.answer">
                    </v-checkbox>
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
        </v-container>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import axios from 'axios';
import Drawer from '../../../Components/Drawer.vue';

import { ref } from 'vue'
import { onMounted } from 'vue';

const Mcms = ref(0)
const links = ref(0)
const prepare = ref(true)
const timer = ref(false)
const drawer = ref(false)
const submited = ref(false)
const disableState = ref(true)
const publicPath = ref('../../../../../')
const image = ref(publicPath.value + '/images/mcm_l_v2.png')

defineProps({mcm: Object, answers: Object})

function getMcmsIndex(){
        axios.get(route('practice.r_mcm.index')).then(function(res){
            Mcms.value = res.data.message
            drawer.value = true
            links.value = res.data.message.links
            console.log(Mcms)
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
        getMcmsIndex()
    });

</script>
