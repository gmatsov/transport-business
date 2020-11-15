const traveled_km_chart = new Chartisan({
    el: '#traveled_km_chart',
    url: "api/chart/km_traveled_chart",
    loader: {
        color: '#247ba0',
        size: [30, 30],
        type: 'bar',
        textColor: '#000000',
        text: 'Зареждам данни...',
    },
    error: {
        color: '#247ba0',
        size: [30, 30],
        text: 'Възникна грешка...',
        textColor: '#247ba0',
        type: 'general',
        debug: true,
    },
    hooks: new ChartisanHooks()
        // .title('Изминати километри!')

        .colors(['#ECC94B', '#4299E1'])
        // .datasets([ 'bar', {type: 'bar', color : 'red'}])
        .legend(true)
        .tooltip(true)

})

const number_of_trucks = new Chartisan({
    el: '#number_of_trucks',
    url: "api/chart/number_of_trucks_chart",
    loader: {
        color: '#247ba0',
        size: [30, 30],
        type: 'bar',
        textColor: '#000000',
        text: 'Зареждам данни...',
    },
    error: {
        color: '#247ba0',
        size: [30, 30],
        text: 'Възникна грешка...',
        textColor: '#247ba0',
        type: 'general',
        debug: true,
    },
    hooks: new ChartisanHooks()
        .datasets([{type: 'pie', color: '#4299E1', radius: ['30%', '60%']}])
        .axis(false)

})

const avg_fuel_consumption = new Chartisan({
    el: '#avg_fuel_consumption_chart',
    url: "api/chart/avg_fuel_consumption_chart",
    loader: {
        color: '#247ba0',
        size: [30, 30],
        type: 'bar',
        textColor: '#000000',
        text: 'Зареждам данни...',
    },
    error: {
        color: '#247ba0',
        size: [30, 30],
        text: 'Възникна грешка...',
        textColor: '#247ba0',
        type: 'general',
        debug: true,
    },
    hooks: new ChartisanHooks()
        .datasets([{type: 'line'}])
        .legend()
        .tooltip(true)
})

const avg_fuel_price = new Chartisan({
    el: '#avg_fuel_price_chart',
    url: "api/chart/avg_fuel_price_chart",
    loader: {
        color: '#247ba0',
        size: [30, 30],
        type: 'bar',
        textColor: '#000000',
        text: 'Зареждам данни...',
    },
    error: {
        color: '#247ba0',
        size: [30, 30],
        text: 'Възникна грешка...',
        textColor: '#247ba0',
        type: 'general',
        debug: true,
    },
    hooks: new ChartisanHooks()
        .datasets([{type: 'line'}])
        .colors(['#4299E1'])
        .tooltip(true)
})

const paid_trips = new Chartisan({
    el: '#paid_trips_chart',
    url: "api/chart/paid_trips_chart",
    loader: {
        color: '#247ba0',
        size: [30, 30],
        type: 'bar',
        textColor: '#000000',
        text: 'Зареждам данни...',
    },
    error: {
        color: '#247ba0',
        size: [30, 30],
        text: 'Възникна грешка...',
        textColor: '#247ba0',
        type: 'general',
        debug: true,
    },
    hooks: new ChartisanHooks()
        .datasets([{type: 'line'}])
        .colors(['#32527B', '#6B8EB7', '#BCD3E7'])
        .tooltip(true)
        .legend(true)
})
