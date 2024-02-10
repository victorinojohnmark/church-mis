import './bootstrap';

import * as Popper from '@popperjs/core';
import { Calendar } from 'fullcalendar'
window.Popper = Popper;

// vue integration
import { createApp } from 'vue';
import ReservationCalendar from './components/Reservations/ReservationCalendar.vue';

const app = createApp({});

app.component('reservation-calendar', ReservationCalendar);


app.mount('#app');

