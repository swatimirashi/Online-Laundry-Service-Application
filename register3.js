function validation() 
{
    var fullname = document.getElementById('fname').value;
    var email = document.getElementById('email').value;
    var contact = document.getElementById('contact').value;
    var address = document.getElementById('address').value;
    var password = document.getElementById('password').value;
    var cpassword = document.getElementById('cpassword').value;

    var fnameError = document.getElementById('fnamee');
    var emailError = document.getElementById('emaill');
    var contactError = document.getElementById('contactt');
    var addressError = document.getElementById('addresss');
    var passwordError = document.getElementById('passwordd');
    var cpasswordError = document.getElementById('cpasswordd');

    fnameError.innerHTML = "";
    emailError.innerHTML = "";
    contactError.innerHTML = "";
    addressError.innerHTML = "";
    passwordError.innerHTML = "";
    cpasswordError.innerHTML = "";

    var isValid = true;

    if (fullname === "") 
    {
        fnameError.innerHTML = "Please enter your full name";
        isValid = false;
    } else if (!/^[A-Za-z\s]+$/.test(fullname)) 
    {
        fnameError.innerHTML = "Full name must contain only letters";
        isValid = false;
    }

    if (email === "")
    {
        emailError.innerHTML = "Please enter your email";
        isValid = false;
    } else if (!/\S+@\S+\.\S+/.test(email)) {
        emailError.innerHTML = "Enter a valid email address";
        isValid = false;
    }

    if (contact === "")
    {
        contactError.innerHTML = "Please enter your contact number";
        isValid = false;
    } else if (!/^\d{10}$/.test(contact)) 
    {
        contactError.innerHTML = "Contact number must be 10 digits";
        isValid = false;
    }

    if (address === "") 
    {
        addressError.innerHTML = "Please enter your address";
        isValid = false;
    }

    if (password === "") 
    {
        passwordError.innerHTML = "Please enter your password";
        isValid = false;
    } else if (!/^[a-zA-Z]+@+\d+$/.test(password)) 
    {
        passwordError.innerHTML = "*Password must be in the format: letters followed by @ and numbers.";
        isValid = false;
    }

    if (cpassword === "") 
    {
        cpasswordError.innerHTML = "Please confirm your password";
        isValid = false;
    } else if (password !== cpassword) 
    {
        cpasswordError.innerHTML = "Password do not match";
        isValid = false;
    }

    return isValid;
}