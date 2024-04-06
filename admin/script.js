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

function deleteUser(user_id) {
  var formData = new FormData();
  formData.append('user_id', user_id);
  var url = 'deleteUser.php';
  var method = 'POST';
  var status = true;

  ajaxRequest(url, method, status, formData)
    .then((result) => {
      console.log(result);
      if (result === 'delete') {
        window.location = 'list-user.php';
      } else {
        alert(result);
      }
    })
    .catch((error) => {
      console.error(error);
      alert(error);
    });
}

const isValidEmail = (email) => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
};

function sendVcodefn() {
  var PwForm = document.getElementById("adminPwModal");
  var formData = new FormData(PwForm);
  var email = formData.get('email');

  if (!isValidEmail(email)) {
    document.getElementById("fpwMoadlWrn").innerHTML = "Invalid email format";
    return;
  } else {
    var url = 'sendAdminVcodeProcess.php';
    var method = 'POST';
    var status = true;
    ajaxRequest(url, method, status, formData)
      .then((result) => {
        document.getElementById("fpwMoadlWrn").className = "text-success";
        document.getElementById("fpwMoadlWrn").innerHTML = result;
        alert(result);
        console.log(result);
      })
      .catch((error) => {
        document.getElementById("fpwMoadlWrn").innerHTML = error;
        alert(error);
      });

  }
}

// to the admin home 

function adminHome() {
  alert("admin home")
  var fPwForm = document.getElementById("adminPwModal");
  var formData = new FormData(fPwForm);
  var email = formData.get('email');
  var vcode = formData.get('vcode');

  if (!isValidEmail(email)) {
    document.getElementById("fpwMoadlWrn").innerHTML = "Invalid email format";
  } else {
    var url = 'vCodeVerifyProcess.php';
    var method = 'POST';
    var status = true;
    ajaxRequest(url, method, status, formData)
      .then((result) => {
        // alert(result)
        window.location.reload();
      })
      .catch((error) => {
        document.getElementById("fpwMoadlWrn").innerHTML = error;
        alert(error);
      });
  }

}

function orderInfo(id) {
  // alert(id);
  const url = 'invoice.php?id=' + id;
  window.location = url;
}

function fulfillOrder(id) {
  // alert(id);
  var formData = new FormData();
  formData.append('id', id);
  var url = 'fulfillOrderProcess.php';
  var method = 'POST';
  var status = true;
  ajaxRequest(url, method, status, formData)
    .then((result) => {
      alert(result);
      window.location.reload();
    })
    .catch((error) => {

    });
}

function itemInput() {
  var itemId = document.getElementById('itemInput').value;
  var cat = document.getElementById('category').value;

  var formData = new FormData();
  formData.append('item', itemId);
  formData.append('cat', cat);
  var url = 'addItemProcess.php';
  var method = 'POST';
  var status = true;
  ajaxRequest(url, method, status, formData)
    .then((result) => {
      alert(result);
    })
    .catch((error) => {

    });
}