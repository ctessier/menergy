<template>
    <div>
        <menergy-form />
        <table class="table is-striped" v-if="measures.length">
            <thead>
                <th>Date de la relève</th>
                <th>Relève (en {{ type.unity }})</th>
            </thead>
            <tbody>
                <tr v-for="measure in measures" :class="{ 'new': measure.is_new }">
                    <td>{{ measure.date | date }}</td>
                    <td>{{ measure.value }}</td>
                </tr>
            </tbody>
        </table>
        <menergy-pagination
            :baseUrl="$route.matched[0].path"
            :currentPage="currentPage"
            :nbPages="nbPages">
        </menergy-pagination>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import MenergyForm from './MenergyForm'
import MenergyPagination from './MenergyPagination'

export default {
    components: {
        MenergyForm,
        MenergyPagination
    },
    props: {
        type: { type: Object, required: true },
        itemsPerPage: { type: Number, default: 10 }
    },
    computed: {
        ...mapGetters([
            'measuresByType'
        ]),
        measures: function () {
            const offset = (this.currentPage - 1) * this.itemsPerPage
            return this.measuresByType(this.type.id).slice(offset, offset + this.itemsPerPage)
        },
        nbPages: function () {
            return Math.ceil(this.measuresByType(this.type.id).length / this.itemsPerPage)
        }
    },
    methods: {
        changePage: function () {
            this.currentPage = parseInt(this.$route.params.page)
        }
    },
    watch: {
        '$route': 'changePage'
    },
    beforeMount() {
        this.$store.dispatch('getMeasures', this.type.id)
    },
    data() {
        return {
            currentPage: this.$route.params.page ? parseInt(this.$route.params.page) : 1
        }
    }
}
</script>
