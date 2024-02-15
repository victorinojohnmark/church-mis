<template>
  <div>
    <FullCalendar id="calendar" ref="refCalendar" :options="calendarOptions"></FullCalendar>
    <ReservationModal v-if="selectedDate" :selectedDate="selectedDate" :showModal="showReservationModal" @closeModal="handleCloseModal" />
    <input type="date" :value="selectedDate" >
    
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import ReservationModal from './ReservationModal.vue';

const refCalendar = ref(null);
const showReservationModal = ref(false)

const selectedDate = ref(null);

const handleDateSelect = async (selectInfo) => {
  showReservationModal.value = true
}

const handleCloseModal = () => { 
  showReservationModal.value = false
  selectedDate.value = null
}



const calendarOptions = ref({
    plugins: [ dayGridPlugin, interactionPlugin ],
    initialView: 'dayGridMonth',
    events: [],
    
    datesSet: async function (arg) {
      try {
        const response = await axios.get('/calendar', {
          params: {
            start: arg.startStr,
            end: arg.endStr
          }
        });
        // Ensure response.data is used to get the actual events array
        calendarOptions.value.events = response.data;
      } catch (error) {
        console.error('Error fetching events', error);
      }
    },
    eventTimeFormat: { // like '14:30:00'
        hour: '2-digit',
        minute: '2-digit',
        meridiem: true
    },
    dayMaxEventRows: true, // for all non-TimeGrid views
    // views: {
    //     timeGrid: {
    //     dayMaxEventRows: 3 // adjust to 3 only for timeGridWeek/timeGridDay
    //     }
    // },
    selectAllow: function (arg) {
      const today = new Date().toISOString().slice(0, 10); // Current date in ISO format
      const selectedDate = arg.startStr.slice(0, 10); // Selected date in ISO format
      
      // Compare selected date with today's date
      return selectedDate >= today;
    },
    selectable: true,
    // select: handleDateSelect,
    select: function (arg) {
      selectedDate.value = arg.startStr;
        if (arg.start && arg.end) {
          handleDateSelect(arg);
        } else {
          handleDateSelect(arg);
        }
    },
});





</script>

<style scoped>
/* Custom styling for modal */
.modal {
  display: none;
  background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
}

.fc-daygrid-event {
    display: flex;
    flex-wrap: wrap;
    font-size: 8.5px;
}

.fc-daygrid-event .fc-event-title {
    white-space: normal !important;
    /* display: block; */
    /* background-color: red !important; */
}

#calendar a {
    text-decoration: none;
    color: inherit;
}
</style>