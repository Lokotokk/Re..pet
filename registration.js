function validate(form) {
    fail = validateLogin(form.login.value);
    fail += validatePassword(form.password.value);
    fail += validatePasswords(form.confirm.value, form.password.value);
    fail += validateEmail(form.email.value);
    if (fail == "") return true
    else { 
        alert(fail); 
        return false 
    }
}

function validateLogin(field) {
    return (field == "") ? "Не введено имя.\n" : ""
}

function validatePassword(field) {
    if (field == "") return "Не введен пароль.\n"
    else if (field.length < 6)
    return "В пароле должно быть не менее 6 символов.\n"
    else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) ||
    !/[0-9]/.test(field))
    return "Пароль требует 1 символа из каждого набора a-z, A-Z и 0-9.\n"
    return ""
}

function validatePasswords(field, fieldNext) {
    if (field != fieldNext) return "Пароли не совпадают.\n"
    return ""    
}

function validateEmail(field)
{
if (field == "") return "Не введен адрес электронной почты.\n"
    else if (!((field.indexOf(".") > 0) &&
            (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field))
    return "Электронный адрес имеет неверный формат.\n"
return ""
}