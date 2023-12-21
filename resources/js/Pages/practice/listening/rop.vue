<template>
    <MainLayout>
        <v-container>
            <Drawer :datas="Rops" :links="links" title="Re-order Paragraphs" routeName="practice.l_rop.show" :image="image" />
            <v-row class="mt-2" justify="center" align="center" offset-md="1">
                <v-col cols="3">
                    <div class="">
                        <img width="200" :src="image" alt="">
                    </div>
                </v-col>
                <v-col cols="9" class="">
                    <h2 class="text-2xl my-2">Re-order Paragraphs
                        <span class="rounded-md text-sm text-white p-1 bg-green-500">
                        <v-icon class="p-1">mdi-school-outline</v-icon>
                        Study Guide
                    </span></h2>
                    <p>The text boxes in the left panel have been placed in a random order. Restore the original order by dragging the text boxes from the left panel to the right panel.</p>
                </v-col>
                <v-divider inset thickness="1" class="border-opacity-100 border-gray-200"></v-divider>
            </v-row>
            <v-row>
                <v-col>
                    <div class="py-10">
                        <span>
                            {{ rop.title }}
                        </span>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <vue-countdown v-if="prepare" :end="stop" :time=" 1 * rop.duration * 1000" v-slot="{ minutes,seconds }" @end="onPrepareEnd(rop.duration)">
                    <div class="text-red-400">Prepare: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>

                <!-- <vue-countdown v-if="timer" :time=" 1 * rop.duration * 1000" v-slot="{ minutes,seconds }" @end="onTimeEnd">
                    <div class="text-black">Time: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown> -->
            </v-row>
            <v-row>
                <v-col>
                    <!-- <div v-for="paragraph in paragraphs" :key="paragraph.id">
                        <p>{{ paragraph.paragraph }}</p>
                    </div> -->

                    <draggable v-model="originalParagraphs" tag="ul" id="paragraphs" :animation="300">
                        <template #item="{ element: originalParagraph }">
                        <li class="border-2 cursor-pointer p-5 my-3 border-dashed">{{ originalParagraph.paragraph }}</li>
                        </template>
                    </draggable>
                    <button :disabled="disableBtn" class="my-3 py-2 px-3 rounded-md bg-green-500 text-white" @click="checkMove">Submit</button>
                </v-col>
            </v-row>
            <v-row v-if="submited">
                <v-col>
                    <v-divider></v-divider>
                    <div>
                        <h3>Answer:</h3>
                    </div>
                        <span v-for="ans in answers" :key="ans.id">{{ ans.order }}, </span>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import axios from 'axios';
import Drawer from '../../../Components/Drawer.vue';
import draggable from 'vuedraggable';
import { ref,reactive } from 'vue'
import { onMounted } from 'vue';

const Rops = ref(0)
const links = ref(0)
const prepare = ref(true)
const timer = ref(false)
const stop = ref(true)
const drawer = ref(false)
const submited = ref(false)
const radios = ref(null)
const disableState = ref(true)
const publicPath = ref('../../../../../')
const image = ref(publicPath.value + '/images/ro_r_v2.png')

const props = defineProps({rop: Object, paragraphs: Object, answers: Object})

const originalParagraphs = ref(props.paragraphs)

const originalSelected = reactive([])

const disableBtn = ref(false)

const paragraphs = reactive(props.paragraphs)

const answer = reactive(props.answers)

const myArray = reactive([])

const userAnswered = reactive([])

// console.log(ropRef.value)

function checkMove(e){
    submited.value = true
    var lis = document.getElementById("paragraphs").getElementsByTagName("li");
    while (userAnswered.length !=0) {
        userAnswered.pop();
        }

        while (myArray.length !=0) {
            myArray.pop();
        }


    lis.forEach(element => {
        userAnswered.push(element.innerHTML)
    })

    answer.forEach(element => {
        myArray.push(element.paragraph)
    });

    const result = arraysEqual(userAnswered,myArray)

    if(result == true){
        console.log("yaaaay")
    }

}

function arraysEqual(a, b) {
  if (a === b) return true;
  if (a == null || b == null) return false;
  if (a.length !== b.length) return false;

  // If you don't care about the order of the elements inside
  // the array, you should sort both arrays here.
  // Please note that calling sort on an array will modify that array.
  // you might want to clone your array first.

  for (var i = 0; i < a.length; ++i) {
    if (a[i] !== b[i]) return false;
  }
  return true;
}

function getRopsIndex(){
        axios.get(route('practice.l_rop.index')).then(function(res){
            Rops.value = res.data.message
            drawer.value = true
            links.value = res.data.message.links
            // console.log(Rops)
        })
    }

    function onPrepareEnd(duration)
    {
        disableBtn.value = true
    }

    function onTimeEnd()
    {
        console.log('ended')
    }
    onMounted(() => {
        getRopsIndex()
    });
</script>
