<template>

    <MainLayout title="questions">
        <!-- <div class="mt-5" v-for="question in questions.data" :key="question.id"> -->
            <template title="modal">
        <div class="text-center">
    <v-btn
      color="primary"
    >
      Open Dialog

      <v-dialog
        v-model="dialog"
        activator="parent"
        width="auto"
      >
        <v-card>
          <v-card-text>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" block @click="dialog = false">Close Dialog</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-btn>
  </div>
    </template>
            <v-card
                class="mx-auto"
                max-width="700">

                <v-list

                >
                <v-list-item v-for="(item, i) in questions.data"
                   :key="i"
                   :active="item.id === selected"
                   @click="getQuestion(item.id)">
                   <template v-slot:prepend>
                     <v-icon icon="mdi-flag"></v-icon>
                    </template>
                   <v-list-item-title v-text="item.name"></v-list-item-title>
                </v-list-item>
            </v-list>
            </v-card>
        <!-- <h1>{{ question }}</h1> -->
        <!-- </div> -->
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import axios from 'axios';

import { ref } from "vue";
defineProps({ questions: Array })

const selected = ref("");
function getQuestion(id)
{
    axios.get(route('question.show', id)).then(function(res){
        console.log(res)
    })

}
// import AppLayout from '@/Layouts/AppLayout.vue';
</script>
