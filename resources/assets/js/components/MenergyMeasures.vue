<template>
    <div>
        <menergy-form />
        <div class="tags has-addons">
            <a href="#" class="tag" :class="{ 'is-primary is-selected': viewMode === 'T' }" @click="toViewMode('T')">Tableau</a>
            <a href="#" class="tag" :class="{ 'is-primary is-selected': viewMode === 'G' }" @click="toViewMode('G')">Graphique</a>
        </div>
        <div v-show="viewMode === 'T'">
            <table class="table is-striped" v-if="measures.length">
                <thead>
                    <th>Date de la relève</th>
                    <th>Relève (en {{ type.unity }})</th>
                </thead>
                <tbody>
                    <tr v-for="measure in paginatedMeasures">
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
        <menergy-chart v-show="viewMode === 'G'"/>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import MenergyForm from './MenergyForm'
import MenergyChart from './MenergyChart'
import MenergyPagination from './MenergyPagination'

export default {
    components: {
        MenergyForm,
        MenergyChart,
        MenergyPagination
    },
    props: {
        type: { type: Object, required: true },
        itemsPerPage: { type: Number, default: 10 }
    },
    computed: {
        ...mapGetters({
            allMeasures: 'measuresByTypeOrdered'
        }),
        measures: function () {
            return this.allMeasures(this.type.id)
        },
        paginatedMeasures: function () {
            const offset = (this.currentPage - 1) * this.itemsPerPage
            return this.measures.slice(offset, offset + this.itemsPerPage)
        },
        nbPages: function () {
            return Math.ceil(this.measures.length / this.itemsPerPage)
        }
    },
    methods: {
        toPage: function () {
            this.currentPage = parseInt(this.$route.params.page)
        },
        toViewMode: function (viewMode) {
            this.viewMode = viewMode
        }
    },
    watch: {
        '$route': 'toPage'
    },
    beforeMount() {
        this.$store.dispatch('getMeasures', this.type.id)
    },
    data() {
        return {
            viewMode: 'T',
            currentPage: this.$route.params.page ? parseInt(this.$route.params.page) : 1
        }
    }
}
</script>
