<template>
    <MainLayout>
        <v-container>
            <v-row>
                <v-col>
                    <highlightIncorectWord :sentence="sentence"/>
                </v-col>
            </v-row>
        </v-container>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import highlightIncorectWord from '@/Components/highlightIncorectWord.vue';
import { ref } from 'vue';

const sentence = ref(`What we are gonna find out today is how it's a bit more demanding(Answer: complicated) than that, which it always is. 
I think it's really ordinary (Answer: wonderful) . Imean, not being an experimental scientist myself, I have a kind of confusion (Answer: envy) 
at the way in which science cancontinue to upset(Answer: surprise) us by this. People working away in labs, moving on our emotion 
(Answer: understanding) in ways. Hugo is a cognitive scientist at the French National Center for Scientific Research. Hugo Mercier.`)

</script>