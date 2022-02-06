message = document.querySelector('.message');
login = document.querySelector('.login-inp');
email = document.querySelector('.email-inp');
username = document.querySelector('.username-inp');
pass1 = document.querySelector('.pass1-inp');
pass2 = document.querySelector('.pass2-inp');

loginOk = false;
emailOk = false;
pass1ok = false;
pass2ok = false;
passEqual = false;
button = document.querySelector('.register-action-btn');

button.addEventListener('click', reggData);

login.addEventListener('input', e => {
    isLoginAvailable();
});
email.addEventListener('input', e => {
    isEmailAvailable();
});


function isLoginAvailable() {
    loginOk = false;
    data = {
        'login': login.value
    }
    data = JSON.stringify(data);
    console.log(data);
    fetch("/isLoginAvailable", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: data
    })
        .then(res => res.json())
        .then(res => {
            if (res.count > 0) {
                message.innerHTML = "podany login jest juz zajęty";
                loginOk = false;
            } else {
                message.innerHTML = "";
                loginOk = true;
            }
        })
}

function isEmailAvailable() {
    emailOk = false;
    data = {
        'email': email.value
    }
    data = JSON.stringify(data);
    console.log(data);
    fetch("/isEmailAvailable", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: data
    })
        .then(res => res.json())
        .then(res => {
            if (res.count > 0) {
                message.innerHTML = "podany email jest juz zajęty";
                emailOk = false;
            } else {
                message.innerHTML = "";
                emailOk = true;
            }
        })
}


function reggData() {

    pass1ok = passwordRexExpr(pass1);
    pass2ok = passwordRexExpr(pass2);
    passEqual = pass1.value === pass2.value;

    console.log(loginOk , emailOk , pass1ok , pass2ok , passEqual);
    if (loginOk && emailOk && pass1ok && pass2ok && passEqual) {

        document.querySelector('.register-form').submit();
    }


}

function passwordRexExpr(inp) {
    var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");
    const res = mediumRegex.test(inp.value);
    if (!res)
        inp.style.backgroundColor = 'rgba(255,0,0,0.1)';
    else
        inp.style.backgroundColor = 'white';

    return res;
}