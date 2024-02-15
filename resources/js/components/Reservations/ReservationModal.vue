<template>
    <div class="modal fade" tabindex="-1" role="dialog" :class="{ 'show': showModal }" :style="{ display: showModal ? 'block' : 'none' }">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Reservation Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Your reservation form goes here -->
            <!-- <p>Selected Date: {{ selectedDate }}</p> -->
            <!-- <input type="date" class="form-control" name="date" :value="selectedDate" readonly> -->

            <div class="d-flex gap-1 items-center mb-3">
              <button type="button" class="btn btn-sm btn-danger" @click="showForm('baptism')">Baptism</button>
              <button type="button" class="btn btn-sm btn-success" @click="showForm('blessing')">Blessing</button>
              <!-- <button type="button" class="btn btn-sm btn-primary" @click="showForm('communion')">Communion</button> -->
              <!-- <button type="button" class="btn btn-sm btn-warning" @click="showForm('confirmation')">Confirmation</button> -->
              <button type="button" class="btn btn-sm btn-secondary" @click="showForm('funeral')">Funeral</button>
              <button type="button" class="btn btn-sm btn-info" @click="showForm('wedding')">Wedding</button>
            </div>

            <!-- Conditional rendering of forms -->
            <div v-if="currentForm === 'baptism'" ><BaptismForm :selected-date="selectedDate" @event-created="handleReservationCreated" /></div>
            <div v-if="currentForm === 'blessing'"><BlessingForm :selected-date="selectedDate" @event-created="handleReservationCreated" /></div>
            <!-- <div v-if="currentForm === 'communion'">Communion Form</div> -->
            <!-- <div v-if="currentForm === 'confirmation'">Confirmation Form</div> -->
            <div v-if="currentForm === 'funeral'"><FuneralForm :selected-date="selectedDate" @event-created="handleReservationCreated" /></div>
            <div v-if="currentForm === 'wedding'"><WeddingForm :selected-date="selectedDate" @event-created="handleReservationCreated" /></div>


          </div>
        </div>
      </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import BaptismForm from './Forms/BaptismForm.vue'
import BlessingForm from './Forms/BlessingForm.vue'
import WeddingForm from './Forms/WeddingForm.vue'
import FuneralForm from './Forms/FuneralForm.vue'

const { showModal, selectedDate } = defineProps({
    showModal: {
        type: Boolean,
        default: false
    },
    selectedDate: {
        type: String
    }
})

const currentForm = ref('baptism');

const showForm = (form) => {
  currentForm.value = form
}

const emit = defineEmits(['closeModal']);

function closeModal() {
  emit('closeModal');
}

const handleReservationCreated = () => {
  closeModal();
}

</script>

<style scoped>
button.close {
    padding: 0;
    background-color: transparent;
    border: 0;
}
.close {
    float: right;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
}
</style>