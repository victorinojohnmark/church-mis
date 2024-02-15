<template>
<form v-if="!successRegistration" action="#" @submit.prevent="handleSubmit" method="post">
    <div class="row">
        <div class="col-md-12 mb-3">
            <h5>Baptism Reservation Form</h5>
            <div class="p-3 bg-body-secondary rounded">
                <small><i class="fa-solid fa-circle-info text-primary"></i> <strong>Event Reservation <area shape="poly" coords="" href="" alt=""> closed on mondays.</strong> <br>Sundays at 10am for Regular reservation and Tuesday to Saturday 8-4pm for special schedules. 
                </small>
            </div>
            <!-- 
            {{ refBaptism }}
            {{ selectedDate }} -->
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Name of the Baby</label>
            <input type="text" name="name" v-model="refBaptism.name" class="form-control" placeholder="..." required="">
            <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.name ? systemStore.error.baptism.name[0] : '' }}</small>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Sex</label>
            <select name="sex" v-model="refBaptism.sex" id="sex" class="form-control">
                <option disabled="" value="">Select here...</option>
                <option>Male</option>
                <option>Female</option>
            </select>
            <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.sex ? systemStore.error.baptism.sex[0] : '' }}</small>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Relationship</label>
            <select name="relationship" v-model="refBaptism.relationship" id="relationship" class="form-control">
                <option disabled="" value="">Select here...</option>
                <option>Grandmother</option>
                <option>Grandfather</option>
                <option>Mother</option>
                <option>Father</option>
                <option>Sibling</option>
                <option>Other</option>
            </select>
            <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.relationship ? systemStore.error.baptism.relationship[0] : '' }}</small>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">&nbsp;</label>
            <input type="text" name="other_relationship" v-model="refBaptism.other_relationship" id="other_relationship" class="form-control" placeholder="Relationship Detail" :disabled="!isOtherSelected" :required="isOtherSelected">
            <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.other_relationship ? systemStore.error.baptism.other_relationship[0] : '' }}</small>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Desired Date</label>
            <input type="date" name="date" ref="refDate" v-model="refBaptism.date" class="form-control" :min="getTodayDate()" placeholder="..." required="">
            <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.date ? systemStore.error.baptism.date[0] : '' }}</small>

        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Time</label>
            <input type="time" name="time" v-model="refBaptism.time" class="form-control" placeholder="..." required="">
            <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.time ? systemStore.error.baptism.time[0] : '' }}</small>
        </div>
        <div class="col-md-12 mb-3"><label class="form-label">Place of Birth</label>
            <textarea name="place_of_birth" v-model="refBaptism.place_of_birth" class="form-control" cols="30" rows="2"></textarea>
            <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.place_of_birth ? systemStore.error.baptism.place_of_birth[0] : '' }}</small>

        </div>
        <div class="col-md-12 mb-3">
            <div class="form-group form-check">
                <input type="checkbox" name="is_special" v-model="refBaptism.is_special" class="form-check-input">
                <label class="form-check-label">Special Schedule</label>
                <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.is_special ? systemStore.error.baptism.is_special[0] : '' }}</small>

            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Birth Date</label>
            <input type="date" name="birth_date" v-model="refBaptism.birth_date" class="form-control" placeholder="..." required="">
            <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.birth_date ? systemStore.error.baptism.birth_date[0] : '' }}</small>

        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Father's Name</label>
            <input type="text" name="fathers_name" v-model="refBaptism.fathers_name" class="form-control" placeholder="..." required="">
            <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.fathers_name ? systemStore.error.baptism.fathers_name[0] : '' }}</small>

        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Mother's Name</label>
            <input type="text" name="mothers_name" v-model="refBaptism.mothers_name" class="form-control" placeholder="..." required="">
            <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.mothers_name ? systemStore.error.baptism.mothers_name[0] : '' }}</small>

        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Contact #</label>
            <input type="text" name="contact_number" v-model="refBaptism.contact_number" class="form-control" placeholder="..." required="">
            <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.contact_number ? systemStore.error.baptism.contact_number[0] : '' }}</small>

        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Present Address</label>
            <textarea name="present_address" v-model="refBaptism.present_address" class="form-control" cols="30" rows="2"></textarea>
            <small class="text-danger">{{ systemStore.error.baptism && systemStore.error.baptism.present_address ? systemStore.error.baptism.present_address[0] : '' }}</small>

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
import ApiClient from '../../../helper/api'

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const api = new ApiClient()
const model = 'baptism'
const systemStore = useSystemStore()
const successRegistration = ref(false)

const { selectedDate } = defineProps({
    selectedDate: String,
    required: true
})

const refBaptism = ref({
    name: '',
    sex: '',
    relationship: '',
    other_relationship: null,
    date: '',
    time: '',
    place_of_birth: '',
    is_special: false,
    birth_date: '',
    fathers_name: '',
    mothers_name: '',
    contact_number: '',
    present_address: ''
})

const isOtherSelected = computed(() => refBaptism.value.relationship === 'Other');

const emits = defineEmits(['eventCreated'])

const handleSubmit = async () => {
    // set static values
    refBaptism.value.is_special = refBaptism.value.is_special ? true : false

    try {
        console.log(refBaptism.value)
        const response = await window.axios.post('/api/events/baptisms', refBaptism.value)

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
    refBaptism.value.name = ''
    refBaptism.value.sex = ''
    refBaptism.value.relationship = ''
    refBaptism.value.other_relationship = null
    refBaptism.value.date = ''
    refBaptism.value.time = ''
    refBaptism.value.place_of_birth = ''
    refBaptism.value.is_special = false
    refBaptism.value.birth_date = ''
    refBaptism.value.fathers_name = ''
    refBaptism.value.mothers_name = ''
    refBaptism.value.contact_number = ''
    refBaptism.value.present_address = ''
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

const handleDateChange = (e) => {
    refBaptism.value.date = e.target.value
    refDate.value.value = e.target.value
    console.log(refDate.value)
}



onBeforeMount(() => {
    systemStore.reset()
    refBaptism.value.date = selectedDate
})
</script>