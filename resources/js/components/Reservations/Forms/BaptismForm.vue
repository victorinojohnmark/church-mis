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
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Sex</label>
            <select name="sex" v-model="refBaptism.sex" id="sex" class="form-control">
                <option disabled="" value="">Select here...</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Relationship</label>
            <select name="relationship" v-model="refBaptism.relationship" id="relationship" class="form-control" onchange="toggleRelationshipDetail()">
                <option disabled="" value="">Select here...</option>
                <option>Grandmother</option>
                <option>Grandfather</option>
                <option>Mother</option>
                <option>Father</option>
                <option>Sibling</option>
                <option>Other</option>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">&nbsp;</label>
            <input type="text" name="other_relationship" v-model="refBaptism.other_relationship" id="other_relationship" class="form-control" placeholder="Relationship Detail" disabled="">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Desired Date</label>
            <input type="date" name="date" v-model="refBaptism.date" class="form-control" placeholder="..." required="">
            </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Time</label>
            <input type="time" name="time" v-model="refBaptism.time" class="form-control" placeholder="..." required="">
        </div>
        <div class="col-md-12 mb-3"><label class="form-label">Place of Birth</label>
            <textarea name="place_of_birth" v-model="refBaptism.place_of_birth" class="form-control" cols="30" rows="2"></textarea>
        </div>
        <div class="col-md-12 mb-3">
            <div class="form-group form-check">
                <input type="checkbox" name="is_special" v-model="refBaptism.is_special" class="form-check-input">
                <label class="form-check-label">Special Schedule</label>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Birth Date</label>
            <input type="date" name="birth_date" v-model="refBaptism.birth_date" class="form-control" placeholder="..." required="">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Father's Name</label>
            <input type="text" name="fathers_name" v-model="refBaptism.fathers_name" class="form-control" placeholder="..." required="">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Mother's Name</label>
            <input type="text" name="mothers_name" v-model="refBaptism.mothers_name" class="form-control" placeholder="..." required="">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Contact #</label>
            <input type="text" name="contact_number" v-model="refBaptism.contact_number" class="form-control" placeholder="..." required="">
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label">Present Address</label>
            <textarea name="present_address" v-model="refBaptism.present_address" class="form-control" cols="30" rows="2"></textarea>
        </div>
    </div> 
    <button type="submit" class="btn btn-primary mb-3">Submit</button>
</form>
</template>

<script setup>
import {ref} from 'vue'

const refBaptism = ref({
    name: '',
    sex: '',
    relationship: '',
    other_relationship: '',
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

const handleSubmit = async () => {

}
</script>