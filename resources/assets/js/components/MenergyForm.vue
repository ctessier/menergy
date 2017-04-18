<template>
    <div class="columns is-centered">
        <div class="column is-3">
            <div class="field">
                <p class="control">
                    <datepicker placeholder="Date" :config="{ dateFormat: 'd/m/Y', static: false }" @input="setDate"></datepicker>
                </p>
            </div>
        </div>
        <div class="column is-3">
            <div class="field">
                <p class="control">
                    <input type="text" :placeholder="'Relève (en ' + $parent.type.unity + ')'" class="input" v-model="value" />
                </p>
            </div>
        </div>
        <div class="column is-2">
            <a :class="['button', 'is-primary', { 'is-loading': isLoading } ]" @click="submitForm">Valider</a>
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
            date: '',
            value: '',
            isLoading: false
        };
    },
    methods: {
        submitForm() {
            this.isLoading = true;
            this.$emit('success', this.$data);
        },
        setDate(value) {
            this.date = value;
        }
    }
}
</script>
