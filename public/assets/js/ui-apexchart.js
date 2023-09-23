let orderPerMonthData = document.getElementById('orderpermonthdata')
let getOrderPerMonth = orderPerMonthData.getAttribute('data-order')
let parseOrderPerMonth = JSON.parse(getOrderPerMonth)

var lineOptions = {
    chart: {
        type: "line",
    },
    series: [{
        name: "Order",
        data: parseOrderPerMonth,
    }, ],
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    },
};

let incomePerMonthData = document.getElementById('incomepermonthdata')
let getIncomePerMonth = incomePerMonthData.getAttribute('data-income')
let parseIncomePerMonth = JSON.parse(getIncomePerMonth)

var barOptions = {
    series: [{
            name: "Male",
            data: parseIncomePerMonth[0],
        },
        {
            name: "Female",
            data: parseIncomePerMonth[1],
        },
    ],
    chart: {
        type: "bar",
        height: 350,
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "55%",
            endingShape: "rounded",
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
    },
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    },
    yaxis: {
        title: {
            text: "In (k) Rupiahs",
        },
    },
    fill: {
        opacity: 1,
    },
    tooltip: {
        y: {
            formatter: function(val) {
                return "Rp " + val + "k";
            },
        },
    },
};

let getGenderNow = document.getElementById('gender');
let getMaleData = getGenderNow.getAttribute('data-male');
let getFemaleData = getGenderNow.getAttribute('data-female');
let totalUser = Number(getMaleData) + Number(getFemaleData);
var getMalePercent = Math.round((Number(getMaleData) * 100 / totalUser) * 10) / 10;
var getFemalePercent = Math.round((Number(getFemaleData) * 100 / totalUser) * 10) / 10;

// console.log(getMalePercent, getFemalePercent);

let optionsVisitorsProfile  = {
	series: [getMalePercent, getFemalePercent],
	labels: ['Male', 'Female'],
	colors: ['#060047','#E90064'],
	chart: {
		type: 'donut',
		width: '100%',
		height:'398px'
	},
	legend: {
		position: 'bottom'
	},
	plotOptions: {
		pie: {
			donut: {
				size: '0%'
			}
		},
	}
}

var bar = new ApexCharts(document.querySelector("#bar"), barOptions);
var line = new ApexCharts(document.querySelector("#line"), lineOptions);
var chartVisitorsProfile = new ApexCharts(document.getElementById('chart-visitors-profile'), optionsVisitorsProfile)

bar.render();
line.render();
chartVisitorsProfile.render();
