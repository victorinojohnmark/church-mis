import axios from "axios";
// import { useSystemStore } from "../store/system";

// const systemStore = useSystemStore();

export default class ApiClient {
    
    // constructor() {
    //     systemStore.reset()
    // }

    async get(path, model) {
        try {
            const response = await window.axios.get(path, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
            });
            // systemStore.reset()
            return response.data;
            
        } catch (error) {
            console.log('Error occured: ', error)
        }
    }

    async post(path, body, model, method = null) {
        try {

            const formData = new FormData();
            let isMultipart = false;

            for (const key in body) {
                if (body[key] instanceof File || body[key] instanceof Blob) {
                    formData.append(key, body[key]);
                    isMultipart = true; // Set the flag to true if a file is found
                } else {
                    formData.append(key, body[key]);
                }

            }

            if(method !== null) {
                formData.append('_method', method);
            }

            const headers = {
                "Accept": "application/json"
            };
    
            if (isMultipart) {
                headers["Content-Type"] = "multipart/form-data";
            } else {
                headers["Content-Type"] = "application/json";
            }
            const data = await window.axios.post(path, formData, {
                headers: headers,
            });

            // systemStore.reset()
            return data;
            
        } catch (error) {
           console.log('Error occured: ', error)
        }
    }

    async patch(path, body, model) {
        
        try {

            const formData = new FormData();
            let isMultipart = false;

            for (const key in body) {
                if (body[key] instanceof File || body[key] instanceof Blob) {
                    
                    formData.append(key, body[key]);
                    isMultipart = true; // Set the flag to true if a file is found
                } else {
                    formData.append(key, body[key] === null ? null : body[key] );
                }

            }

            const headers = {
                "Accept": "application/json"
            };
    
            if (isMultipart) {
                headers["Content-Type"] = "multipart/form-data";
            } else {
                headers["Content-Type"] = "application/json";
            }

            // console.log(isMultipart);
            // console.log(headers);
            // console.log(body);

            // console.log(formData, headers)
            const data = await window.axios.patch(path, isMultipart ? formData : body, {
                headers: headers,
            });
            
            // systemStore.reset()
            return data;
        } catch (error) {
            console.log('Error occured: ', error)
        }
    }

    async delete(path, model) {
        
        try {

            const headers = {
                "Accept": "application/json"
            };

            const data = await window.axios.delete(path, {
                headers: headers,
            });
            
            // systemStore.reset()
            return data;
        } catch (error) {
            console.log('Error occured: ', error)
        }
    }

    // handleError(error, model) {
    //     // console.log(error)

        

    //     if(error.response.data.message) {
    //         systemStore.systemStatus = error.response.data.message
    //     } else {
    //         console.error('Something went wrong: '. error)
    //     }

    //     // if(error.response.status === 500) {
    //     //     console.error('Something went wrong with the backend server. Please contact the system administrator.')
    //     // } else if(error.response.status === 401) {
    //     //     authStore.handleLogout()
    //     // } else if(error.response.status === 400 || error.response.status === 403) {
    //     //     if(error.response.data.message) {
    //     //         toast.error(error.response.data.message)
    //     //     } else {
    //     //         toast.error(`Access denied on ${helper.camelCaseToTitleCase(model)} record/module. Please contact the system administrator.`)
    //     //     }
            
    //     // }
    //     // else {
    //     //     if(typeof error.response.statusText !== 'undefined') {
    //     //         toast.error(`Unexpected Error, ${error.response.statusText}`, { position: 'bottom-right' })
    //     //     }
    //     // }

    //     systemStore.error = { [model]: error.response.data.errors }

    //     return error
    // }

}