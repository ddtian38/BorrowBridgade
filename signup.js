var inputs = $("input");
var form = $("#userForm");
form.submit(  function (event){
    if(!inputs.eq(2).val().match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/))
    {
      window.alert("Invalid email address.")
      event.preventDefault();
      return false;
    }

    if ((inputs.eq(4).val().length < 6) || (inputs.eq(4).val().length > 10))
    {
      window.alert ("Username must be between 6 and 10 characters.");
      event.preventDefault()
      return false;
    }

    if (inputs.eq(4).val().match(/^[0-9]/)){
        window.alert("Username cannot start with a digit.");
      event.preventDefault();
	return false;
    }

    if(inputs.eq(4).val().match(/\W/)){
        window.alert("Username can only have letters and digits.");
      event.preventDefault();
	return false;
    }

    if ((inputs.eq(5).val().length < 6) || (inputs.eq(5).val().length > 10))
    {
      window.alert ("Password must be between 6 and 10 characters.");
      event.preventDefault();
      return false;
    }

    if(inputs.eq(5).val().match(/\W/)){
        window.alert("Password can only have letters and digits.");
      event.preventDefault();
  	return false;
    }

    if(!inputs.eq(5).val().match(/[A-Z]+/)){
        window.alert("Password must have at least one captial case letter.");
      event.preventDefault();
	return false;
    }

    if(!inputs.eq(5).val().match(/[a-z]+/)){
        window.alert("Password must have at least one lower case letter.");
      event.preventDefault();
	return false;
    }

    if(!inputs.eq(5).val().match(/\d+/)){
        window.alert("Password must have at least one digit.");
      event.preventDefault();
	return false;
    }

    if(inputs.eq(5).val() !== inputs.eq(6).val()){
        window.alert("Password and repeated password must match.");
      event.preventDefault();
	return false;
    }
window.alert("Information being added our system");
return true;
});


//AJAX
function checkUsername(){
        var user = $("#user").val();
        console.log(user);
        $.ajax({
                url: 'check.php',
                type: 'POST',
                data:{username:user},
                success:function(response)
                {
		console.log(response);
                response = $.trim(response);
                        if (response === "Taken")
                                {
                                $('#avaliable').html('<span style="color:white; background-color:red;">*Username not available</span>');

                                }
                        else if(response === "Available")
                                {
                                $('#avaliable').html('<span style="color:white; background-color:green;">Username available</span>');
                                }
                        else{
                                $('#avaliable').html('<span></span>');
                        }
        }
})
}
