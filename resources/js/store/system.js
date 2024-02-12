import { defineStore } from "pinia"

export const useSystemStore = defineStore('system', {
    persist: true,
    state: () => ({
        systemStatus: null,
        error: []
    }),
    getters: {
        errors: (state) => state.error,
        status: (state) => state.systemStatus,
    },
    actions: {
        reset() {
            this.error = []
            this.systemStatus = []
        },
        resetError(model = '') {
            if(model.length > 0) {
                this.error = []
            } else {
                error[model] ? delete error[model] : null
            }
        },
    }
})