<template>
    <div class=" justify-center bg-indigo-100 p-5">
        <div class="text-center block text-gray-700 text-sm font-bold mb-2">Test of WMWISE </div>
        <div class="text-center block text-gray-700 text-sm font-bold mb-2">This test was develop by : Roberto Placencio -
            <a href="https://github.com/Roberto24p" class="text-green-700">Github</a> </div>

        <button class="bg-blue-400 hover:blue-800 text-white font-bold py-2 px-4 rounded"
            @click="orderView = true; personView = false">Orders</button>
        <button class="bg-blue-400 hover:blue-800 text-white font-bold py-2 px-4 rounded ml-4"
            @click="personView = true; orderView = false">Persons</button>
    </div>
    <person v-if="personView"></person>
    <order v-if="orderView"></order>

</template>

<script setup>
import Person from "../Page/Person.vue"
import Order from "../Page/Order.vue"

import { ref } from "vue";
const personView = ref(true)
const orderView = ref(false)

</script>
