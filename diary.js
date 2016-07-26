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