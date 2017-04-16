<template>
    <div class="columns is-centered">
        <div class="column is-3">
            <div class="field">
                <p class="control">
                    <singledatepicker></singledatepicker>
                </p>
            </div>
        </div>
        <div class="column is-3">
            <div class="field">
                <p class="control">
                    <input type="text" placeholder="Relève" class="input" />
                </p>
            </div>
        </div>
        <div class="column is-2">
            <a class="button is-primary">Valider</a>
        </div>
    </div>
</template>

<script>
import singledatepicker from './SingleDatePicker.vue';

export default {
    components: {
        singledatepicker
    }
}
</script>


