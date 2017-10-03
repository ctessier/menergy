<template>
    <div>
        <menergy-form @success="fetchData"></menergy-form>
        <chart :type="'line'" :data="computedChartData" :options="chartOptions"></chart>
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
import Chart from 'vue-bulma-chartjs'
import MenergyPagination from './MenergyPagination'

export default {
    components: {
        MenergyForm,
        Chart,
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
            measures: [],
            chartData: [],
            chartLabels: [],
            chartOptions: {
                legend: { display: false },
                animation: { duration: 0 },
                scales: {
                    xAxes: [{
                        type: 'time',
                        time: {
                            unit: 'month'
                        }
                    }]
                }
            },
            isLoading: false,
            isChartLoading: false
        }
    },
    created() {
        this.currentDataUrl = this.apiEndpoint + '?page=' + this.getPage();
        this.fetchData();
    },
    computed: {
        computedChartData() {
            return {
                labels: this.chartLabels,
                datasets: [{
                    fill: false,
                    lineTension: 0.25,
                    data: this.chartData,
                    label: '',
                    pointBackgroundColor: '#1fc8db',
                    pointBorderWidth: 1
                }]
            }
        }
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
            this.fetchMeasures(newItem);
            this.fetchChartData(newItem);
        },
        fetchMeasures(newItem) {
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
        },
        fetchChartData(newItem) {
            if (newItem !== undefined) {
                console.log(newItem);
                this.chartLabels.push(newItem.date);
                this.chartData.push(newItem.value);
                return;
            }

            let url = this.apiEndpoint + '/chart';
            this.isChartLoading = true;
            axios.get(url)
                .then(response => {
                    let dates = response.data.dates;
                    let measures = response.data.measures;
                    this.chartLabels.push(...dates);
                    this.chartData.push(...measures);
                    this.isChartLoading = false;
                })
                .catch(errors => {
                    alert('An error occurred. See logs');
                    console.error(errors);
                    this.isChartLoading = false;
                });
        }
    }
}
</script>
