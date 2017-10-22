<template>
    <article class="message is-danger" v-if="error">
        <div class="message-header">
            <p>Whoops</p>
            <button class="delete" aria-label="delete" @click="dismiss"></button>
        </div>
        <div class="message-body">{{ error }}</div>
    </article>
</template>

<script>
import { mapState } from 'vuex'
import { SET_ERROR } from '../store/mutation-types'

export default {
    computed: {
        ...mapState([
            'error'
        ])
    },
    methods: {
        dismiss: function () {
            this.$store.commit(SET_ERROR, null)
        }
    }
}
</script>
