<template>
    <div>
        <el-button type="primary" @click="showCreateForm">Criar Consulta</el-button>
        <div v-if="dataLoaded">
            <el-table :data="appointments">
                <el-table-column prop="patient_name" label="Paciente" />
                <el-table-column prop="doctor_name" label="Doutor" />
                <el-table-column prop="appointment_date" label="Data da Consulta" />
                <el-table-column prop="notes" label="Notas" />
                <el-table-column label="Ações">
                    <template v-slot="scope">
                        <el-button @click="editAppointment(scope.row)">Editar</el-button>
                        <el-button @click="deleteAppointment(scope.row)">Deletar</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
        <el-dialog title="Consulta" :model-value="dialogVisible" @close="handleDialogClose" width="30%">
            <appointment-form :appointment="currentAppointment" @saved="handleSaved" />
        </el-dialog>
    </div>
</template>

<script>
import AppointmentForm from './AppointmentForm.vue'
import apiClient from '../api/axios'

export default {
    components: {
        AppointmentForm,
    },
    data() {
        return {
            appointments: [],
            dialogVisible: false,
            currentAppointment: {},
            patients: [],
            doctors: [],
            dataLoaded: false,
        }
    },
    mounted() {
        this.fetchData()
    },
    methods: {

        fetchData() {
            this.dataLoaded = false
            Promise.all([this.fetchPatients(), this.fetchDoctors()]).then(() => {
                this.fetchAppointments().then(() => {
                    this.dataLoaded = true
                })
            })

        },
        async fetchPatients() {
            const response = await apiClient.get('/patients');
            if (response.data.success) {
                this.patients = response.data.data;
            }
        },
        async fetchDoctors() {
            const response = await apiClient.get('/doctors');
            if (response.data.success) {
                this.doctors = response.data.data;
            }
        },
        async fetchAppointments() {
            const response = await apiClient.get('/appointments');
            console.log(response.data)

            if (response.data) {
                this.appointments = response.data.map(appointment => {
                    console.log(appointment)
                    const patient = this.patients.find(p => p.id === appointment.patient_id);
                    const doctor = this.doctors.find(d => d.id === appointment.doctor_id);
                    return {
                        ...appointment,
                        patient_name: patient ? patient.name : 'N/A',
                        doctor_name: doctor ? doctor.name : 'N/A'
                    };
                });

            }
        },
        showCreateForm() {
            this.currentAppointment = {}
            this.dialogVisible = true
        },
        editAppointment(appointment) {
            this.currentAppointment = { ...appointment }
            this.dialogVisible = true
        },
        deleteAppointment(appointment) {
            apiClient.delete(`/appointments/${appointment.id}`).then(() => {
                this.fetchAppointments()
            })
        },
        handleSaved() {
            this.dialogVisible = false
            this.fetchAppointments()
        },
        handleDialogClose() {
            this.dialogVisible = false
        },
    },
}
</script>
