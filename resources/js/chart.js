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
		if (this.element.postDayChart.length !== 0) {
			this.postDayChart()
		}

		if (this.element.registerDayChart.length !== 0) {
			this.registerDayChart()
		}
	}

	postDayChart() {
		let self = this
		let postDayChart = this.element.postDayChart
		$.ajax({
			url: this.apiURL + "/get-post-day",
			type: "get",
			success: function (res) {
				let id = 'postDayChart'
				self.removeLoadingGif(postDayChart)
				if (res.data !== null) {
					let data = res.data
					let modified = ['hour', '# Posts']
					self.drawAreaChart(id, data, modified)
				} else {
					self.appendNullData(postDayChart)
				}
			}
		})
	}

	removeLoadingGif(section)
	{
		section.find('#loader-chart').remove()
	}

	appendNullData(section)
	{
		section.html(`<div class="chart-notify">No data is found</div>`)
	}

	registerDayChart() {
		let self = this
		let registerDayChart = this.element.registerDayChart
		$.ajax({
			url: this.apiURL + "/get-register-day",
			type: "get",
			success: function (res) {
				self.removeLoadingGif(registerDayChart)
				let id = 'registerDayChart'
				if (res.data !== null) {
					let data = res.data.data
					let modified = res.data.colors
					self.drawDonutChart(id, data, modified)
				} else {
					self.appendNullData(registerDayChart)
				}
			}
		})
	}

	drawAreaChart(id, data, modified) {
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
