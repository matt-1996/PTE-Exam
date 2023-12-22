<template>
    <MainLayout>
        <v-container>
        <Drawer :datas="Fibs" :links="links" title="Reading & Writing：Fill in the blanks" routeName="practice.r_fib.show" :image="image" />
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
                <v-col>
                    <div class="py-10">
                        <span>
                            {{ fib.title }}
                        </span>
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
        </v-container>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import fillInTheBlank from '../../../Components/fillInTheBlank.vue'
import { reactive,onMounted,ref } from 'vue';
import axios from 'axios';
import Drawer from '../../../Components/Drawer.vue';

const Fibs = ref(0)
const links = ref(0)
const prepare = ref(true)
const timer = ref(false)
const drawer = ref(false)
const submited = ref(false)
const disableState = ref(true)
const publicPath = ref('../../../../../')
const image = ref(publicPath.value + '/images/fib_r_v2.png')

defineProps({fib: Object})


const sentence = ref(`In today's fast-paced world, our [indiffrence]
to the environment is a pressing concern. The relentless exploitation of natural resources,[esclating]
pollution levels, and the looming threat of climate change have brought us to a critical juncture. The need for [proactive]
action to protect our planet has never been more urgent. One of the key contributors to environmental degradation is the excessive use of single-use plastics. These items, such as plastic bags and bottles, end up in our oceans and harm marine life. Using plastic [alternatives]
and recycling efforts are steps in the right direction, but a more comprehensive approach is required. Individuals, communities, governments, and industries all play a role in shaping the future of our planet. We must
[collectively] reduce our dependence on fossil fuels, promote renewable energy sources, and adopt sustainable practices in agriculture and manufacturing.`)

function getFibsIndex(){
        axios.get(route('practice.r_fib.index')).then(function(res){
            Fibs.value = res.data.message
            drawer.value = true
            links.value = res.data.message.links
            console.log(Fibs)
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
