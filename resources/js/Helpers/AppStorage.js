class AppStorage{

    storeToken(token){
        localStorage.setItem('token',token);
    }
   
    storeUser(user){
        localStorage.setItem('user',user);
    }
    
    storeUserId(user_id){
        localStorage.setItem('user_id',user_id);
    }
    
    storeUserType(user_type){
        localStorage.setItem('user_type',user_type);
    }
    
    storeFirstname(firstname){
        localStorage.setItem('fname',firstname);
    }

    storeLastname(lastname){
        localStorage.setItem('lname',lastname);
    }

    storeBirthdate(birthdate){
        localStorage.setItem('bday',birthdate);
    }

   
    store(token,user,user_id,user_type,fname,lname,bday){
        this.storeToken(token)
        this.storeUser(user)
        this.storeUserId(user_id)
        this.storeUserType(user_type)
        this.storeFirstname(fname)
        this.storeLastname(lname)
        this.storeBirthdate(bday)
    }
   
     clear(){
         localStorage.removeItem('token')
         localStorage.removeItem('user')
         localStorage.removeItem('user_id')
         localStorage.removeItem('user_type')
         localStorage.removeItem('fname')
         localStorage.removeItem('lname')
         localStorage.removeItem('bday')
     }
   
     getToken(){
         localStorage.getItem(token);
     }
   
     getUser(){
        localStorage.getItem(user);
    }

    getUserId(){
        localStorage.getItem(user_id);
     }

     getUserType(){
        localStorage.getItem(user_type);
     }
   
     getFirstname(){
        localStorage.getItem(fname);
    }
    
     getLastname(){
        localStorage.getItem(lname);
    }
    
     getBirthdate(){
        localStorage.getItem(bday);
     }
   
   }
   
   export default AppStorage = new AppStorage();