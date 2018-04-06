function validate(event){
    if(!form.email.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/))
    {
      window.alert("Invalid email address.")
      event.preventDefault();
      return false;
    }

    if ((form.user.value.length < 6) || (form.user.value.length > 10))
    {
      window.alert ("Username must be between 6 and 10 characters.");
      event.preventDefault();
      return false;
    }

    if (form.user.value.match(/^[0-9]/)){
        window.alert("Username cannot start with a digit.");
      event.preventDefault();
        return false;
    }

    if(form.user.value.match(/\W/)){
        window.alert("Username can only have letters and digits.");
      event.preventDefault();
        return false;
    }

    if ((form.password.value.length < 6) || (form.password.value.length > 10))
    {
      window.alert ("Password must be between 6 and 10 characters.");
      event.preventDefault();
      return false;
    }

    if(form.password.value.match(/\W/)){
        window.alert("Password can only have letters and digits.");
      event.preventDefault();
        return false;
    }

    if(!form.password.value.match(/[A-Z]+/)){
        window.alert("Password must have at least one captial case letter.");
      event.preventDefault();
        return false;
    }

    if(!form.password.value.match(/[a-z]+/)){
        window.alert("Password must have at least one lower case letter.");
      event.preventDefault();
        return false;
    }

    if(!form.password.value.match(/\d+/)){
        window.alert("Password must have at least one digit.");
      event.preventDefault();
        return false;
    }

    if(form.password.value !== form.repeatPassword.value){
        window.alert("Password and repeated password must match.");
      event.preventDefault();
        return false;
    }

window.alert("Passed Validation! Welcome to the system " + form.user.value);
return true;
};

var form = document.getElementById("userForm");
form.addEventListener("submit", validate);

