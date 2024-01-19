<template>
<DashboardLayout>
    <v-row>
        <v-col>
            <v-card
                class="mx-auto"
                max-width="1000"
                elevation="16"
                title="Settings"
            >
                <v-card-item class="text-center py-16 pb-48 border border-b-2 border-gray-200">
                    <Avatar class="w-16 h-16 "/>
                    <!-- <v-card-title class="text-center py-5">
                        <span class="text-center text-4xl text-green-300 py-4">Settings</span>
                    </v-card-title> -->
                   
                    <v-card-title class="text-center pt-2">
                        <span class="text-base text-gray-500">
                            First Name:
                            <span>{{ user.name }}</span>
                            <span class="ml-4"> <v-icon size="small">mdi-pencil-outline</v-icon></span>
                        </span>
                    </v-card-title>
                   
                    <v-card-title class="text-center">
                        <span class="text-base text-gray-500">
                            Last Name:
                            <span>{{ user.last_name }}</span>
                            <span class="ml-4"><v-icon size="small">mdi-pencil-outline</v-icon></span>
                        </span>
                    </v-card-title>
                    <v-card-title class="text-center">
                        <span class="text-base text-gray-500">
                            Email:
                            <span>{{ user.email }}</span>
                        </span>
                    </v-card-title>
                </v-card-item>
            </v-card>
        </v-col>
    </v-row>
</DashboardLayout>
</template>

<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { usePage } from '@inertiajs/vue3'
import Avatar from '../../Components/Avatar.vue'
import {computed} from 'vue'

const page = usePage()

const user = computed(() => page.props.auth?.user)
</script>