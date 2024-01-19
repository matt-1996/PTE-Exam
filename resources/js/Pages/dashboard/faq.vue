<template>
<DashBoardLayout>
    <v-row>
        <v-col>
            <v-expansion-panels v-for="faq in faqs" :key="faq.id" variant="accordion">
                <v-expansion-panel
                    :title="faq.question"
                    :text="faq.answer"
                >
                </v-expansion-panel>
            </v-expansion-panels>
        </v-col>
    </v-row>
</DashBoardLayout>
</template>

<script setup>
import DashBoardLayout from '../../Layouts/DashboardLayout.vue';

defineProps({faqs : Object})
</script>