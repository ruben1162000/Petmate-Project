var input = document.querySelector("#phone");
	var all_inp = {};
    var get_data;
	var raw_all_inp = $("input.form-item,textarea.form-item");
	for(x of raw_all_inp){
		all_inp[x.name]=x;
	}
	var iti = window.intlTelInput(input,{
	 	initialCountry: "auto",
	 	customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData){
    		return selectedCountryPlaceholder;
    	},
  		
  		geoIpLookup: function(success, failure){
    		$.get("https://freegeoip.app/json/", function() {}, "jsonp").always(function(resp){
      			var countryCode = (resp && resp.country_code) ? resp.country_code : "";
                get_data=resp;
      			success(countryCode);
    		});
    	},

    	separateDialCode:true,
	  
	 	utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.5/js/utils.min.js" 	
	});

    input.addEventListener("countrychange", function() {
    // do something with iti.getSelectedCountryData()
        selectedCountryData = iti.getSelectedCountryData();
        $("#country").val(selectedCountryData.name);
        $("#country").attr("disabled","disabled");
        $("#country_iso2").val(selectedCountryData.iso2);
        $("#dial_code").val(selectedCountryData.dialCode);
        checkcountry();
        if(get_data==undefined){
            $("#city").attr("disabled",false);
            $("#region").attr("disabled",false);
            $("#city").val("");
            $("#region").val("");
            setErrorFor(all_inp["region"],"cannot be blank");
            setErrorFor(all_inp["city"],"cannot be blank");
        }
        else if(selectedCountryData.iso2 !== get_data.country_code.toLowerCase()){
            $("#city").attr("disabled",false);
            $("#region").attr("disabled",false);
            $("#city").val("");
            $("#region").val("");
            setErrorFor(all_inp["region"],"cannot be blank");
            setErrorFor(all_inp["city"],"cannot be blank");
        }else{
            $("#city").val(get_data.city);
            $("#city").attr("disabled","disabled");
            $("#region").val(get_data.region_name);
            $("#region").attr("disabled","disabled");
            setSuccessFor(all_inp["region"],"valid");
            setSuccessFor(all_inp["city"],"valid");
        }   

        
    });

	function checkname(){
	    let nameValue = all_inp['name'].value.trim();
        
        if(nameValue === '') {
            return setErrorFor(all_inp['name'], 'Name cannot be blank');
        } 
        else if(nameValue.length<3){
            return setErrorFor(all_inp['name'], 'Name must have ateast 3 characters');
          
        }
        else if(nameValue.length>25){
            return setErrorFor(all_inp['name'], 'Name can have a maximum of 100 characters')
          ;
        }else{
        	return setSuccessFor(all_inp['name'],'Valid Name');
        }
    }
    function checkcountry(){
    	let countryValue = all_inp['country'].value.trim();
    	if(countryValue === '') {
            return setErrorFor(all_inp['country'], 'Country cannot be blank');
          
        }else{
        	return setSuccessFor(all_inp["country"],"Valid");
        }
    }
    function checkregion(){
    	let regionValue = all_inp['region'].value.trim();
    	if(regionValue === '') {
            return setErrorFor(all_inp['region'], 'Region cannot be blank');
          
        }else{
        	return setSuccessFor(all_inp["region"],"Valid");
        }
    }
    function checkcity(){
    	let cityValue = all_inp['city'].value.trim();
    	if(cityValue === '') {
            return setErrorFor(all_inp['city'], 'City cannot be blank');
          
        }else{
        	return setSuccessFor(all_inp["city"],"Valid");
        }
    }
    function checkmail(){
        let mailValue = all_inp['mail'].value.trim();
        if(mailValue === ''){
            return setErrorFor(all_inp['mail'], 'Email cannot be blank');
          
        }else if(!isEmail(mailValue)){
            return setErrorFor(all_inp['mail'], 'Not a valid email');
          
        }else{
            return setSuccessFor(all_inp['mail'],'Valid Email');
        }            
    }
    function isEmail(email){
	    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    }

    function checkphone(){
    	let phoneValue = all_inp["phone"].value; 
    	if(iti.isValidNumber()){
    		return setSuccessFor(all_inp['phone'],'Valid Number');
    	}else if(phoneValue.length==0){
    		return setErrorFor(all_inp["phone"],"Phone Number Cannot Be Blank");
    
    	}else{
    		return setErrorFor(all_inp['phone'], "Invalid Number")
    
    	}
    }

    function checkaddress(){
    	let addressValue = all_inp['address'].value.trim();
    	if(addressValue === ''){
            return setErrorFor(all_inp['address'], 'Address cannot be blank');
          
        }
        else if(addressValue.length >100){
        	return setErrorFor(all_inp['address'], 'max 100 chars including space');
       
        }else{
        	return setSuccessFor(all_inp['address'],'Valid charcount but please enter valid address as this is not checked');
        }	
    }

    function checkpass(){
        let password = all_inp["pass"].value;
        //CHECK FOR PASSWORD
        if(password === '') {
            return setErrorFor(all_inp["pass"], 'Password cannot be blank');
          
        }else{
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
            if (msg=="") return setSuccessFor(all_inp["pass"],'Valid Password');
            else{
                return setErrorFor(all_inp["pass"],msg.slice(0,-2));
              
            }
        }
   	}

   	function checkrepass(){
        let password2Value = all_inp["repass"].value;
        let passwordValue = all_inp["pass"].value;
        //CONFIRM PASSWORD

        if(password2Value === '') {
            return setErrorFor(all_inp["repass"], 'Password cannot be blank');
          
        } 
        else if(passwordValue !== password2Value) {
            return setErrorFor(all_inp["repass"], 'Passwords do not match');
          	
        }
        else{
            return setSuccessFor(all_inp["repass"],'Passwords Match!');
        }
    }

    function setErrorFor(input, message) {
        let formControl = input.closest('div.form-control');
        let small = formControl.querySelector('small');
        formControl.className = 'form-control error';
        small.innerText = message;
        return false;
    }

    function setSuccessFor(input, message) {
	    let formControl = input.closest('div.form-control');
        let small = formControl.querySelector('small');
	    formControl.className = 'form-control success';
        small.innerText = message;
        return true;
    }



    raw_all_inp.on("focusout keyup",function(){
    	let call = "check"+this.name+"();";
    	eval(call);
    });

    $("button.form-item").on("click",function(){
    	let valid=true;
    	for(x in all_inp){
    		valid = valid&&eval("check"+x+"()");
    	}
    	if(valid){
            $("#region").attr("disabled",false);
            $("#country").attr("disabled",false);
            $("#city").attr("disabled",false);
    		document.forms["account-form"].submit();
    	}else{
    		alert("FORM IS INVALID PLEASE CHECK");
    	}
    });