<template>
    <div id="overlay" v-if="isLoading">
        <div class="spinner" />
    </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
    computed: {
        ...mapState([
            'isLoading'
        ])
    }
}
</script>
