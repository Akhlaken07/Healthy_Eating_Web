// validation.js
var validationRules = {
    name: /^[A-Za-z\s]+$/,
    matricNo: /^\d{5,10}$/,
    email: /^.+@gmail.com$/,
    countryCode: /^\+\d{1,3}$/,
    phoneNo: /^\d{9,15}$/
};

function validateForm() {
    var name = document.getElementById('name').value;
    if (!validationRules.name.test(name)) {
        alert('Invalid name');
        return false;
    }

    var matricNo = document.getElementById('matricNo').value;
    if (!validationRules.matricNo.test(matricNo)) {
        alert('Invalid matric number');
        return false;
    }

    var email = document.getElementById('email').value;
    if (!validationRules.email.test(email)) {
        alert('Invalid email');
        return false;
    }

    var countryCodeMobile = document.getElementById('countryCodeMobile').value;
    if (!validationRules.countryCode.test(countryCodeMobile)) {
        alert('Invalid mobile country code');
        return false;
    }

    var mobilePhone = document.getElementById('mobilePhone').value;
    if (!validationRules.phoneNo.test(mobilePhone)) {
        alert('Invalid mobile phone number');
        return false;
    }

    var countryCodeHome = document.getElementById('countryCodeHome').value;
    if (!validationRules.countryCode.test(countryCodeHome)) {
        alert('Invalid home country code');
        return false;
    }

    var homePhone = document.getElementById('homePhone').value;
    if (!validationRules.phoneNo.test(homePhone)) {
        alert('Invalid home phone number');
        return false;
    }

    // If all validations pass
    return true;
}