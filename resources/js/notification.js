import * as firebase from 'firebase/app';
import FirebaseConfig from './config/firebase'
import 'firebase/firebase-firestore'

class Notification {
	constructor() {
		this.init()
	}

	init() {
		this.config()
		this.listen()
	}

	config() {
		this.element = {
			firebaseConfig: new FirebaseConfig()
		}
	}

	listen() {
		this.initFirebase()
	}

	initFirebase() {
		this.app = firebase.initializeApp(this.element.firebaseConfig.element)
		this.db  = firebase.firestore()
	}
}

export default Notification
