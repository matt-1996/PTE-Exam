<template>
    <MainLayout title="questions">
        <v-container>
            <Drawer :datas="answerShortQuestions" :links="links" title="Answer Short Question" routeName="practice.answerShortQuestion.show" :image="image" />

            <v-row class="mt-2" justify="center" align="center" offset-md="1">
                <v-col cols="3">
                    <div class="">
                        <img width="200" :src="publicPath + 'images/asq_s_ai.png'" alt="">
                    </div>
                </v-col>
                <v-col cols="9" class="">
                    <h2 class="text-2xl my-2">Answer Short Question
                        <span class="rounded-md text-sm text-white p-1 bg-green-500">
                        <v-icon class="p-1">mdi-school-outline</v-icon>
                        Study Guide
                    </span></h2>
                    <p>You will hear a question. Please give a simple and short answer. Often just one or a few words is enough.</p>
                </v-col>
                <v-divider inset thickness="1" class="border-opacity-100 border-gray-200"></v-divider>
            </v-row>
            <v-row>
                <v-col>
                    <div class="py-10">
                        <span>
                            {{ answerShortQuestion.title }}
                        </span>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <vue-countdown v-if="prepare" :time=" 1 * answerShortQuestion.duration * 1000" v-slot="{ minutes,seconds }" @end="onPrepareEnd">
                    <div class="text-red-400">Prepare: 0{{ minutes }}:{{ seconds }}</div>
                </vue-countdown>

                <vue-countdown v-if="timer" :time=" 1 * answerShortQuestion.duration * 1000" v-slot="{ minutes,seconds }" @end="onTimeEnd">
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
            <v-row>
                <v-col>
                    <!-- <div class="border border-dashed border-spacing-2 p-5">
                        {{ reading.context }}
                    </div> -->
                </v-col>
            </v-row>
            <v-row justify="center" align="center">
                <v-col>
                    <div class="bg-gray-200 opacity-75 p-4">
                        <div class="text-center">
                            Click to Start
                        </div>
                        <div class="text-center mt-2">
                            <v-icon id="start" @click="startRecording()" class="bg-gray-400 rounded-full p-6">mdi-microphone</v-icon>
                            <v-icon id="stop" class="bg-gray-400 rounded-full p-6">mdi-microphone</v-icon>
                            <v-icon id="play" class="bg-gray-400 rounded-full p-6">mdi-microphone</v-icon>
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
import Drawer from '../../../Components/Drawer.vue';
import { ref } from 'vue'
import { onMounted } from 'vue';


    const prepare = ref(true)
    const timer = ref(false)
    const drawer = ref(false)
    const dropDownPracticeToggle = ref(false)
    const dropDownToggle = ref(false)
    const answerShortQuestions = ref(0);
    const links = ref(0)
    const publicPath = ref('../../../../../')
    const image = ref(publicPath.value + '/images/asq_s_ai.png')
    defineProps({ answerShortQuestion : Object , files: Object})

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
            answerShortQuestions.value = res.data.message.data
            drawer.value = true
            links.value = res.data.message.links
            console.log(links)
        })
    }


      function startRecording()
      {
        let audioIN = { audio: true };
    //  audio is true, for recording

    // Access the permission for use
    // the microphone
    navigator.mediaDevices.getUserMedia(audioIN)

      // 'then()' method returns a Promise
      .then(function (mediaStreamObj) {

        // Connect the media stream to the
        // first audio element
        let audio = document.querySelector('audio');
        //returns the recorded audio via 'audio' tag

        // 'srcObject' is a property which
        // takes the media object
        // This is supported in the newer browsers
        if ("srcObject" in audio) {
          audio.srcObject = mediaStreamObj;
        }
        else {   // Old version
          audio.src = window.URL
            .createObjectURL(mediaStreamObj);
        }

        // It will play the audio
        audio.onloadedmetadata = function (ev) {

          // Play the audio in the 2nd audio
          // element what is being recorded
          audio.play();
        };

        // Start record
        let start = document.getElementById('btnStart');

        // Stop record
        let stop = document.getElementById('stop');

        // 2nd audio tag for play the audio
        let playAudio = document.getElementById('paly');

        // This is the main thing to recorded
        // the audio 'MediaRecorder' API
        let mediaRecorder = new MediaRecorder(mediaStreamObj);
        // Pass the audio stream

        // Start event
        start.addEventListener('click', function (ev) {
          mediaRecorder.start();
          // console.log(mediaRecorder.state);
        })

        // Stop event
        stop.addEventListener('click', function (ev) {
          mediaRecorder.stop();
          // console.log(mediaRecorder.state);
        });

        // If audio data available then push
        // it to the chunk array
        mediaRecorder.ondataavailable = function (ev) {
          dataArray.push(ev.data);
        }

        // Chunk array to store the audio data
        let dataArray = [];

        // Convert the audio data in to blob
        // after stopping the recording
        mediaRecorder.onstop = function (ev) {

          // blob of type mp3
          let audioData = new Blob(dataArray,
                    { 'type': 'audio/mp3;' });

          // After fill up the chunk
          // array make it empty
          dataArray = [];

          // Creating audio url with reference
          // of created blob named 'audioData'
          let audioSrc = window.URL
              .createObjectURL(audioData);

          // Pass the audio url to the 2nd video tag
          playAudio.src = audioSrc;
          console.log(audioSrc)
        }
      })

      // If any error occurs then handles the error
      .catch(function (err) {
        console.log(err.name, err.message);
      });
      }


    function recordAudio() {
      var device = navigator.mediaDevices.getUserMedia({ audio: true });
      device.then((stream) => {
        // use this!
        recorder = new MediaRecorder(stream);
        mediaRecorder.start();
        const audioChunks = [];
        this.recorder.ondataavailable = (e) => {
            audioChunks.push(e.data);
        };

        mediaRecorder.addEventListener("stop", () => {
            const audioBlob = new Blob(audioChunks);
            const audioUrl = URL.createObjectURL(audioBlob);
            const audio = new Audio(audioUrl);
            audio.play();
    });

        setTimeout(() => {
        mediaRecorder.stop();
        }, 10000);
      });
    }
    function getanswerShortQuestionIndex(){
        axios.get(route('practice.answerShortQuestion.index')).then(function(res){
            answerShortQuestions.value = res.data.message.data
            drawer.value = true
            links.value = res.data.message.links
            console.log(answerShortQuestions)
        })
    }
    onMounted(() => {
        getanswerShortQuestionIndex()
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
