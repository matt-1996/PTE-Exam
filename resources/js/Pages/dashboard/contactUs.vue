<template>
<DashBoardLayout>
    <v-row>
        <v-col cols="12" sm="12">
            <v-card
                class="mx-auto my-8"
                max-width="1000"
                elevation="16"
            >
                <v-card-item>
                    <v-card-title class="text-center py-5">
                        <span class="text-center text-4xl text-green-300 py-4">Contact Us</span>
                    </v-card-title>
                    <!-- <v-card-title class="py-4">
                        Contact Us
                    </v-card-title> -->
                    <v-card-title class="pt-2">
                        <span class="text-lg font-bold border-b-2 border-cyan-200">
                            Email
                        </span>
                    </v-card-title>
                    <v-card-title class="pb-4">
                        <span class="text-base text-gray-500 ">
                            apeuni@gmail.com
                        </span>
                    </v-card-title>
                    <v-card-title>
                        <span class="text-lg font-bold border-b-2 border-cyan-200">
                            Telegram Channel
                        </span>
                    </v-card-title>
                    <v-card-title class="pb-10">
                        <span class="text-base text-gray-500">
                            <a href="https://t.me/my-channel">@my-channel</a>
                        </span>
                    </v-card-title>
                   
                </v-card-item>
            </v-card>
        </v-col>
    </v-row>
</DashBoardLayout>
</template>

<script setup>
import DashBoardLayout from '../../Layouts/DashboardLayout.vue'
</script>