import Router from 'vue-router'
import MenergyElectricity from '../components/MenergyElectricity'
import MenergyGaz from '../components/MenergyGaz'

const routes = [
    {
        name: 'Electricity',
        path: '/electricity',
        component: MenergyElectricity,
        props: {
            type: {
                id: 1,
                name: 'Electricité',
                unity: 'kWh'
            }
        }
    },
    {
        name: 'Gaz',
        path: '/gaz',
        component: MenergyGaz,
        props: {
            type: {
                id: 2,
                name: 'Gaz',
                unity: "m3"
            }
        }
    },
    {
        path: '*',
        redirect: '/electricity'
    }
]

export default new Router({
    linkActiveClass: 'is-active',
    routes
})
