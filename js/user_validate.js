//form validation

        const form = document.getElementById('form');
        const fname = document.getElementById('fname');
        const lname = document.getElementById('lname');
        const email = document.getElementById('email');
        const pass1 = document.getElementById('pass1');
        const pass2 = document.getElementById('pass2');

        ["focusout","keyup"].forEach(function(event){
            fname.addEventListener(event, e => {
            checkFname();
            });

            lname.addEventListener(event, e => {
            checkLname();
            });

            email.addEventListener(event, e => {
            checkMail();
            });

            pass1.addEventListener(event, e => {
            checkPass();
            });

            pass2.addEventListener(event, e => {
            confirmPass();
            });
        });
        

        function checkFname(){
            let fnameValue = fname.value.trim();
            //CHECK FOR FIRST NAME

            if(fnameValue === '') {
                return setErrorFor(fname, 'First name cannot be blank');
            }
            else if(/[^A-Z]/.test(fnameValue.charAt(0))){
                return setErrorFor(fname,"First letter should be Uppercase");
            }
            else if(/[^a-z]/.test(fnameValue.slice(1))){
                return setErrorFor(fname,"remaining should be small case letters only");
            } 
            else if(fnameValue.length<3){
                return setErrorFor(fname, 'First name must have ateast 3 characters');
            }
            else if(fnameValue.length>30){
                return setErrorFor(fname, 'First name can have a maximum of 30 characters');
            }
            else {
            return setSuccessFor(fname,'Valid First Name');
            }
        }

        function checkLname(){
            let lnameValue = lname.value.trim();
            //CHECK FOR LAST NAME

            if(lnameValue === '') {
                return setErrorFor(lname, 'Last name cannot be blank');
            }
            else if(/[^A-Z]/.test(lnameValue.charAt(0))){
                return setErrorFor(lname,"First letter should be Uppercase");
            }
            else if(/[^a-z]/.test(lnameValue.slice(1))){
                return setErrorFor(lname,"remaining should be small case letters only");
            } 
            else if(lnameValue.length<3){
                return setErrorFor(lname, 'Last name must have ateast 3 characters');
            }
            else if(lnameValue.length>30){
                return setErrorFor(lname, 'Last name can have a maximum of 30 characters');
            }
            else {
            return setSuccessFor(lname,'Valid Last Name');
            }
        }

        function checkMail(){
            let emailValue = email.value.trim();

            // CHECK FOR EMAIL

            if(emailValue === '') {
                return setErrorFor(email, 'Email cannot be blank');
            } else if (!isEmail(emailValue)) {
                return setErrorFor(email, 'Not a valid email');
            } else {
                return setSuccessFor(email,'Valid Email');
            }            
        }

        function checkPass(){
            let password = pass1.value;
            //CHECK FOR PASSWORD
            if(password === '') {
                return setErrorFor(pass1, 'Password cannot be blank');
            } 
            else{
                let msg="";
                if(password.length<10){msg+="min length=10, ";}
                if(password.length>20) {msg+="max length=20, ";}
                if(password.match(/\s/g)!==null) {msg+="no white spaces, ";}
                let check=password.match(/[^A-Za-z0-9\s]/g);
                if(check===null){msg+="min 2 special characters, ";}
                else if(check.length<2) {msg+="min 2 special characters, ";}
                check=password.match(/[0-9]/g);
                if(check===null){msg+="min 2 digits, ";}
                else if(check.length<2) {msg+="min 2 digits, ";}
                if (msg=="") return setSuccessFor(pass1,'Valid Password');
                else{
                    return setErrorFor(pass1,msg.slice(0,-2));
                }
            }
        }

        function confirmPass(){
            let password2Value = pass2.value;
            let passwordValue = pass1.value;
            //CONFIRM PASSWORD

            if(password2Value === '') {
                return setErrorFor(pass2, 'Password cannot be blank');
            } 
            else if(passwordValue !== password2Value) {
                return setErrorFor(pass2, 'Passwords do not match');
            }
            else{
                return setSuccessFor(pass2,'Passwords Match!');
            }
        }

        function setErrorFor(input, message) {
        let formControl = input.parentElement;
        let small = formControl.querySelector('small');
        formControl.className = 'form-control error';
        small.innerText = message;
        return false;
        }

        function setSuccessFor(input, message) {
	    let formControl = input.parentElement;
        let small = formControl.querySelector('small');
	    formControl.className = 'form-control success';
        small.innerText = message;
        return true;
        }

        function isEmail(email) {
	    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
        }

        document.querySelector("button.form-item").addEventListener("click",function(event){
            valid = checkFname()&&checkLname()&&checkMail()&&checkPass()&&confirmPass();
            if(valid){
                document.forms["account-form"].submit();
            }else{
                alert("FORM IS INVALID PLEASE CHECK");
            }
        });