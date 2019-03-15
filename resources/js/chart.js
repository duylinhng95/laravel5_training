require('./bootstrap')
window.Raphael = require('raphael/raphael.min')
require("morris.js/morris")

class Chart {
	constructor() {
		this.init()
	}

	init() {
		this.config()
		this.listen()
	}

	config() {
		this.element = {
			postDayChart: $("#postDayChart"),
			registerDayChart: $("#registerDayChart"),
		}
		this.apiURL = location.origin + "/api"
	}

	listen() {
		this.postDayChart()
		this.registerDayChart()
	}

	postDayChart() {
		let self = this
		$.ajax({
			url: this.apiURL + "/get-post-day",
			type: "get",
			success: function(res) {
				let id = 'postDayChart'
				let data = res.data
				let modified = ['hour', '# Posts']
				self.drawAreaChart(id, data, modified)
			}
		})
	}

	registerDayChart() {
		let self = this
		$.ajax({
			url: this.apiURL + "/get-register-day",
			type: "get",
			success: function(res) {
				let id = 'registerDayChart'
				let data = res.data.data
				let modified = res.data.colors
				self.drawDonutChart(id, data, modified)
			}
		})
	}

	drawAreaChart(id,data, modified) {
		Morris.Area({
			// ID of the element in which to draw the chart.
			element: id,
			// Chart data records -- each entry in this array corresponds to a point on
			// the chart.
			data: data,
			parseTime: false,
			// The name of the data record attribute that contains x-values.
			xkey: 'hour',
			// A list of names of data record attributes that contain y-values.
			ykeys: ['number'],
			ymin: 0,
			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: [modified[1]]
		});
	}

	drawDonutChart(id, data, modified) {
		Morris.Donut({
			element: id,
			data: data,
			colors: modified,
		})
	}
}

export default Chart
