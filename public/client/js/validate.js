function valEmail(email) {
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

function validateNoSpecialChars(string) {
    var pattern = /^[\p{L}\p{N}\s!@$%&?*:\[\]]+$/u;
    return pattern.test(string);
}

function valPassword(string) {
    var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return pattern.test(string);
}

function valPhoneNumber(phoneNumber) {
    // Sử dụng biểu thức chính quy để kiểm tra định dạng số điện thoại
    const phoneNumberPattern = /^0\d{9,11}$/;

    // Kiểm tra xem số điện thoại có hợp lệ không
    return phoneNumberPattern.test(phoneNumber);
}

function validatePhoneNumber() {
    const phoneNumber = document.querySelector('input[name="phone_number"]').value.trim();
    const phoneNumberError = document.getElementById('phone_number_err');

    if (phoneNumber === "") {
        phoneNumberError.textContent = "Số diện thoại không được để trống";
        phoneNumberError.style.color = 'red'
        return false;
    } else if (!valPhoneNumber(phoneNumber)) {
        phoneNumberError.textContent = "Số điện thoại không hợp lệ";
        phoneNumberError.style.color = 'red'
        return false;
    } else {
        phoneNumberError.textContent = "";
        phoneNumberError.style.color = 'red'
        return true;
    }
}

function validateEmail() {
    const email = document.querySelector('input[name="email"]').value.trim();
    const emailError = document.getElementById('email_err');

    if (email === "") {
        emailError.textContent = "Email không được để trống";
        emailError.style.color = 'red'
        return false;
    } else if (!valEmail(email)) {
        emailError.textContent = "Email không hợp lệ";
        emailError.style.color = 'red'
        return false;
    } else {
        emailError.textContent = "";
        emailError.style.color = 'red'
        return true;
    }
}

function validateFullName() {
    const fullName = document.querySelector('input[name="full_name"]').value.trim();
    const fullNameError = document.getElementById('full_name_err');

    if (fullName === "") {
        fullNameError.textContent = "Tên người dùng không được để trống";
        fullNameError.style.color = 'red'
        return false;
    } else if (!validateNoSpecialChars(fullName)) {
        fullNameError.textContent = "Tên người dùng không được chứa ký tự đặc biệt";
        fullNameError.style.color = 'red'
        return false;
    } else {
        fullNameError.textContent = "";
        fullNameError.style.color = 'red'
        return true;
    }
}

function validateAccountName() {
    const accountName = document.querySelector('input[name="account_name"]').value.trim();
    const accountNameError = document.getElementById('account_name_err');

    if (accountName === "") {
        accountNameError.textContent = "Tên tài khoản không được để trống";
        accountNameError.style.color = 'red'
        return false;
    } else if (!validateNoSpecialChars(accountName)) {
        accountNameError.textContent = "Tên tài khoản không được chứa ký tự đặc biệt";
        accountNameError.style.color = 'red'
        return false;
    } else {
        accountNameError.textContent = "";
        accountNameError.style.color = 'red'
        return true;
    }
}
function validateUserName() {
    const userName = document.querySelector('input[name="user_name"]').value.trim();
    const userNameError = document.getElementById('user_name_err');

    if (userName === "") {
        userNameError.textContent = "Tên người dùng không được để trống";
        userNameError.style.color = 'red'
        return false;
    } else if (!validateNoSpecialChars(userName)) {
        userNameError.textContent = "Tên người dùng không được chứa ký tự đặc biệt";
        userNameError.style.color = 'red'
        return false;
    } else {
        userNameError.textContent = "";
        userNameError.style.color = 'red'
        return true;
    }
}

function validatePassword() {
    const password = document.querySelector('input[name="password"]').value.trim();
    const passwordError = document.getElementById('password_err');

    if (password === "") {
        passwordError.textContent = "Mật khẩu không được để trống";
        passwordError.style.color = 'red'
        return false;
    } else if (!valPassword(password)) {
        passwordError.textContent =
            "Mật khẩu phải có ít nhất một chữ hoa, thường, số và 1 trong các ký tự !,@,$,%,&,* (tối thiểu 8 ký tự)";
        passwordError.style.color = 'red'
        return false;
    } else {
        passwordError.textContent = "";
        passwordError.style.color = 'red'
        return true;
    }
}

function validateRetypePassword() {
    const password = document.querySelector('input[name="password"]').value.trim();
    const retypePassword = document.querySelector('input[name="retype_password"]').value.trim();
    const retypePasswordError = document.getElementById('retype_password_err');

    if (retypePassword === "") {
        retypePasswordError.textContent = "Vui lòng xác nhận mật khẩu";
        retypePasswordError.style.color = 'red'
        return false;
    } else if (password !== retypePassword) {
        retypePasswordError.textContent = "Mật khẩu và xác nhận mật khẩu không khớp";
        retypePasswordError.style.color = 'red'
        return false;
    } else {
        retypePasswordError.textContent = "";
        retypePasswordError.style.color = 'red'
        return true;
    }
}

function validateTitleOfPost() {
    const Title = document.querySelector('input[name="title"]').value.trim();
    const TitleError = document.getElementById('title_err');

    if (Title === "") {
        TitleError.textContent = "Tiêu đề không được để trống";
        TitleError.style.color = 'red'
        return false;
    } else if (!validateNoSpecialChars(Title)) {
        TitleError.textContent = "Tiêu đề không được chứa ký tự đặc biệt";
        TitleError.style.color = 'red'
        return false;
    } else {
        TitleError.textContent = "";
        TitleError.style.color = 'red'
        return true;
    }
}

function validateTxtSearch() {
    // const txtSearch = document.querySelector('input[name="txtSearch"]').value.trim();
    const txtSearch = document.getElementById('srch-term').value.trim();

    if (txtSearch === "") {
        return false;
    } else if (!validateNoSpecialChars(txtSearch)) {
        return false;
    } else {
        return true;
    }
}

function validateFormHandelRegister() {
    const isFullNameValid = validateFullName();
    const isAccountNameValid = validateAccountName();
    const isPasswordValid = validatePassword();
    const isRetypePasswordValid = validateRetypePassword();

    return isFullNameValid && isAccountNameValid && isPasswordValid && isRetypePasswordValid;
}

function validateFormSendCode() {
    const isEmailValid = validateEmail();
    return isEmailValid;
}

function validateFormResetPassword() {
    const isPasswordValid = validatePassword();
    const isRetypePasswordValid = validateRetypePassword();
    return isPasswordValid && isRetypePasswordValid;
}

function validateFormLogin() {
    const isUserNameValid = validateUserName();
    const isPasswordValid = validatePassword();
    return isPasswordValid && isUserNameValid;
}

function validateFormCreatePost() {
    const isValidTitle = validateTitleOfPost();
    return isValidTitle;
}

function validateFormSearch() {
    const isValidTxtSearch = validateTxtSearch();
    return isValidTxtSearch;
}

function validateFormEditInfo() {
    const isValidUserName = validateUserName();
    const isValidEmail = validateEmail();
    const isValidPhoneNumber = validatePhoneNumber();
    return isValidUserName && isValidEmail && isValidPhoneNumber;
}

// document.querySelector('input[name="email"]').addEventListener('input', validateEmail);
// document.querySelector('input[name="full_name"]').addEventListener('input', validateFullName);
// document.querySelector('input[name="user_name"]').addEventListener('input', validateUserName);
// document.querySelector('input[name="account_name"]').addEventListener('input', validateAccountName);
// document.querySelector('input[name="password"]').addEventListener('input', validatePassword);
// document.querySelector('input[name="retype_password"]').addEventListener('input', validateRetypePassword);

