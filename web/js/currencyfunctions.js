// function that return convertion result in the home
function convertit(form) {
    var valcurrency1 = form.current1.value;
    var valcurrency1 = valcurrency1.split(",");
    var current1name = valcurrency1[0];
    var current1rate = valcurrency1[1];

    var valcurrency2 = form.current2.value;
    var valcurrency2 = valcurrency2.split(",");
    var current2name = valcurrency2[0];
    var current2rate = valcurrency2[1];

    var value = form.valueconversion.value

    if (value >= 0) {
        var result_op = (current2rate * value) / current1rate;
        result_op = (Math.round(result_op * 100) / 100); //-> "1.1"
        var divresult = document.getElementById("conversionresult");
        divresult.innerHTML = '<H1> ' + value + ' ' + current1name + ' are ' + result_op + ' ' + current2name + ' </H1>';
    } else {

        var divresult = document.getElementById("conversionresult");
        divresult.innerHTML = '<div class="has-error"> <H1 style ="color:red"> Insert a valid value please </H1></div>';

    }

}
;

// function that shows the chart for a given currecy and his div
var chart;
// create chart
AmCharts.currencychart = function(current, divcurrency) {
    var valcurrency = current.split(",");
    current = valcurrency[0]
    if ((current !== "NULL") && (current !== "EUR")) {
    // load the data
    var chartData = AmCharts.loadJSON('includes/database/database_json.php?currency=' + current);
    // SERIAL CHART
    chart = new AmCharts.AmSerialChart();
    chart.pathToImages = "http://www.amcharts.com/lib/images/";
    chart.dataProvider = chartData;
    chart.categoryField = "category";
    chart.dataDateFormat = "YYYY-MM-DD";
    // GRAPHS
    var graph1 = new AmCharts.AmGraph();
    graph1.valueField = "value1";
    graph1.bullet = "round";
    graph1.bulletBorderColor = "#FFFFFF";
    graph1.bulletBorderThickness = 2;
    graph1.lineThickness = 2;
    graph1.lineAlpha = 0.5;
    chart.addGraph(graph1);
    // CATEGORY AXIS
    chart.categoryAxis.parseDates = true;
    // WRITE

    chart.write(divcurrency + "chart");
    var generateHere = document.getElementById(divcurrency + "header");
    generateHere.innerHTML = '<div class="col-md-3"> <H1> ' + current + ' evolution </H1></div>';
    
    }
};

// load via JSON the values from the currency en every chart

AmCharts.loadJSON = function(url) {   // in database.php
    // create the request
    if (window.XMLHttpRequest) {
        // IE7+, Firefox, Chrome, Opera, Safari
        var request = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        var request = new ActiveXObject('Microsoft.XMLHTTP');
    }

    // load it
    // the last "false" parameter ensures that our code will wait before the
    // data is loaded
    request.open('GET', url, false);
    request.send();

    // parse adn return the output
    return eval(request.responseText);
};