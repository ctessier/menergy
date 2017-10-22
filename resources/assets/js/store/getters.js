export const measuresByType = state => type_id => {
    const measures = Object.values(state.measures)
    return measures
        .filter(measure => measure.type_id === type_id)
        .sort((a, b) => {
            return a.date < b.date
        })
}
