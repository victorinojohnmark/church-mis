<template>
<form v-if="!successRegistration" action="#" @submit.prevent="handleSubmit" method="post">
    <div class="row">
        <div class="col-md-12 mb-3">
            <h5>Wedding Reservation Form</h5>
            <div class="p-3 bg-body-secondary rounded">
                <small><i class="fa-solid fa-circle-info text-primary"></i> <strong>Event Reservations are closed on mondays.</strong> 
                </small>
            </div>

            <!-- {{ refWedding }}
            {{ selectedDate }} -->
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Groom's Name</label>
            <input type="text" name="grooms_name" v-model="refWedding.grooms_name" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.wedding && systemStore.error.wedding.grooms_name ? systemStore.error.wedding.grooms_name[0] : '' }}</small>

        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Groom's Birth Date</label>
            <input type="date" name="grooms_birth_date" v-model="refWedding.grooms_birth_date" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.wedding && systemStore.error.wedding.grooms_birth_date ? systemStore.error.wedding.grooms_birth_date[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Bride's Name</label>
            <input type="text" name="brides_name" v-model="refWedding.brides_name" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.wedding && systemStore.error.wedding.brides_name ? systemStore.error.wedding.brides_name[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Bride's Birth Date</label>
            <input type="date" name="brides_birth_date" v-model="refWedding.brides_birth_date" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.wedding && systemStore.error.wedding.brides_birth_date ? systemStore.error.wedding.brides_birth_date[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Wedding Date</label>
            <input type="date" name="wedding_date" v-model="refWedding.wedding_date" :min="getTodayDate()" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.wedding && systemStore.error.wedding.wedding_date ? systemStore.error.wedding.wedding_date[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Time</label>
            <select name="time" id="time" class="form-control" v-model="refWedding.time">
                <option disabled="" value="">Select here...</option>
                <option value="07:30">7:30 AM</option>
                <option value="09:00">9:00 AM</option>
                <option value="10:30">10:30 AM</option>
                <option value="16:00">04:00 PM</option>
            </select>
            <small>Available Time: 7:30 AM, 9:00 AM, 10:30 AM and 4:00 PM</small><br>
            <small class="text-danger">{{ systemStore.error.wedding && systemStore.error.wedding.time ? systemStore.error.wedding.time[0] : '' }}</small>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label">Relationship</label>
            <select name="relationship" id="relationship" class="form-control" v-model="refWedding.relationship">
                <option disabled="" value="">Select here...</option>
                <option>Mother</option>
                <option>Father</option>
                <option>Partner</option>
                <option>Other</option>
            </select>
            <small class="text-danger">{{ systemStore.error.wedding && systemStore.error.wedding.relationship ? systemStore.error.wedding.relationship[0] : '' }}</small>
        </div>
        
        <div class="col-md-4 mb-3">
            <label class="form-label">&nbsp;</label>
            <input type="text" name="other_relationship" id="other_relationship" v-model="refWedding.other_relationship" class="form-control" placeholder="Relationship Detail" :disabled="!isOtherSelected" :required="isOtherSelected">
            <small class="text-danger">{{ systemStore.error.wedding && systemStore.error.wedding.other_relationship ? systemStore.error.wedding.other_relationship[0] : '' }}</small>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Contact Number</label>
            <input type="text" name="contact_number" v-model="refWedding.contact_number" class="form-control" placeholder="..." required>
            <small class="text-danger">{{ systemStore.error.wedding && systemStore.error.wedding.contact_number ? systemStore.error.wedding.contact_number[0] : '' }}</small>
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

const model = 'wedding'
const systemStore = useSystemStore()
const successRegistration = ref(false)

const { selectedDate } = defineProps({
    selectedDate: String,
    required: true
})

const refWedding = ref({
    grooms_name: '',
    grooms_birth_date: '',
    brides_name: '',
    brides_birth_date: '',
    relationship: '',
    other_relationship: '',
    wedding_date: '',
    time: '',
    contact_number: ''
})
const isOtherSelected = computed(() => refWedding.value.relationship === 'Other');
const emits = defineEmits(['eventCreated'])

const handleSubmit = async () => {
    try {
        console.log(refWedding.value)
        const response = await window.axios.post('/api/events/weddings', refWedding.value)

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
    refWedding.value.grooms_name = ''
    refWedding.value.grooms_birth_date = ''
    refWedding.value.brides_name = ''
    refWedding.value.brides_birth_date = ''
    refWedding.value.relationship = ''
    refWedding.value.other_relationship = ''
    refWedding.value.wedding_date = ''
    refWedding.value.time = ''
    refWedding.value.contact_number = ''
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
    refWedding.value.wedding_date = selectedDate
})
</script>