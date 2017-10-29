<template>
    <chart :type="'line'" :data="chartData" :options="chartOptions" />
</template>

<script>
import { mapGetters } from 'vuex'
import Chart from 'vue-bulma-chartjs'
import moment from 'moment'

export default {
    components: {
        Chart
    },
    computed: {
        ...mapGetters({
            allMeasures: 'measuresByTypeOrdered'
        }),
        chartLabels: function () {
            return this.allMeasures(this.$parent.type.id, 'ASC').map(measure => {
                return measure.date
            })
        },
        chartValues: function () {
            return this.allMeasures(this.$parent.type.id, 'ASC').map(measure => {
                return measure.value
            })
        },
        chartData: function () {
            return {
                labels: this.chartLabels,
                datasets: [{
                    fill: false,
                    borderColor: '#00d1b2',
                    label: this.$parent.type.name,
                    data: this.chartValues
                }]
            }
        },
        chartOptions: function () {
            return this.options
        }
    },
    data() {
        return {
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        type: "time",
                        time: {
                            unit: 'month',
                            displayFormats: {
                                month: 'MMM YYYY'
                            },
                            tooltipFormat: 'DD/MM/YYYY',
                            parser: (value) => {
                                return moment(value)
                            }
                        },
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: true
                        }
                    }]
                }
            }
        }
    }
}
</script>
