function filpAuth() {
    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");
}

//ajaxFunction
function ajaxRequest(reqUrl, method, sts, ajaxform) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.open(method, reqUrl, sts);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    resolve(xhr.responseText);
                    reqUrl = null;
                    method = null;
                    sts = null;
                    form = null;
                } else {
                    reject(xhr.statusText);
                    reqUrl = null;
                    method = null;
                    sts = null;
                    form = null;
                }
            }
        };
        xhr.send(ajaxform);
    });
}
//ajaxFunction

// change pw verify
document.getElementById("changePwCheck").addEventListener("submit", (event) => {
    event.preventDefault();
    // alert("Please enter");
    var form = new FormData(document.getElementById("changePwCheck"));
    var warn = document.getElementById("chngPwWrn");

    if (form.get('curpw') == "") {
        warn.className = "text-danger";
        warn.innerHTML = 'please fill the password';
    } else if (form.get('newpw') == "") {
        warn.className = "text-danger";
        warn.innerHTML = 'please fill the new password';
    } else if (form.get('repw') == "") {
        warn.className = "text-danger";
        warn.innerHTML = 'please confirm the password';
    } else {

        const url = 'changePwProcess.php';
        const method = 'POST';
        const status = true;

        ajaxRequest(url, method, status, form)
            .then((result) => {
                if (result == 'Password is changed') {
                    warn.className = "text-success";
                    warn.innerHTML = result;
                } else {
                    warn.className = "text-danger";
                    warn.innerHTML = result;
                }
            })
            .catch((error) => {

            });
    }
});
// change pw verify

//save profile changes 
document.getElementById("saveProfileChangesForm").addEventListener("submit", (event) => {
    event.preventDefault();

    var form = new FormData(document.getElementById("saveProfileChangesForm"));
    const url = 'saveProfilechanges.php';
    const method = 'POST';
    const status = true;

    ajaxRequest(url, method, status, form)
        .then((result) => {
            alert(result)
        })
        .catch((error) => {

        });

});
//save profile changes

function resetPw() {
    var form = new FormData(document.getElementById("resetPasswordFormS"));
    const url = 'newPasswordProcess.php';
    const method = 'POST';
    const status = true;

    ajaxRequest(url, method, status, form)
        .then((result) => {
            if (result != 'w') {
                document.getElementById('nPwWarn').className = 'text-danger';
                document.getElementById('nPwWarn').innerHTML = result;
            } else {
                window.location = 'index.php';
            }
        })
        .catch((error) => {

        });
}

function toSPV(id) {
    alert(id);
    const url = 'singleProductView.php?id=' + id;
    window.location = url;
}

function addToCartHome(pid) {
    // alert(pid);
    var form = new FormData();
    form.append('pid', pid);
    const url = 'addToCartHomeProcess.php';
    const method = 'POST';
    const status = true;

    ajaxRequest(url, method, status, form)
        .then((result) => {
            if (result == 'toSignUp') {
                window.location ='account.php';
            }
        })
        .catch((error) => {

        });
}