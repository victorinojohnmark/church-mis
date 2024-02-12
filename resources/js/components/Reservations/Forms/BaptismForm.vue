<template>
<form action="#" @submit.prevent="handleSubmit" method="post">
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="p-3 bg-body-secondary rounded">
                <small><i class="fa-solid fa-circle-info text-primary"></i> <strong>Event Reservation is closed on mondays.</strong> Sundays at 10am for Regular reservation and Tuesday to Saturday 8-4pm for special schedules. 
                </small>
            </div>

            {{ refBaptism }}
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
            <input type="date" name="date" v-model="refBaptism.date" class="form-control" placeholder="..." required="">
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
</template>

<script setup>
import {ref, onMounted, computed} from 'vue'
import { useSystemStore } from '../../../store/system';;
import ApiClient from '../../../helper/api'

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const api = new ApiClient()
const model = 'baptism'
const systemStore = useSystemStore()

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

const handleSubmit = async () => {
    try {
        refBaptism.value.is_special = refBaptism.value.is_special ? 1 : 0
        const response = await window.axios.post('/api/events/baptisms', refBaptism.value)

        if(response) {
            console.log(response.data)
            systemStore.reset()
        }

    } catch (error) {
        handleError(error)
    }
}

const handleError = (error) => {
    if(error.response.data.message) {
        systemStore.systemStatus = error.response.data.message
    }

    console.error('Something went wrong: '. error)
    systemStore.error = { [model]: error.response.data.errors }

    return error
}

onMounted(() => {
    systemStore.reset()
})
</script>