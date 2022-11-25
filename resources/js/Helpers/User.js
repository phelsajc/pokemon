import Token from './Token'
import AppStorage from './AppStorage'


class User{

	responseAfterLogin(res){
		const access_token = res.data.access_token
		const username = res.data.name
		const userid = res.data.user_id
		const usertype = res.data.type
		const fname = res.data.firstname
		const lname = res.data.lastname
		const bday = res.data.birthdate
		if (Token.isValid(access_token)) {
			AppStorage.store(access_token,username,userid,usertype,fname,lname,bday)
		}
	}
 

	hasToken(){
		const storeToken = localStorage.getItem('token');
		if (storeToken) {
			return Token.isValid(storeToken)? true : false
		}
		false
	}

	loggedIn(){
		return this.hasToken()
	}

  	name(){
		if (this.loggedIn()) {
			return localStorage.getItem('user');
		}
	}


	user_id(){
		if (this.loggedIn()) {
			return localStorage.getItem('user_id');
		}
	}


	id(){
	  	if (this.loggedIn()) {
	  		const payload = Token.payload(localStorage.getItem('token'));
	  		return payload.sub
	  	}
	  	return false
	}

	user_type(){
		if (this.loggedIn()) {
			/* this.setState({
				user_type: localStorage.getItem('user_type'),
			  }); */
			return localStorage.getItem('user_type');			
		}
	}

	fname(){
		if (this.loggedIn()) {
			const payload = Token.payload(localStorage.getItem('fname'));
			return payload.sub
		}
		return false
	}

	lname(){
		if (this.loggedIn()) {
			const payload = Token.payload(localStorage.getItem('lname'));
			return payload.sub
		}
		return false
	}

	bday(){
		if (this.loggedIn()) {
			const payload = Token.payload(localStorage.getItem('bday'));
			return payload.sub
		}
		return false
	}
	
 
}

export default User = new User()