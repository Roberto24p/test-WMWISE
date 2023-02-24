<template>
    <div class="grid grid-cols-12 gap-5 mx-5 mt-2">
        <div class="col-span-9">
            <TableOrders :header="header" :data="orders" @update="fillFormToUpdate" @delete="deleteOrder"></TableOrders>
        </div>
        <div class="col-span-3">
            <div class="w-full max-w-md justify-center mx-auto">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="text-center block text-gray-700 text-sm font-bold mb-2"> </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Reference
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            v-model="order.reference" type="text" placeholder="Name">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Date to complete order
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            v-model="order.date_to_complete_order" type="date" placeholder="Address">
                    </div>
                    <div class="mb-4" v-show="order.id > 0">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Status
                        </label>
                        <select name="" id="" v-model="order.status"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option v-for="state in status" :value="state">{{ state }}</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Person
                        </label>
                        <select name="" id="" v-model="order.person_id"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option v-for="p in persons" :value="p.id">{{ p.name }} </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Comments
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            v-model="order.comments" type="email" placeholder="Comments">
                    </div>
                    <div class="flex items-center justify-between">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button" @click="buttonAddOrder">
                            {{ order.id == 0 ? 'Add' : 'Update' }}
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
import TableOrders from "../components/TableOrders.vue"
import { ref, onMounted, reactive } from "vue";
import OrderServices from "../services/OrderServices";
import PersonServices from "../services/PersonServices";
const status = [
    'not started',
    'in progress',
    'completed'
]
const persons = ref([])
const order = reactive({
    reference: '',
    date_to_complete_order: '',
    status: 'not started',
    comments: '',
    person_id: 0,
    id: 0
})

const header = ref([
    'Reference', 'Date to complete', 'Status', 'Comments', 'Person Name', 'Actions'
])

const getPersons = async () => {
    const response = await PersonServices.get()
    persons.value = response.persons

}
const orders = ref([])
const getOrders = async () => {
    const response = await OrderServices.get()
    console.log(response)
    orders.value = response.orders
}

const buttonAddOrder = async () => {
    if (order.id == 0) {
        const response = await OrderServices.store(order)
        if (response.success) {
            getOrders()
            reset()
        }
    } else {
        const response = await OrderServices.update(order)
        if (response.success) {
            getOrders()
            reset()
        }
    }
}

const fillFormToUpdate = async (o) => {
    order.reference = o.reference
    order.date_to_complete_order = o.date_to_complete_order
    order.status = o.status
    order.comments = o.comments
    order.person_id = o.person_id
    order.id = o.id
}

const deleteOrder = async (id) => {
    const response = await OrderServices.delete(id)
    if(response.success){
        getOrders()
        reset()
    }

}

const reset = async () => {
    order.reference = ''
    order.date_to_complete_order = ''
    order.status = 'not started'
    order.comments = ''
    order.person_id = 0
    order.id = 0
}

onMounted(() => {
    getOrders()
    getPersons()

})


</script>