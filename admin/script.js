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

var AddProductId = null;

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

function AddProduct() {

  var category = document.getElementById('category');
  var item = document.getElementById('item');
  var homeList = document.getElementById('homeList');
  var title = document.getElementById('title');
  var desc = document.getElementById('desc');
  var price = document.getElementById('price');
  /* desc, title, homeList, item, category */

  var formData = new FormData();
  formData.append('title', title.value);
  formData.append('desc', desc.value);
  formData.append('homeList', homeList.value);
  formData.append('item', item.value);
  formData.append('category', category.value);
  formData.append('price', price.value);

  var url = 'addProductProcess.php';
  var method = 'POST';
  var status = true;
  ajaxRequest(url, method, status, formData)
    .then((result) => {
      alert(result);
      AddProductId = result;
      document.getElementById('varientBox').classList = "d-flex"
    })
    .catch((error) => {
    });
}

if (AddProductId = !null) {
  document.getElementById('varientBox').classList = "d-flex"
}

function addVarientFn() {
  var vname = document.getElementById("vName");
  var vqty = document.getElementById("vQty");

  var formData = new FormData();
  formData.append('vName', vname.value);
  formData.append('vQty', vqty.value);
  formData.append('pid', AddProductId);

  var url = 'addProductVarientsProcess.php';
  var method = 'POST';
  var status = true;
  ajaxRequest(url, method, status, formData)
    .then((result) => {
      alert(result);

    })
    .catch((error) => {
    });


}
// alert(AddProductId);
function changeProductImage() {

  var image = document.getElementById("imageuploader1");

  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 3) {

      for (var x = 0; x < file_count; x++) {

        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("i" + x).src = url;
      }

    } else {
      alert(file_count + " files. You are proceed to upload only 3 or less than 3 files.");
    }
  }

}

function changeProductImage2() {

  var image = document.getElementById("imageuploader");

  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 1) {

      for (var x = 0; x < file_count; x++) {

        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("i" + x).src = url;
      }

    } else {
      alert(file_count + " files. You are proceed to upload only 3 or less than 3 files.");
    }
  }

}

function addProductProcess() {

  // var image1 = document.getElementById("imageuploader1");
  var image = document.getElementById("imageuploader");

  var formData = new FormData();
  // FormData.append("image1", image1.files[1]);

  for (var x = 0; x < file_count; x++) {
    FormData.append("image" + x, image.files[x]);
    FormData.append("Pid", AddProductId);
  }

  var url = 'saveProductProcess.php';
  var method = 'POST';
  var status = true;
  ajaxRequest(url, method, status, formData)
    .then((result) => {


    })
    .catch((error) => {
    });

}

function deleteProduct(id) {
  var formData = new FormData();
  formData.append('id', id);
  var url = 'DelProductProcess.php';
  var method = 'POST';
  var status = true;
  ajaxRequest(url, method, status, formData)
    .then((result) => {


    })
    .catch((error) => {
    });
}