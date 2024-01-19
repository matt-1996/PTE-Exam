<template>
<DashBoardLayout>
    <v-row>
        <v-col>
            <v-carousel
            class="border rounded-lg"
                cycle
                height="auto"
                hide-delimiter-background
                hide-delimiters
                show-arrows="hover"
            >
                <v-carousel-item
                v-for="(plan, i) in plans"
                :key="i"
                >
                <v-card
                color="#FFFAA0"
                class=""
                max-width=""
                @click="console.log('clicked')"
                >
                    
                    <div class="mx-auto ml-52 p-2 pt-4">
                        <v-card-title class="text-green-500 text-center">
                            <span class="text-sm">USD $ </span>
                            <span class="text-md font-bold">{{ parseInt(plan.price) }}</span>
                            <span class="text-xs">.{{ (plan.price + "").split(".")[1] }}</span>
                        </v-card-title>
                    </div>
                    <div>
                        <v-card-title class="text-center">
                            <span class="text-3xl font-bold">
                                <v-icon size="large" color="yellow">mdi-crown</v-icon>
                                {{ plan.name }}</span>
                        </v-card-title>
                    </div>

                    <v-card-subtitle class="text-center">
                     {{ plan.valid_days }} Days
                    </v-card-subtitle>

                    <v-card-actions>
                    
                    </v-card-actions>

            </v-card>
                </v-carousel-item>
  </v-carousel>
        </v-col>
    </v-row>
    <v-row>
        <v-col cols="12" sm="4" v-for="plan in plans" :key="plan.id">
            <v-card
                class="border boder-green-500 rounded"
                max-width="344"
                :class="{'border boder-green-500 rounded' : selected}"
                @click="selected = true"
                >
                    
                    <div class="mx-auto ml-52 pt-4">
                        <v-card-title class="text-green-500 text-center">
                            <span class="text-sm">USD $ </span>
                            <span class="text-md font-bold">{{ parseInt(plan.price) }}</span>
                            <span class="text-xs">.{{ (plan.price + "").split(".")[1] }}</span>
                        </v-card-title>
                    </div>
                    <div>
                        <v-card-title class="text-center">
                            <span class="text-2xl font-bold">
                                <v-icon size="large" color="yellow">mdi-crown</v-icon>
                                {{ plan.name }}</span>
                        </v-card-title>
                    </div>

                    <v-card-subtitle class="text-center">
                     {{ plan.valid_days }} Days
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
import DashBoardLayout from '../../Layouts/DashboardLayout.vue'
import {ref} from 'vue';

const selected = false
defineProps({plans: Object})

</script>