// onload refresh charts and result
window.onload = function() {
    var currencies = ["AUD","BGN","BRL","CAD","CHF","CNY","CZK","DKK","GBP","HKD","HRK","HUF","IDR","ILS","INR","JPY","KRW","LTL","MXN","MYR","NOK","NZD","PHP","PLN","RON","RUB","SEK","SGD","THB","TRY","USD","ZAR" ]; 
    var index;
    for (index = 0; index < currencies.length; ++index) {
        AmCharts.currencychart(currencies[index], "currency"+currencies[index]);
    }
};


