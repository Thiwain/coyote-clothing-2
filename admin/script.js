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
