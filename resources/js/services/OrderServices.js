import { envirement } from "../config"
const OrderServices = {
    get: async function () {
        const response = await fetch(`${envirement.api_url}orders`)
        const responseJson = await response.json()
        return responseJson
    },
    store: async function (order) {
        try {
            const response = await fetch(`${envirement.api_url}orders`, {
                method: 'POST',
                body: JSON.stringify(order),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            const responseJson = await response.json()
            return responseJson
        } catch (e) {
            console.log(e)
        }
    },
    update: async function (order) {
        try {
            const response = await fetch(`${envirement.api_url}orders/${order.id}`, {
                method: 'PUT',
                body: JSON.stringify(order),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            const responseJson = await response.json()
            return responseJson
        } catch (e) {
            console.log(e)
        }
    },
    delete: async function (id) {
        try {
            const response = await fetch(`${envirement.api_url}orders/${id}`, {
                method: 'DELETE',
            })
            const responseJson = await response.json()
            return responseJson
        } catch (e) {
            console.log(e)
        }
    }
}

export default OrderServices
