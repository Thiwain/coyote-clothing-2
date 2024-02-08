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
    const url = 'changePwProcess.php';
    const method = 'POST';
    const status = true;
    ajaxRequest(url, method, status, form)
        .then((result) => {
        })
        .catch((error) => {

        });
});
// change pw verify