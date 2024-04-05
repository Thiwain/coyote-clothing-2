function filpAuth() {
  var signUpBox = document.getElementById('signUpBox');
  var signInBox = document.getElementById('signInBox');

  signInBox.classList.toggle('d-none');
  signUpBox.classList.toggle('d-none');
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
document.getElementById('changePwCheck').addEventListener('submit', (event) => {
  event.preventDefault();
  // alert("Please enter");
  var form = new FormData(document.getElementById('changePwCheck'));
  var warn = document.getElementById('chngPwWrn');

  if (form.get('curpw') == '') {
    warn.className = 'text-danger';
    warn.innerHTML = 'please fill the password';
  } else if (form.get('newpw') == '') {
    warn.className = 'text-danger';
    warn.innerHTML = 'please fill the new password';
  } else if (form.get('repw') == '') {
    warn.className = 'text-danger';
    warn.innerHTML = 'please confirm the password';
  } else {
    const url = 'changePwProcess.php';
    const method = 'POST';
    const status = true;

    ajaxRequest(url, method, status, form)
      .then((result) => {
        if (result == 'Password is changed') {
          warn.className = 'text-success';
          warn.innerHTML = result;
        } else {
          warn.className = 'text-danger';
          warn.innerHTML = result;
        }
      })
      .catch((error) => {});
  }
});
// change pw verify

//save profile changes
document
  .getElementById('saveProfileChangesForm')
  .addEventListener('submit', (event) => {
    event.preventDefault();

    var form = new FormData(document.getElementById('saveProfileChangesForm'));
    const url = 'saveProfilechanges.php';
    const method = 'POST';
    const status = true;

    ajaxRequest(url, method, status, form)
      .then((result) => {
        alert(result);
      })
      .catch((error) => {});
  });
//save profile changes

function resetPw() {
  var form = new FormData(document.getElementById('resetPasswordFormS'));
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
    .catch((error) => {});
}

function toSPV(id) {
  alert(id);
  const url = 'singleProductView.php?id=' + id;
  window.location = url;
}

function addToCartHome(pid, event) {
  event.preventDefault();
  // alert(pid);
  var form = new FormData();
  form.append('pid', pid);
  const url = 'addToCartHomeProcess.php';
  const method = 'POST';
  const status = true;

  ajaxRequest(url, method, status, form)
    .then((result) => {
      if (result == 'toSignUp') {
        window.location = 'account.php';
      }
    })
    .catch((error) => {});
}

function addtoCartSp(event, pid) {
  event.preventDefault();

  var activeRadioButton = document.querySelector(
    '.product__details__option__size label.active input[type="radio"]'
  );

  if (activeRadioButton) {
    var varient = activeRadioButton.id;
    var qty = document.getElementById('prdQty').value;

    // alert(varient + ' ' + qty + ' ' + pid);

    var form = new FormData();
    form.append('pid', pid);
    form.append('varient', varient);
    form.append('qty', qty);
    const url = 'addToCartProductProcess.php';
    const method = 'POST';
    const status = true;

    ajaxRequest(url, method, status, form)
      .then((result) => {
        if (result != 'toSignUp') {
          alert(result);
        } else {
          window.location = 'account.php';
        }
      })
      .catch((error) => {});

    activeRadioButton.checked = true;
  } else {
    console.log('No active radio button found.');
  }
}

function chngImg(event, url) {
  event.preventDefault();
  document.getElementById('mainImgPrdt').src = '' + url + '';
}

function cartDel(event, cid) {
  event.preventDefault();

  var form = new FormData();
  form.append('cid', cid);
  const url = 'deleteFromCart.php';
  const method = 'POST';
  const status = true;

  ajaxRequest(url, method, status, form)
    .then((result) => {
      window.location.reload();
    })
    .catch((error) => {});
}

// function submitCheckout(total) {
//   var form = new FormData(document.getElementById('checkOutForm'));
//   form.append('total', total);
//   form.append('email', document.getElementById('emailCheckout').value);
//   // alert(form.get("rno"));
//   const url = 'checkOutProcess.php';
//   const method = 'POST';
//   const status = true;

//   ajaxRequest(url, method, status, form)
//     .then((result) => {
//       if (/^\d{7}$/.test(result)) {
//         const url = 'invoice.php?id=' + result;
//         window.location = url;
//       } else {
//         alert(result);
//       }
//     })
//     .catch((error) => {
//       console.error('Error:', error);
//     });
// }

function submitCheckout(total) {
  var reciverName = document.getElementById('checkout-reciver-name').value;
  var mobileNumber = document.getElementById('checkout-mobile-number').value;
  var address = document.getElementById('checkout-address').value;
  var email = document.getElementById('checkout-email').value;

  var form = new FormData();
  form.append('total', total);
  form.append('rname', reciverName);
  form.append('rno', mobileNumber);
  form.append('address', address);
  form.append('email', email);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var t = request.responseText;
      console.log(t);
      var obj = JSON.parse(t);
      var email = obj['email'];
      var amount = obj['amount'];
      var order = obj['order_id']; // used in return_url and cancel_url line 260, 262

      // Payment completed. It can be a successful failure.
      payhere.onCompleted = function onCompleted(orderId) {
        console.log('Payment completed. OrderID:' + orderId);
        // Note: validate the payment and show success or failure page to the customer
      };

      // Payment window closed
      payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log('Payment dismissed');
      };

      // Error occurred
      payhere.onError = function onError(error) {
        // Note: show an error page
        console.log('Error:' + error);
      };

      // Put the payment variables here
      var payment = {
        sandbox: true,
        merchant_id: '1221091', // Replace your Merchant ID
        return_url:
          'http://localhost/coyote-clothing/invoice.php?id=' + product_id, // Important
        cancel_url:
          'http://localhost/coyote-clothing/invoice.php?id=' + product_id, // Important
        notify_url: 'http://sample.com/notify',
        order_id: obj['id'],
        items: obj['items'],
        amount: amount,
        currency: 'LKR',
        hash: obj['hash'], // *Replace with generated hash retrieved from backend
        first_name: obj['first_name'],
        last_name: obj['last_name'],
        email: email,
        address: obj['address'],
        city: obj['city'],
        country: 'Sri Lanka',
        delivery_address: obj['address'],
        delivery_country: 'Sri Lanka',
      };

      // Show the payhere.js popup, when "PayHere Pay" is clicked
      //document.getElementById('payhere-payment').onclick = function (e) {
      payhere.startPayment(payment);
      //};
    }
  };

  request.open('POST', 'checkOutProcess.php', true);
  request.send(form);
}


