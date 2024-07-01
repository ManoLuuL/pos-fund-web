import { createRouter, createWebHistory } from 'vue-router'
import PatientsView from './views/PatientView.vue'
import AppointmentsView from './views/AppointmentView.vue'

const routes = [
  { path: '/', component: PatientsView },
  { path: '/appointments', component: AppointmentsView },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
