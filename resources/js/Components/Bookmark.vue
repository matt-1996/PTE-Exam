<template>
     <h1>{{ practiceId }}</h1>
    <div class="" @mouseover="showBookmarkList = true" @mouseout="showBookmarkList = false">
        <div class="mt-7 ml-15" >
            <v-icon  :color="userBookmarksColor || 'gray'" size="30" :class="{userBookmarksColor : 'text-gray-500'}">mdi-bookmark</v-icon>
        </div>
    </div>

    <div v-if="showBookmarkList" @mouseover="showBookmarkList = true" @mouseout="showBookmarkList = false" class="mr-32 w-32 shadow-2xl drop-shadow-xl">
        <div class="p-2 absolute top-0 right-2 z-10 bg-white" >
            <div class="flex py-2 hover:bg-black cursor-pointer" v-for="bookamrk in bookamrks">
                <div class="">
                    <v-icon size="30" :color="bookamrk.color">{{ bookamrk.icon }}</v-icon>
                </div>
            <div>
                <p class="text-gray-500" @click="console.log('clicked')">{{ bookamrk.title }}</p>
            </div>
        </div>
    </div>
    </div>
</template>

<script setup>
import {ref,computed,reactive} from 'vue';
import { usePage } from '@inertiajs/vue3'

defineProps({practiceId: String})
const page = usePage()
const userBookmarks = computed(() => page.props?.bookmarks)
const userBookmarksColor = computed(() => page.props.bookmarks?.color)
const selectedBookmark = ref()

const showBookmarkList = ref(false)
    const bookamrks = reactive([
        {title:"orange", icon:'mdi-bookmark' , color:'orange'},
        {title:"red", icon:'mdi-bookmark' , color:'red'},
        {title:"green", icon:'mdi-bookmark' , color:'green'},
        {title:"purple", icon:'mdi-bookmark' , color:'purple'},
        {title:"unmark", icon:"mdi-bookmark", color:"gray"}
    ])

    function bookmarkRequest(id,color){
        axios.post(route('bookmark.add',{'id' : id, 'color':color}))
            .then(function(){
                location.reload();
            })
    }
</script>