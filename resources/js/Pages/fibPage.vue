<template>
<MainLayout>
    <v-container>
        <Fib :sentence="sentence" />
    </v-container>
</MainLayout>
</template>

<script setup>
import {ref} from 'vue'
import MainLayout from '../Layouts/MainLayout.vue'
import Fib from '../Components/Fib.vue'

const sentence = ref(`In today's fast-paced world, our [indiffrence,someWord]
to the environment is a pressing concern. The relentless exploitation of natural resources,[esclating]
pollution levels, and the looming threat of climate change have brought us to a critical juncture. The need for [proactive]
action to protect our planet has never been more urgent. One of the key contributors to environmental degradation is the excessive use of single-use plastics. These items, such as plastic bags and bottles, end up in our oceans and harm marine life. Using plastic [alternatives]
and recycling efforts are steps in the right direction, but a more comprehensive approach is required. Individuals, communities, governments, and industries all play a role in shaping the future of our planet. We must
[collectively] reduce our dependence on fossil fuels, promote renewable energy sources, and adopt sustainable practices in agriculture and manufacturing.`)
</script>