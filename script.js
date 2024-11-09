
        function validation() 
        {
            var fullname = document.getElementById("fname").value;
            var contact = document.getElementById("contact").value;
            var address = document.getElementById("address").value;
            var pincode = document.getElementById("pincode").value;
            var service = document.getElementById("service").value;

            var fnameError = document.getElementById('fnamee');
            var contactError = document.getElementById('contactt');
            var addressError = document.getElementById('addresss');
            var pincodeError = document.getElementById('pincodee');
            var serviceError = document.getElementById('servicee');

            fnameError.innerHTML = "";
            contactError.innerHTML = "";
            addressError.innerHTML = "";
            pincodeError.innerHTML = "";
            serviceError.innerHTML = "";

            var isValid = true;

            if (fullname === "") {
                fnameError.innerHTML = "*Please enter your full name*";
                isValid = false;
            } else if (!/^[A-Z ]+$/.test(fullname)) {
                fnameError.innerHTML = "*Full name must be in capital letters*";
                isValid = false;
            }

            if (contact === "") {
                contactError.innerHTML = "*Please enter your contact number*";
                isValid = false;
            } else if (contact.length !== 10 || isNaN(contact)) {
                contactError.innerHTML = "*Contact number must be 10 digits*";
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
                serviceError.innerHTML = "*Please select service*";
                isValid = false;
            }

            return isValid; // All validations passed
        }