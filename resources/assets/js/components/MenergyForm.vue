<template>
    <div class="columns is-centered">
        <div class="column is-3">
            <div class="field">
                <p class="control">
                    <datepicker :class="{ 'is-danger': errors.date }" placeholder="Date de la relève" :config="{ dateFormat: 'd/m/Y', static: false }" v-model="date" @input="setDate"></datepicker>
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
            <a :class="['button', 'is-primary', { 'is-loading': isLoading } ]" :disabled="isDisabled" @click="submit">Ajouter</a>
        </div>
    </div>
</template>

<script>

import Datepicker from 'vue-bulma-datepicker'
import { mapState } from 'vuex'

export default {
    components: {
        Datepicker
    },
    methods: {
        submit() {
            this.isLoading = true
            this.errors = {}
            const data = {
                type_id: this.$parent.type.id,
                date: this.date,
                value: this.value
            }
            this.$store.dispatch('postMeasure', data)
                .then(res => {
                    this.resetForm()
                }).catch(errors => {
                    this.isLoading = false
                    this.errors = errors
                })
        },
        resetForm() {
            this.isLoading = false;
            this.date = '';
            this.value = '';
        },
        setDate(value) {
            this.date = value;
        }
    },
    computed: {
        isDisabled: function () {
            return this.isLoading || this.date === '' || this.value === ''
        }
    },
    data() {
        return {
            isLoading: false,
            date: '',
            value: '',
            errors: {}
        };
    }
}
</script>
