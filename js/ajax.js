//ajaxFunction
function ajaxRequest(reqUrl, method, sts, ajaxform) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.open(method, reqUrl, sts);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    resolve(xhr.responseText);
                } else {
                    reject(xhr.statusText);
                }
            }
        };
        xhr.send(ajaxform);
    });
}
//ajaxFunction

document.addEventListener('DOMContentLoaded', () => {
    //forms
    const signInForm = document.getElementById('signinForm');
    const fPwForm = document.getElementById('forgotPwModal');
    const signUpForm = document.getElementById('signupForm');
    //forms

    //validation
    const isValidEmail = (email) => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    };

    const isValidPassword = (password) => {
        return password.length >= 6;
    };
    //validation

    //Sign In
    signInForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(signInForm);
        var email = formData.get('email');
        var password = formData.get('password');

        if (!isValidEmail(email)) {
            document.getElementById("signInWarn").innerHTML = "Invalid email format";
            return;
        } else if (!isValidPassword(password)) {
            document.getElementById("signInWarn").innerHTML = "Password must be at least 6 characters long";
            return;
        } else {
            var url = 'signInProcess.php';
            var method = 'POST';
            var status = true;
            ajaxRequest(url, method, status, formData)
                .then((result) => {
                    console.log(result);
                    if (result === 'present') {
                        alert(result);//AFTER SIGNIN
                        window.location = 'index.php';
                    } else {
                        document.getElementById("signInWarn").innerHTML = result;
                    }
                })
                .catch((error) => {
                    console.error(error);
                    alert(error);
                });

        }
    });
    //Sign In

    //send verification
    document.getElementById("sendVcode").addEventListener("click", (event) => {
        event.preventDefault();

        var formData = new FormData(fPwForm);
        var email = formData.get('email');

        if (!isValidEmail(email)) {
            document.getElementById("fpwMoadlWrn").innerHTML = "Invalid email format";
            return;
        } else {
            var url = 'sendVcodeProcess.php';
            var method = 'POST';
            var status = true;
            ajaxRequest(url, method, status, formData)
                .then((result) => {
                    document.getElementById("fpwMoadlWrn").className = "text-success";
                    document.getElementById("fpwMoadlWrn").innerHTML = result;
                    console.log(result);
                })
                .catch((error) => {
                    document.getElementById("fpwMoadlWrn").innerHTML = error;
                    alert(error);
                });

        }
    });
    //send verification

    //pass verification
    document.getElementById("fpwContinue").addEventListener("click", (event) => {
        event.preventDefault();
        var formData = new FormData(fPwForm);
        var email = formData.get('email');
        var vcode = formData.get('vcode');

        if (!isValidEmail(email)) {
            document.getElementById("fpwMoadlWrn").innerHTML = "Invalid email format";
        } else if (!isValidPassword(vcode)) {
            document.getElementById("fpwMoadlWrn").innerHTML = "Password must be at least 6 characters long";
        } else {
            var url = 'vCodeVerifyProcess.php';
            var method = 'POST';
            var status = true;
            ajaxRequest(url, method, status, formData)
                .then((result) => {
                    alert(result)
                    document.getElementById("fpwMoadlWrn").innerHTML = result;
                    document.getElementById("fpwMoadlWrn").className = "text-success";
                    console.log(result);
                    window.location = 'resetpassword.php';
                })
                .catch((error) => {
                    document.getElementById("fpwMoadlWrn").innerHTML = error;
                    alert(error);
                });
        }
    });
    // pass verification

    // sign up
    signUpForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const formData = new FormData(signUpForm);
        const url = 'signUpProcess.php';
        const method = 'POST';
        const status = true;
        ajaxRequest(url, method, status, formData)
            .then((result) => {
                if (result != 'pass') {
                    document.getElementById('signUpWrn').className = 'text-danger';
                    document.getElementById('signUpWrn').innerHTML = result;
                } else {
                    document.getElementById('signUpWrn').className = 'text-success';
                    document.getElementById('signUpWrn').innerHTML = 'Account Created Successfully';
                    window.location = 'index.php';
                }
            })
            .catch((error) => {
                document.getElementById('signUpWrn').className = 'text-danger';
                document.getElementById('signUpWrn').innerHTML = error;
            });
    });
    // sign up

});


