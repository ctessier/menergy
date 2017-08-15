<template>
    <div class="columns is-centered">
        <div class="column is-3">
            <div class="field">
                <p class="control">
                    <datepicker :class="{ 'is-danger': errors.date }" placeholder="Date" :config="{ dateFormat: 'd/m/Y', static: false }" v-model="date" @input="setDate"></datepicker>
                </p>
                <p class="help is-danger" v-for="error in errors.date">{{ error }}</p>
            </div>
        </div>
        <div class="column is-3">
            <div class="field">
                <p class="control">
                    <input type="text" :placeholder="'Relève (en ' + $parent.type.unity + ')'" class="input" :class="{ 'is-danger': errors.value }" v-model="value" />
                </p>
                <p class="help is-danger" v-for="error in errors.value">{{ error }}</p>
            </div>
        </div>
        <div class="column is-2">
            <a :class="['button', 'is-primary', { 'is-loading': isLoading } ]" :disabled="isLoading" @click="submitForm">Valider</a>
        </div>
    </div>
</template>

<script>

import Datepicker from 'vue-bulma-datepicker'

export default {
    components: {
        Datepicker
    },
    data() {
        return {
            isLoading: false,
            date: '',
            value: '',
            errors: {}
        };
    },
    methods: {
        submitForm() {
            this.isLoading = true;
            this.errors = {};
            axios.post('/measures', {
                'date': this.date,
                'value': this.value,
                'type_id': this.$parent.type.id
            })
            .then(response => {
                this.$emit('success', response.data);
                this.resetForm();
            })
            .catch(error => {
                this.isLoading = false;
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    console.error(error);
                }
            });
        },
        resetForm() {
            this.isLoading = false;
            this.date = '';
            this.value = '';
        },
        setDate(value) {
            this.date = value;
        }
    }
}
</script>
