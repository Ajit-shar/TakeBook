function validateForm() {
    let isValid = true;
    let name = document.forms["profileForm"]["full_name"].value;
    let email = document.forms["profileForm"]["email"].value;
    let mobile = document.forms["profileForm"]["mobile"].value;
    let address = document.forms["profileForm"]["address"].value;
    let nameErr = emailErr = mobileErr = addressErr = "";

    if (name == "") {
        nameErr = "Full name is required.";
        isValid = false;
    }
    let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        emailErr = "Invalid email format.";
        isValid = false;
    }
    let mobilePattern = /^[0-9]{10}$/;
    if (!mobilePattern.test(mobile)) {
        mobileErr = "Valid 10-digit mobile number is required.";
        isValid = false;
    }
    if (address == "") {
        addressErr = "Address is required.";
        isValid = false;
    }

    document.getElementById("nameErr").innerText = nameErr;
    document.getElementById("emailErr").innerText = emailErr;
    document.getElementById("mobileErr").innerText = mobileErr;
    document.getElementById("addressErr").innerText = addressErr;

    return isValid;
}