<template>
<DashBoardLayout>
    <v-row>
        <v-col v-for="course in courses" :key="course.id">
            <v-card
                class=""
                max-width="344">
                    <v-img
                    :src="course.image_path"
                    height="150px"
                    cover
                    ></v-img>

                    <v-card-title>
                        <span>{{ course.name }}</span>
                    </v-card-title>

                    <v-card-title>
                        <span>Price:</span>
                        <span class="text-sm"> $</span>
                        <span class="text-md font-bold">{{ parseInt(course.price) }}</span>
                        <span class="text-xs">.{{ (course.price + "").split(".")[1] }}</span>
                    </v-card-title>

                    <v-card-subtitle>
                        <span>{{ course.description }}</span>
                    </v-card-subtitle>

                    <v-card-actions>
                    <!-- <v-btn
                        color="orange-lighten-2"
                        variant="text"
                    >
                        Unpurchased
                    </v-btn> -->

                    <v-spacer></v-spacer>

                     <!-- <v-btn
                        :icon="show ? 'mdi-chevron-up' : 'mdi-chevron-down'"
                        @click="show = !show"
                    ></v-btn>  -->
                    </v-card-actions>

                    <!-- <v-expand-transition>
                    <div v-show="show">
                        <v-divider></v-divider>

                        <v-card-text>
                        I'm a thing. But, like most politicians, he promised more than he could deliver. You won't have time for sleeping, soldier, not with all the bed making you'll be doing. Then we'll go with that data file! Hey, you add a one and two zeros to that or we walk! You're going to do his laundry? I've got to find a way to escape.
                        </v-card-text>
                    </div>
                    </v-expand-transition> -->
            </v-card>
        </v-col>
    </v-row>
</DashBoardLayout>
</template>

<script setup>
import {ref} from 'vue';
import DashBoardLayout from '../../Layouts/DashboardLayout.vue'

defineProps({courses: Object})

</script>