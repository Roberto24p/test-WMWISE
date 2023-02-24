<template>
    <table class="table-auto">
        <thead>
            <tr>
                <th v-for="h in header">{{ h }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="d in data">
                <td class="p-4">{{ d.name }}</td>
                <td class="p-4">{{ d.email }}</td>
                <td class="p-4">{{ d.address }}</td>
                <td class="p-4">
                    <button class="bg-red-400 hover:red-800 text-white font-bold py-2 px-4 rounded"
                        @click="$emit('delete', d.id)">
                        Delete
                    </button>
                    <button class=" ml-4 bg-yellow-400 hover:yellow-800 text-white font-bold py-2 px-4 rounded"
                        @click="$emit('update', { name: d.name, email: d.email, address: d.address, id: d.id })">
                        Update
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
const props = defineProps(['header', 'data'])


</script>