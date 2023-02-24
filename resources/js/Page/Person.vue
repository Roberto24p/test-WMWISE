<template>
    <div class="grid grid-cols-12 gap-5 mx-5 mt-2">
        <div class="col-span-9">

            <Table :header="header" :data="persons" @delete="deletePerson" @update="fillFormToUpdate">
            </Table>
        </div>
        <div class="col-span-3">
            <div class="w-full max-w-md justify-center mx-auto">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="text-center block text-gray-700 text-sm font-bold mb-2"> {{ person.id == 0 ? 'Add a new person'
                    : 'Update the information of ' + person.name }}</div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        v-model="person.name" type="text" placeholder="Name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        v-model="person.email" type="email" placeholder="email">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Address
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        v-model="person.address" type="email" placeholder="Address">
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button" @click="buttonAddUser">
                        {{ person.id == 0 ? 'Add' : 'Update' }}
                    </button>
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button" @click="reset">
                        Reset
                    </button>
                </div>
            </form>

        </div>
        </div>


    </div>
</template>
<script setup>
import Table from "../components/Table.vue"
import { ref, onMounted, reactive } from "vue";
import PersonServices from "../services/PersonServices";
const header = ref([
    'Name', 'Email', 'Address', 'Actions'
])
const person = reactive({
    name: '',
    email: '',
    address: '',
    id: 0
})
const persons = ref([])

const getPersons = async () => {
    const response = await PersonServices.get()
    console.log(response)
    persons.value = response.persons
}

const deletePerson = async (id) => {
    const response = await PersonServices.delete(id)
    if (response.success) {
        getPersons()
    }
}

const fillFormToUpdate = async (p) => {
    person.name = p.name
    person.email = p.email
    person.address = p.address
    person.id = p.id
}



const buttonAddUser = async () => {
    if (person.id == 0) {
        const response = await PersonServices.store(person)
        if (response.success) {
            getPersons()
            reset()
        }
    } else {
        const response = await PersonServices.update(person)
        if (response.success) {
            getPersons()
            reset()
        }
    }
}

const reset = () => {
    person.name = ''
    person.email = ''
    person.address = ''
    person.id = 0
}

onMounted(() => {
    getPersons()
})

</script>
