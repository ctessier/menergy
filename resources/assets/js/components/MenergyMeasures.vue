<template>
    <div>
        <menergy-form @success="fetchData"></menergy-form>
        <table class="table is-striped">
            <thead>
                <th>Date de la relève</th>
                <th>Relève (en {{ type.unity }})</th>
            </thead>
            <tbody>
                <tr v-for="measure in measures" :class="{ new: newItem && measure.id === newItem.id }">
                    <td>{{ measure.date }}</td>
                    <td>{{ measure.value }}</td>
                </tr>
            </tbody>
        </table>

        <menergy-pagination
                :base_url="$route.matched[0].path"
                :current_page="data.current_page"
                :nb_page="data.last_page">
        </menergy-pagination>
    </div>
</template>

<script>

import MenergyForm from './MenergyForm'
import MenergyPagination from './MenergyPagination'

export default {
    components: {
        MenergyForm,
        MenergyPagination
    },
    props: {
        type: { type: Object, required: true }
    },
    data() {
        return {
            apiEndpoint: '/types/' + this.type.id,
            currentDataUrl: null,
            newItem: null,
            data: {},
            measures: []
        }
    },
    created() {
        this.currentDataUrl = this.apiEndpoint + '?page=' + this.getPage();
        this.fetchData();
    },
    watch: {
        // call again the method if the route changes
        '$route': 'fetchData'
    },
    methods: {
        getPage() {
            return this.$route.params.page ? this.$route.params.page : 1;
        },
        fetchData(newItem) {
            this.currentDataUrl = this.apiEndpoint + '?page=' + this.getPage();
            axios.get(this.currentDataUrl)
                .then(response => {
                    this.data = response.data;
                    this.measures = this.data.data;
                    if (newItem !== undefined) {
                        this.newItem = newItem;
                    }
                })
                .catch(errors => {
                    alert('An error occurred. See logs');
                    console.error(errors);
                });
        }
    }
}
</script>
