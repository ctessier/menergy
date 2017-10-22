import * as types from './mutation-types'

export const getMeasures = ({ commit }, type) => {
    commit(types.SET_LOADING, true)
    axios
        .get('/types/' + type)
        .then(response => {
            const measures = response.data
            commit(types.RECEIVE_MESURES, { measures })
        })
        .catch(errors => {
            const message = 'Une erreur s\'est produite. Veuillez réessayer ultérieurement.'
            commit(types.SET_ERROR, message)
        })
}

export const postMeasure = ({ commit }, data) => {
    return new Promise((resolve, reject) => {
        axios
            .post('/measures', data)
            .then(response => {
                const measures = [response.data]
                commit(types.RECEIVE_MESURES, { measures })
                resolve(response.data)
            })
            .catch(({ response }) => {
                let errors = {}
                if (422 === response.status) {
                    errors = response.data
                } else {
                    const message = 'Une erreur s\'est produite. Veuillez réessayer ultérieurement.'
                    commit(types.SET_ERROR, message)
                }
                reject(errors)
            })
    })
}
