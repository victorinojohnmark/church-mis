import { computed, ref } from "vue";
import ApiClient from "../helper/api";
import { useSystemStore } from "../store/system";

const api = new ApiClient()
const systemStore = useSystemStore()
const model = 'baptism'

export default function useBaptisms() {
    const errors = ref([])

    const createBaptism = async (data) => {
        try {
          const response = await api.post('/api/baptisms', data, model)
          if(response) {
            return response.data
          }
          
        } catch (error) {
            handleError(error, model)
        }
    };

    const handleError = (error, model) => {
        if(error.response.data.message) {
            systemStore.systemStatus = error.response.data.message
        }

        console.error('Something went wrong: '. error)
        systemStore.error = { [model]: error.response.data.errors }

        return error
    }

    return {
        createBaptism
    }
}