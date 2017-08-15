<template>
    <div v-show="this.isActive">
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
                :prev_page_url="data.prev_page_url"
                :next_page_url="data.next_page_url"
                :current_page="data.current_page"
                :nb_page="data.last_page"
                @changePage="changePage">
        </menergy-pagination>
    </div>
</template>

<script>

import MenergyForm from './MenergyForm.vue';
import MenergyPagination from './MenergyPagination.vue';

export default {
    components: {
        MenergyForm,
        MenergyPagination
    },
    props: {
        type: { type: Object, required: true },
        selected: { default: false }
    },
    data() {
        return {
            apiEndpoint: '/types/' + this.type.id,
            currentDataUrl: null,
            isActive: false,
            newItem: null,
            data: {},
            measures: []
        }
    },
    created() {
        this.isActive = this.selected;
        this.currentDataUrl = this.apiEndpoint;
        if (this.isActive) {
            this.fetchData();
        }
    },
    methods: {
        fetchData(newItem) {
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
        },
        changePage(params) {
            this.currentDataUrl = this.apiEndpoint + '?' + params;
            this.fetchData();
        }
    }
}
</script>
