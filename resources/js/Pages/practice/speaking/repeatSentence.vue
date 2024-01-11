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
            <Drawer :datas="RepeatSentences" :links="links" :image="image" title="Repeat Sentence" routeName='practice.repeat.sentence.show' />
            <v-row class="mt-2" justify="center" align="center" offset-md="1">
                <v-col cols="3">
                    <div class="">
                        <img width="200" :src="publicPath + 'images/rs_s_ai.png'" alt="">
                    </div>
                </v-col>
                <v-col cols="9" class="">
                    <h2 class="text-2xl my-2">Repeat Sentence
                        <span class="rounded-md text-sm text-white p-1 bg-green-500">
                        <v-icon class="p-1">mdi-school-outline</v-icon>
                        Study Guide
                    </span></h2>
                    <p>You will hear a sentence. Please repeat the sentence exactly as you hear it. You will hear the sentence only once.</p>
                </v-col>
                <v-divider inset thickness="1" class="border-opacity-100 border-gray-200"></v-divider>
            </v-row>
            <v-row>
                <v-col cols="12" sm="10">
                    <div class="py-10">
                        <span>
                            {{ repeatSentence.title }}
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
                                        <p class="text-gray-500" @click="bookmark(repeatSentence.id,bookamrk.color)">{{ bookamrk.title }}</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <vue-countdown v-if="prepare" :time=" 1 * repeatSentence.duration * 1000" v-slot="{ minutes,seconds }" @end="onPrepareEnd(practiceDuration)">
                    <div class="text-red-400">Prepare: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>

                <vue-countdown v-if="timer" :time=" 1 * practiceDuration * 1000" v-slot="{ minutes,seconds }" @end="onTimeEnd">
                    <div class="text-black">Time: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>
            </v-row>
            <v-row>
                <v-col>

                   <audio v-if="showAudioPlayer" :src="AudioUrl" controls></audio>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <!-- <source src="horse.ogg" type="audio/ogg"> -->
                    <div v-for="file in files" :key="file.id">
                        <audio controls >
                            <source :src="publicPath + file.audio_path" type="audio/mpeg">
                            Your browser does not support the audio element.
                            </audio>
                        </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <!-- <div class="border border-dashed border-spacing-2 p-5">
                        {{ reading.context }}
                    </div> -->
                </v-col>
            </v-row>
            <v-row justify="center" align="center">
                <v-col>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2.5 rounded-full" :style="{width:   progressWidth / practiceDuration * 100  + '%' }"></div>
                    </div>
                    <div v-if="prepare" class="bg-gray-200 opacity-75 p-4 cursor-pointer"  @click="repeatSentence.duration = 0; practiceDuration = 20">
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
import Drawer from '../../../Components/Drawer.vue'
import axios from 'axios';
import voiceRecorder from '../../../Lib/recorder'
import { ref,computed,reactive } from 'vue'
import { onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3'
const page = usePage()
const userBookmarks = computed(() => page.props?.bookmarks)
const userBookmarksColor = computed(() => page.props.bookmarks?.color)

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
    const RepeatSentences = ref(0);
    const progressWidth = ref(1)
    const snackbar = ref(false)

    const links = ref(0)
    const AudioUrl = ref()
    const showAudioPlayer = ref(false)
    const publicPath = ref('../../../../../')
    const image = ref(publicPath.value + '/images/rs_s_ai.png')

    
    const props = defineProps({ repeatSentence : Object , files: Object})
    const practiceDuration = ref(props.repeatSentence.duration)

    function onPrepareEnd(seconds)
    {
        console.log("Counter Ended")
        prepare.value = false
        timer.value = true
        var audio = new Audio('../../../../../sounds/beep.wav');
        audio.play();
        voiceRecorder.record(seconds,progressWidth,snackbar,AudioUrl,showAudioPlayer,practiceDuration)

    }

    function getRepeatSentenceIndex(){
        axios.get(route('practice.repeatSentence.Index')).then(function(res){
            RepeatSentences.value = res.data.message.data
            drawer.value = true
            links.value = res.data.message.links
            console.log(RepeatSentences)
        })
    }
    onMounted(() => {
        getRepeatSentenceIndex()
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
