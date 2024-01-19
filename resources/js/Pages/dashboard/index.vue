<template>
<DashBoardLayout>
    <v-row no-gutters>
        <v-col cols="12">
            <v-carousel
            class="border rounded-lg"
                cycle
                height="100"
                hide-delimiter-background
                hide-delimiters
                show-arrows="hover"
            >
                <v-carousel-item
                v-for="(slide, i) in slides"
                :key="i"
                >
                    <v-sheet
                        :color="colors[i]"
                        height="100%">
                        <div class="d-flex fill-height justify-center align-center">
                        <div class="text-h2">
                            {{ slide }} Slide
                        </div>
                        </div>
                    </v-sheet>
                </v-carousel-item>
  </v-carousel>
        </v-col>
    </v-row>
</DashBoardLayout>
</template>

<script setup>
import DashBoardLayout from '../../Layouts/DashboardLayout.vue'
import {ref} from 'vue';

const slides = ref([ 'First' , 'Second',
           'Third',
           'Fourth',
           'Fifth'])

const colors = ref(['indigo',
           'warning',
           'pink darken-2',
          'red lighten-1',
          'deep-purple accent-4'])
</script>