// function submitCheckout(total) {
//     var reciverName = document.getElementById('checkout-reciver-name').value;
//     var mobileNumber = document.getElementById('checkout-mobile-number').value;
//     var address = document.getElementById('checkout-address').value;
//     var email = document.getElementById('checkout-email').value;

//     var form = new FormData();
//     form.append('total', total);
//     form.append('rname', reciverName);
//     form.append('rno', mobileNumber);
//     form.append('address', address);
//     form.append('email', email);

//     var request = new XMLHttpRequest();

//     request.onreadystatechange = function () {
//         if (request.status == 200 && request.readyState == 4) {
//             var t = request.responseText;
//             console.log(t);
//             var obj = JSON.parse(t);
//             var email = obj['email'];
//             var amount = obj['amount'];
//             var order = obj['order_id']; // used in return_url and cancel_url line 260, 262

//             // Payment completed. It can be a successful failure.
//             payhere.onCompleted = function onCompleted(orderId) {
//                 console.log('Payment completed. OrderID:' + orderId);
//                 // Note: validate the payment and show success or failure page to the customer
//             };

//             // Payment window closed
//             payhere.onDismissed = function onDismissed() {
//                 // Note: Prompt user to pay again or show an error page
//                 console.log('Payment dismissed');
//             };

//             // Error occurred
//             payhere.onError = function onError(error) {
//                 // Note: show an error page
//                 console.log('Error:' + error);
//             };

//             // Put the payment variables here
//             var payment = {
//                 sandbox: true,
//                 merchant_id: '1221091', // Replace your Merchant ID
//                 return_url:
//                     'http://localhost/coyote-clothing/invoice.php?id=' + product_id, // Important
//                 cancel_url:
//                     'http://localhost/coyote-clothing/invoice.php?id=' + product_id, // Important
//                 notify_url: 'http://sample.com/notify',
//                 order_id: obj['id'],
//                 items: obj['items'],
//                 amount: amount,
//                 currency: 'LKR',
//                 hash: obj['hash'], // *Replace with generated hash retrieved from backend
//                 first_name: obj['first_name'],
//                 last_name: obj['last_name'],
//                 email: email,
//                 address: obj['address'],
//                 city: obj['city'],
//                 country: 'Sri Lanka',
//                 delivery_address: obj['address'],
//                 delivery_country: 'Sri Lanka',
//             };

//             // Show the payhere.js popup, when "PayHere Pay" is clicked
//             //document.getElementById('payhere-payment').onclick = function (e) {
//             payhere.startPayment(payment);
//             //};
//         }
//     };

//     request.open('POST', 'checkOutProcess.php', true);
//     request.send(form);
// }
