function validation()
{
    var fullname = document.getElementById("fname").value;  
    var address = document.getElementById("address").value;
    var pincode = document.getElementById("pincode").value;
    var service = document.getElementById("service").value;

    var fnameError = document.getElementById('fnamee');
    var addressError = document.getElementById('addresss');
    var pincodeError = document.getElementById('pincodee');
    var serviceError = document.getElementById('servicee');

    fnameError.innerHTML = "";
    addressError.innerHTML = "";
    pincodeError.innerHTML = "";
    serviceError.innerHTML = "";

    var isValid = true;

    if (fullname === "") {
        fnameError.innerHTML = "*Please enter your full name*";
        isValid = false;
    } else if (!/^[A-Za-z\s]+$/.test(fullname)) {
        fnameError.innerHTML = "*Full name must contain only letters*";
        isValid = false;
    }

    if (address === "") {
        addressError.innerHTML = "*Please enter your address*";
        isValid = false;
    }

    if (pincode === "") {
        pincodeError.innerHTML = "*Please enter your pincode*";
        isValid = false;
    }

    if (service === "") {
        serviceError.innerHTML = "*Please select a service*";
        isValid = false;
    }

    return isValid;
}