<template>
    <div>
        <el-button type="primary" @click="showCreateForm">Criar Paciente</el-button>
        <el-table :data="patients">
            <el-table-column prop="name" label="Nome" />
            <el-table-column prop="email" label="Email" />
            <el-table-column prop="birth_date" label="Data de Aniversário" />
            <el-table-column label="Ações">
                <template v-slot="scope">
                    <el-button @click="editPatient(scope.row)">Editar</el-button>
                    <el-button @click="deletePatient(scope.row)">Deletar</el-button>
                </template>
            </el-table-column>
        </el-table>

        <el-dialog title="Paciente" :model-value="dialogVisible" @close="handleDialogClose" width="30%">
            <patient-form :patient="currentPatient" @saved="handleSaved" />
        </el-dialog>
    </div>
</template>

<script>
import PatientForm from './PatientForm.vue'
import apiClient from '../api/axios'

export default {
    components: {
        PatientForm,
    },
    data() {
        return {
            patients: [],
            dialogVisible: false,
            currentPatient: {},
        }
    },
    mounted() {
        this.fetchPatients()
    },
    methods: {
        fetchPatients() {
            apiClient.get('/patients').then((response) => {
                if (response.data.success) {
                    this.patients = response.data.data
                }
            })
        },
        showCreateForm() {
            this.currentPatient = {}
            this.dialogVisible = true
        },
        editPatient(patient) {
            this.currentPatient = { ...patient }
            this.dialogVisible = true
        },
        deletePatient(patient) {
            apiClient.delete(`/patients/${patient.id}`).then(() => {
                this.fetchPatients()
            })
        },
        handleSaved() {
            this.dialogVisible = false
            this.fetchPatients()
        },
        handleDialogClose() {
            this.dialogVisible = false
        },
    },
}
</script>
