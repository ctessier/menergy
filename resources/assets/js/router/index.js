import Router from 'vue-router'
import MenergyElectricity from '../components/MenergyElectricity'
import MenergyGaz from '../components/MenergyGaz'

const routes = [
    {
        path: '/electricity',
        component: MenergyElectricity,
        props: {
            type: {
                id: 1,
                name: 'Electricité',
                icon: 'bolt',
                unity: 'kWh'
            }
        },
        children: [
            {
                path: ':page(\\d+)',
                component: MenergyElectricity
            }
        ]
    },
    {
        path: '/gaz',
        component: MenergyGaz,
        props: {
            type: {
                id: 2,
                name: 'Gaz',
                icon: 'fire',
                unity: "m3"
            }
        },
        children: [
            {
                path: ':page(\\d+)',
                component: MenergyGaz
            }
        ]
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
