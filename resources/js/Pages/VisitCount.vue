<script setup>
import {ref} from 'vue'

const messages = ref([])
const message = ref("")
//listen Messages chanel
Echo.channel('messages').listen("MessageReceived", (e) => {
    if (!messages.value.find(m => m.id === e.id)) {
        messages.value.push({
            ...e,
            who: "Other"
        });
    }
})

function handleSubmit() {
    const msg = {
        id: crypto.randomUUID(),
        message: message.value
    }
    messages.value.push({
        ...msg,
        who: "Me"
    })
    axios.post('/messages', msg)
}
</script>

<template>
    <ul>
        <li v-for="message in messages" :key="message.id">
            {{ message.message }} - {{message.who}}
        </li>
    </ul>
    <form @submit.prevent="handleSubmit">
        <textarea v-model="message"></textarea>
        <button class="btn btn-default">Send Message</button>
    </form>
</template>

<style scoped>
</style>
