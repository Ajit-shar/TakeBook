function validateForm() {
    let email = document.forms[0]["email"].value;
    let contact = document.forms[0]["contact"].value;
    let password = document.forms[0]["password"].value;
    let confirm_password = document.forms[0]["confirm_password"].value;

    let emailPattern = /^[\w\.\-]+@[\w\-]+\.[a-zA-Z]{2,4}$/;
    let contactPattern = /^(98|97|96)\d{8}$/;

    if (!emailPattern.test(email)) {
        alert("Valid email is required");
        return false;
    }

    if (!contactPattern.test(contact)) {
        alert("Contact must be 10 digits and start with 98, 97, or 96");
        return false;
    }

    if (password !== confirm_password) {
        alert("Passwords do not match");
        return false;
    }
    return true;
}