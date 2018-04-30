 function validate (event){
    if(!inputs.eq(2).val().match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/))
    {
      window.alert("Invalid email address.")
      event.preventDefault();
      return;
    }

    if ((inputs.eq(3).val().length < 6) || (inputs.eq(3).val().length > 10))
    {
      window.alert ("Username must be between 6 and 10 characters.");
      event.preventDefault()
      return;
    }

    if (inputs.eq(3).val().match(/^[0-9]/)){
        window.alert("Username cannot start with a digit.");
      event.preventDefault();
	return;
    }

    if(inputs.eq(3).val().match(/\W/)){
        window.alert("Username can only have letters and digits.");
      event.preventDefault();
	return;
    }

    if ((inputs.eq(4).val().length < 6) || (inputs.eq(4).val().length > 10))
    {
      window.alert ("Password must be between 6 and 10 characters.");
      event.preventDefault();
      return;
    }

    if(inputs.eq(4).val().match(/\W/)){
        window.alert("Password can only have letters and digits.");
      event.preventDefault();
  	return;
    }

    if(!inputs.eq(4).val().match(/[A-Z]+/)){
        window.alert("Password must have at least one captial case letter.");
      event.preventDefault();
	return;
    }

    if(!inputs.eq(4).val().match(/[a-z]+/)){
        window.alert("Password must have at least one lower case letter.");
      event.preventDefault();
	return;
    }

    if(!inputs.eq(4).val().match(/\d+/)){
        window.alert("Password must have at least one digit.");
      event.preventDefault();
	return;
    }

    if(inputs.eq(4).val() !== inputs.eq(5).val()){
        window.alert("Password and repeated password must match.");
      event.preventDefault();
	return;
    }

//AJAX
var userData = { user: inputs.eq(3).val() };
$.post("check.php", userData, function(data){
	if (data === 1){
		alert("username is taken");
		event.preventDefault();
	}
	else{
	 
		


  
	}


}

 )



};
var form = $("form");
var inputs = $("input");
var runAJAX;
form.submit(validate);

