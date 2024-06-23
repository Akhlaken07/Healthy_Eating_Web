    // Define the regular expressions
    var nameRegex = /^[a-zA-Z\s]+$/;
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var phoneRegex = /^\d{10}$/;
    var addressRegex = /^[a-zA-Z0-9\s,.'-]{3,}$/;

function validateForm() {
    // Get the form values
    var name = document.getElementById('name').value;
    var email = document.getElementById('mail').value;
    var phone = document.getElementById('phone').value;
    var address = document.getElementById('address').value;
    var subject = document.getElementById('subject').value;
  
    // Sanitize the inputs
    var sanitizedSubject = encodeURI(subject);
    var sanitizedName = encodeURI(name);
    var sanitizedEmail = encodeURI(email);
    var sanitizedPhone = encodeURI(phone);
    var sanitizedAddress = encodeURI(address);
  
    // Validate the form values
    if (!nameRegex.test(sanitizedName)) {
      alert('Invalid name');
      return false;
    }
    if (!emailRegex.test(sanitizedEmail)) {
      alert('Invalid email');
      return false;
    }
    if (!phoneRegex.test(sanitizedPhone)) {
      alert('Invalid phone number');
      return false;
    }
    if (!addressRegex.test(sanitizedAddress)) {
      alert('Invalid address');
      return false;
    }
  
    // If all validations pass, show the success message
    alert("Form has successfully submitted with subject: " + sanitizedSubject);
    return true;
}