function validateForm(formName,divName){
	
	var valid = true;
	var elements = document.forms[formName];

	for(var i = 0; i < elements.length; i++){
		if(elements[i].value=="")
			valid = false;
	}

	if(!valid){
		document.getElementById(divName).innerHTML = "Please fill in all input boxes.";
		return false;
	}else{
		return true;
	}

}

function signUpValidate(formName){

	var elements = document.forms[formName];

	if(elements["username"].length < 1 || elements["username"].length > 14){
		alert("Username must be between 1 and 14 characters");
		return false;
	}

	if(elements["password"].localeCompare(elements["password2"]) != 0){
		alert("Passwords do not match");
		return false;
	}

	return true;

}