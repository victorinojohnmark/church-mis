import './bootstrap';

import * as Popper from '@popperjs/core';
import { Calendar } from 'fullcalendar'

window.Popper = Popper;

// vue integration
import { createPinia } from 'pinia';
import { createApp } from 'vue';
import ReservationCalendar from './components/Reservations/ReservationCalendar.vue';
import  CommunionForm from './components/Reservations/Forms/CommunionForm.vue'; 

const pinia = createPinia();
const app = createApp({});

app.use(pinia);

app.component('reservation-calendar', ReservationCalendar);
app.component('communion-form', CommunionForm);


app.mount('#app');

