<template>
<form v-if="!successRegistration" action="#" @submit.prevent="handleSubmit" method="post">
    <div class="row">
        <div class="col-md-12 mb-3">
            <h5>Funeral Reservation Form</h5>
            <div class="p-3 bg-body-secondary rounded">
                <small><i class="fa-solid fa-circle-info text-primary"></i> <strong>Event Reservations are closed on mondays.</strong> 
                </small>
            </div>

            <!-- {{ refFuneral }}
            {{ selectedDate }} -->
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" v-model="refFuneral.name" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.name ? systemStore.error.funeral.name[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" v-model="refFuneral.date" :min="getTodayDate()" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.date ? systemStore.error.funeral.date[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Time</label>
            <select name="time" id="time" v-model="refFuneral.time" class="form-control" required>
                <option disabled="" value="">Select here...</option>
                <option value="13:00">1:00PM</option>
                <option value="14:00">2:00PM</option>
                <option value="15:00">3:00PM</option>
            </select>
            <small>Available Time: 1:00PM, 2:00 PM, 3:00 PM</small><br>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.time ? systemStore.error.funeral.time[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Age</label>
            <input type="number" name="age" min="1" v-model="refFuneral.age" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.age ? systemStore.error.funeral.age[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Sex</label>
            <select name="sex" id="sex" v-model="refFuneral.sex" class="form-control" required>
                <option disabled="" value="">Select here...</option>
                <option>Male</option>
                <option>Female</option>
            </select>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.sex ? systemStore.error.funeral.sex[0] : '' }}</small>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Relationship</label>
            <select name="relationship" id="relationship" v-model="refFuneral.relationship" class="form-control" required>
                <option disabled="" value="">Select here...</option>
                <option>Grandmother</option>
                <option>Grandfather</option>
                <option>Mother</option>
                <option>Father</option>
                <option>Sibling</option>
                <option>Other</option>
            </select>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.relationship ? systemStore.error.funeral.relationship[0] : '' }}</small>
        </div>
        
        <div class="col-md-4 mb-3">
            <label class="form-label">&nbsp;</label>
            <input type="text" name="other_relationship" id="other_relationship" v-model="refFuneral.other_relationship" class="form-control" placeholder="Relationship Detail" :disabled="!isOtherSelected" :required="isOtherSelected">
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.other_relationship ? systemStore.error.funeral.other_relationship[0] : '' }}</small>
        </div>

        <div class="col-md-4 mb-3">

            <label class="form-label">Status</label>
            <select name="status" v-model="refFuneral.status" class="form-control" required>
                <option disabled="" value="">Select here...</option>
                <option>Single</option>
                <option>Married</option>
            </select>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.status ? systemStore.error.funeral.status[0] : '' }}</small>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" v-model="refFuneral.address" cols="30" rows="5"></textarea>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.address ? systemStore.error.funeral.address[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Date of Death</label>
            <input type="date" name="date_of_death" v-model="refFuneral.date_of_death" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.date_of_death ? systemStore.error.funeral.date_of_death[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Cause of Death</label>
            <input type="string" name="cause_of_death" v-model="refFuneral.cause_of_death" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.cause_of_death ? systemStore.error.funeral.cause_of_death[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Cemetery</label>
            <input type="text" name="cemetery" v-model="refFuneral.cemetery" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.cemetery ? systemStore.error.funeral.cemetery[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Funeraria</label>
            <input type="text" name="funeraria" v-model="refFuneral.funeraria" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.funeraria ? systemStore.error.funeral.funeraria[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Contact Person</label>
            <input type="text" name="contact_person" v-model="refFuneral.contact_person" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.contact_person ? systemStore.error.funeral.contact_person[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Contact Number</label>
            <input type="text" name="contact_number" v-model="refFuneral.contact_number" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.funeral && systemStore.error.funeral.contact_number ? systemStore.error.funeral.contact_number[0] : '' }}</small>
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

const model = 'funeral'
const systemStore = useSystemStore()
const successRegistration = ref(false)

const { selectedDate } = defineProps({
    selectedDate: String,
    required: true
})

const refFuneral = ref({
    date: '',
    time: '',
    name: '',
    age: '',
    sex: '',
    relationship: '',
    other_relationship: '',
    status: '',
    religion: '',
    address: '',
    date_of_death: '',
    cause_of_death: '',
    cemetery: '',
    funeraria: '',
    contact_person: '',
    contact_number: '',
})
const isOtherSelected = computed(() => refFuneral.value.relationship === 'Other');
const emits = defineEmits(['eventCreated'])

const handleSubmit = async () => {
    try {
        console.log(refFuneral.value)
        const response = await window.axios.post('/api/events/funerals', refFuneral.value)

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
    refFuneral.value.date = ''
    refFuneral.value.time = ''
    refFuneral.value.name = ''
    refFuneral.value.age = ''
    refFuneral.value.sex = ''
    refFuneral.value.relationship = ''
    refFuneral.value.other_relationship = ''
    refFuneral.value.status = ''
    refFuneral.value.religion = ''
    refFuneral.value.address = ''
    refFuneral.value.date_of_death = ''
    refFuneral.value.cause_of_death = ''
    refFuneral.value.cemetery = ''
    refFuneral.value.funeraria = ''
    refFuneral.value.contact_person = ''
    refFuneral.value.contact_number = ''
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
    refFuneral.value.date = selectedDate
})
</script>