<template>
    <div ref="refModal" class="modal fade" tabindex="-1" role="dialog" :class="{ 'show': showModal }" :style="{ display: showModal ? 'block' : 'none' }">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Reservation Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Your reservation form goes here -->
            <p>Selected Date: {{ selectedDate }}</p>
            
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
        type: String,
        required: true
    }
})

const refModal = ref()

const emit = defineEmits(['closeModal']);

function closeModal() {
  emit('closeModal');
}

</script>