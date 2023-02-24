import { envirement } from "../config"
const PersonServices = {
    get: async function () {
        const response = await fetch(`${envirement.api_url}persons`)
        const responseJson = await response.json()
        return responseJson
    },
    store: async function (person) {
        try {
            const response = await fetch(`${envirement.api_url}persons`, {
                method: 'POST',
                body: JSON.stringify(person),
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
            const response = await fetch(`${envirement.api_url}persons/${id}`, {
                method: 'DELETE',

            })
            const responseJson = await response.json()
            return responseJson
        } catch (e) {
            console.log(e)
        }
    },
    update: async function (person) {
        try {
            const response = await fetch(`${envirement.api_url}persons/${person.id}`, {
                method: 'PUT',
                body: JSON.stringify(person),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            const responseJson = await response.json()
            return responseJson
        } catch (e) {
            console.log(e)
        }
    }

}
export default PersonServices
