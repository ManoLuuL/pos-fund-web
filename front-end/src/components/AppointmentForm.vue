<template>
    <el-form :model="form" @submit.native.prevent="handleSubmit">
        <el-form-item label="Paciente">
            <el-select v-model="form.patient_id" placeholder="Selecione o Paciente">
                <el-option v-for="patient in patients" :key="patient.id" :label="patient.name" :value="patient.id" />
            </el-select>
        </el-form-item>
        <el-form-item label="Doutor">
            <el-select v-model="form.doctor_id" placeholder="Selecione o Doutor">
                <el-option v-for="doctor in doctors" :key="doctor.id" :label="doctor.name" :value="doctor.id" />
            </el-select>
        </el-form-item>
        <el-form-item label="Data da Consulta">
            <el-date-picker v-model="form.appointment_date" type="date" format="YYYY-MM-DD" value-format="YYYY-MM-DD" />
        </el-form-item>
        <el-form-item label="Notas">
            <el-input type="textarea" v-model="form.notes" />
        </el-form-item>
        <el-button type="primary" native-type="submit">Salvar</el-button>
    </el-form>
</template>

<script>
import apiClient from '../api/axios'

export default {
    props: {
        appointment: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            form: {
                patient_id: this.appointment.patient_id || '',
                doctor_id: this.appointment.doctor_id || '',
                appointment_date: this.appointment.appointment_date || '',
                notes: this.appointment.notes || '',
            },
            patients: [],
            doctors: [],
        }
    },
    mounted() {
        this.fetchPatients()
        this.fetchDoctors()
    },
    watch: {
        appointment(newVal) {
            this.form = { ...newVal }
        }
    },
    methods: {
        fetchPatients() {
            apiClient.get('/patients').then((response) => {
                if (response.data.success) {
                    this.patients = response.data.data
                }
            })
        },
        fetchDoctors() {
            apiClient.get('/doctors').then((response) => {
                if (response.data.success) {
                    this.doctors = response.data.data
                }
            })
        },
        formatDate(date) {
            if (!date) return ''
            const d = new Date(date)
            let month = '' + (d.getMonth() + 1)
            let day = '' + d.getDate()
            const year = d.getFullYear()

            if (month.length < 2) month = '0' + month
            if (day.length < 2) day = '0' + day

            return [year, month, day].join('-')
        },
        handleSubmit() {
            const payload = {
                ...this.form,
                appointment_date: this.formatDate(this.form.appointment_date)
            }

            if (this.appointment.id) {
                apiClient.put(`/appointments/${this.appointment.id}`, payload).then(() => {
                    this.$emit('saved')
                })
            } else {
                apiClient.post('/appointments', payload).then(() => {
                    this.$emit('saved')
                })
            }
        },
    },
}
</script>
