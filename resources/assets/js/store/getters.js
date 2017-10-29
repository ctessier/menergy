export const measuresByTypeOrdered = state => (type_id, order = 'DESC') => {
    const measures = Object.values(state.measures)
    return measures
        .filter(measure => measure.type_id === type_id)
        .sort((a, b) => {
            return order === 'ASC'
                ? new Date(a.date) - new Date(b.date)
                : new Date(b.date) - new Date(a.date)
        })
}
