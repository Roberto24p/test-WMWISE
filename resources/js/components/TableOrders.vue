<template>
    <table class="table-auto">
        <thead>
            <tr>
                <th v-for="h in header">{{ h }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="d in data">
                <td class="p-4">{{ d.reference }}</td>
                <td class="p-4">{{ d.date_to_complete_order }}</td>
                <td class="p-4">{{ d.status }}</td>
                <td class="p-4">{{ d.comments }}</td>
                <td class="p-4">{{ d.person.name }}</td>
                <td class="p-4">
                    <button class="bg-red-400 hover:red-800 text-white font-bold py-2 px-4 rounded"
                        @click="$emit('delete', d.id)">
                        Delete
                    </button>
                    <button class=" ml-4 bg-yellow-400 hover:yellow-800 text-white font-bold py-2 px-4 rounded"
                        @click="$emit('update', { comments: d.comments, reference: d.reference, date_to_complete_order: d.date_to_complete_order, status:  d.status, id: d.id, person_id: d.person_id })">
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