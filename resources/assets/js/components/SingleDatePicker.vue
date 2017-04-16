<template>
  <datepicker placeholder="Date" :config="{ dateFormat: 'd/m/Y', static: false }"></datepicker>
</template>

<script>
import Datepicker from 'vue-bulma-datepicker'

export default {
    components: {
        Datepicker
    }
}
</script>
