<template>
    <el-form :model="form" @submit.native.prevent="handleSubmit">
        <el-form-item label="Nome">
            <el-input v-model="form.name" />
        </el-form-item>
        <el-form-item label="Email">
            <el-input v-model="form.email" />
        </el-form-item>
        <el-form-item label="Data de Aniversário">
            <el-date-picker v-model="form.birth_date" type="date" />
        </el-form-item>
        <el-button type="primary" native-type="submit">Salvar</el-button>
    </el-form>
</template>

<script>
import apiClient from '../api/axios'

export default {
    props: {
        patient: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            form: {
                name: this.patient.name || '',
                email: this.patient.email || '',
                birth_date: this.patient.birth_date || '',
            },
        }
    },
    watch: {
        patient(newVal) {
            this.form = { ...newVal }
        }
    },
    methods: {
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
                birth_date: this.formatDate(this.form.birth_date)
            }

            if (this.patient.id) {
                apiClient.put(`/patients/${this.patient.id}`, payload).then(() => {
                    this.$emit('saved')
                })
            } else {
                apiClient.post('/patients', payload).then(() => {
                    this.$emit('saved')
                })
            }
        },
    },
}
</script>