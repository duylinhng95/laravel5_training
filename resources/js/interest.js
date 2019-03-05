class Interest {
	constructor() {
		this.init()
	}

	init() {
		this.config()
		this.listen()
	}

	config() {
		this.element = {
			categoryName: $("#categoryName"),
			postTag: $("#postTag"),
			loginStatus: $("#loginStatus"),
			apiUrl: location.origin + '/api',

		}
	}

	listen() {
		this.setUserInterest()
	}


	setUserInterest() {
		let categoryName = this.element.categoryName.val()
		let postTag = this.element.postTag.children()
		let tagList = []
		let loginStatus = this.element.loginStatus.val()

		postTag.each(function (key, value) {
			tagList.push(value.innerText)
		})

		let data = {
			category: categoryName,
			tags: tagList,
		}

		this.setInterestStorage(data, loginStatus)
	}

	setInterestStorage(data, loginStatus) {

		let myStorage = window.localStorage

		if (loginStatus === 'true') {
			myStorage = window.sessionStorage
		}

		let storageData = JSON.parse(myStorage.getItem('interest'))

		if (storageData != null) {
			storageData = this.setStorageDataArray(storageData, data)
		} else {
			storageData = {}
			storageData.category = [data.category]
			storageData.tags = data.tags
		}

		myStorage.setItem('interest', JSON.stringify(storageData))
		if (loginStatus === 'true') {
			let userId = this.element.loginStatus.data('user-id')
			this.uploadInterest(storageData, userId)
		}
	}

	setStorageDataArray(storageData, data) {
		if (!storageData.category.includes(data.category)) {
			storageData.category.push(data.category)
		}

		data.tags.forEach(function (value, key) {
			if (!storageData.tags.includes(value)) {
				storageData.tags.push(value)
			}
		})

		return storageData
	}

	uploadInterest(storageData, userId) {
		$.ajax({
			url: this.element.apiUrl + '/set-interest',
			type: "POST",
			data: {
				categories: storageData.category,
				tags: storageData.tags,
				user_id: userId
			}
		})
	}
}

new Interest()
