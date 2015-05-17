// onload refresh charts and result
window.onload = function() {
    var valcurrency1 = document.formconversion.current1.value;
    var valcurrency1 = valcurrency1.split(",");
    var current1name = valcurrency1[0];

    var valcurrency2 = document.formconversion.current2.value;
    var valcurrency2 = valcurrency2.split(",");
    var current2name = valcurrency2[0];

    if ((current1name !== "NULL") && (current1name !== "EUR")) {
        AmCharts.currencychart(current1name, "currency1");
    }
    if ((current2name !== "NULL") && (current2name !== "EUR")) {
        AmCharts.currencychart(current2name, "currency2");
    }
    convertit(document.formconversion);

};

