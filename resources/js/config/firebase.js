class FirebaseConfig {
	constructor() {
		this.init()
	}

	init() {
		this.config()
	}

	config() {
		this.element = {
			apiKey: "AIzaSyBBowiPOnysMsCT1B_JZtqtz71rdgJhGZ0",
			authDomain: "laravel-demo-ca26c.firebaseapp.com",
			databaseURL: "https://laravel-demo-ca26c.firebaseio.com",
			projectId: "laravel-demo-ca26c",
			storageBucket: "laravel-demo-ca26c.appspot.com",
			messagingSenderId: "721027595145",
		}
	}
}

export default FirebaseConfig
