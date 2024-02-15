<template>
<form v-if="!successRegistration" action="#" @submit.prevent="handleSubmit" method="post">
    <div class="row">
        <div class="col-md-12 mb-3">
            <h5>Blessing Reservation Form</h5>
            <div class="p-3 bg-body-secondary rounded">
                <small><i class="fa-solid fa-circle-info text-primary"></i> <strong>Event Reservations are closed on mondays.</strong> 
                </small>
            </div>

            <!-- {{ refBlessing }}
            {{ selectedDate }} -->
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Type</label>
            <select name="blessing_type" v-model="refBlessing.blessing_type" class="form-control" required>
                <option disabled="" value="">Select here...</option>
                <option>House</option>
                <option>Business</option>
            </select>
            <small class="text-danger">{{ systemStore.error.blessing && systemStore.error.blessing.blessing_type ? systemStore.error.blessing.blessing_type[0] : '' }}</small>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" v-model="refBlessing.name" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.blessing && systemStore.error.blessing.name ? systemStore.error.blessing.name[0] : '' }}</small>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" v-model="refBlessing.date" class="form-control" :min="getTodayDate()" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.blessing && systemStore.error.blessing.date ? systemStore.error.blessing.date[0] : '' }}</small>

        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Time</label>
            <input type="time" name="time" v-model="refBlessing.time" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.blessing && systemStore.error.blessing.time ? systemStore.error.blessing.time[0] : '' }}</small>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" cols="30" rows="5" v-model="refBlessing.address" required></textarea>
            <small class="text-danger">{{ systemStore.error.blessing && systemStore.error.blessing.address ? systemStore.error.blessing.address[0] : '' }}</small>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Landmark</label>
            <input type="text" name="landmark" v-model="refBlessing.landmark" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.blessing && systemStore.error.blessing.landmark ? systemStore.error.blessing.landmark[0] : '' }}</small>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Contact Number</label>
            <input type="text" name="contact_number" v-model="refBlessing.contact_number" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.blessing && systemStore.error.blessing.contact_number ? systemStore.error.blessing.contact_number[0] : '' }}</small>

        </div>
    </div> 
    <button type="submit" class="btn btn-primary mb-3">Submit</button>
</form>

<div v-if="successRegistration">
    <div class="row">
        <div class="col-md-12 d-flex flex-column align-items-center gap-2 my-5">
            <i class="far fa-check-circle display-1 text-success"></i>
            <strong>Reservation submitted successfully</strong>
            <small>You'll get notified once your reservation is approved.</small>
        </div>
    </div>
</div>
</template>

<script setup>
import {ref, onBeforeMount, computed, watch} from 'vue'
import { useSystemStore } from '../../../store/system';;

const model = 'blessing'
const systemStore = useSystemStore()
const successRegistration = ref(false)

const { selectedDate } = defineProps({
    selectedDate: String,
    required: true
})

const refBlessing = ref({
    name: '',
    blessing_type: '',
    date: '',
    time: '',
    address: '',
    landmark: '',
    contact_number: ''
})

const emits = defineEmits(['eventCreated'])

const handleSubmit = async () => {
    try {
        console.log(refBlessing.value)
        const response = await window.axios.post('/api/events/blessings', refBlessing.value)

        if(response) {
            console.log(response.data)
            successRegistration.value = true
            systemStore.reset()
            resetValues().then(() => {
                setTimeout(() => {
                    successRegistration.value = false
                    emits('eventCreated')
                }, 10000);
            })
        }

    } catch (error) {
        handleError(error)
    }
}

const resetValues = async () => {
    refBlessing.value.name = '',
    refBlessing.value.blessing_type = '',
    refBlessing.value.date = '',
    refBlessing.value.time = '',
    refBlessing.value.address = '',
    refBlessing.value.landmark = '',
    refBlessing.value.contact_number = ''
}

const handleError = (error) => {
    if(error.response.data.message) {
        systemStore.systemStatus = error.response.data.message
    }

    console.error('Something went wrong: '. error)
    systemStore.error = { [model]: error.response.data.errors }

    return error
}

const getTodayDate = () => {
    const today = new Date();
    const year = today.getFullYear();
    let month = today.getMonth() + 1;
    let day = today.getDate();

    // Adding leading zero for months/days less than 10
    if (month < 10) {
        month = '0' + month;
    }
    if (day < 10) {
        day = '0' + day;
    }

    return `${year}-${month}-${day}`;
}

onBeforeMount(() => {
    systemStore.reset()
    refBlessing.value.date = selectedDate
})
</script>