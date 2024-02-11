<template>
    <div ref="refModal" class="modal fade" tabindex="-1" role="dialog" :class="{ 'show': showModal }" :style="{ display: showModal ? 'block' : 'none' }">
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
            <!-- <p>Selected Date: {{ selectedDate }}</p>
            <input type="date" class="form-control" name="date" :value="selectedDate" readonly> -->

            <div class="d-flex gap-1 items-center">
              <button type="button" class="btn btn-sm btn-danger">Baptism</button>
              <button type="button" class="btn btn-sm btn-success">Blessing</button>
              <button type="button" class="btn btn-sm btn-primary">Communion</button>
              <button type="button" class="btn btn-sm btn-warning">Confirmation</button>
              <button type="button" class="btn btn-sm btn-secondary">Funeral</button>
              <button type="button" class="btn btn-sm btn-info">Wedding</button>
            </div>



          </div>
        </div>
      </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const { showModal, selectedDate } = defineProps({
    showModal: {
        type: Boolean,
        default: false
    },
    selectedDate: {
        type: String
    }
})

const refModal = ref()

const emit = defineEmits(['closeModal']);

function closeModal() {
  emit('closeModal');
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