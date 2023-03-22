const header = document.querySelector(".fixed-top");

window.addEventListener("scroll", () => {
  if (window.scrollY > 500) {
    header.classList.add("scrolledBg");
  } else {
    header.classList.remove("scrolledBg");
  }
});

function scrollDown() {
  window.scrollBy(0, window.innerHeight);
}

(function () {
  "use strict";

  let forms = document.querySelectorAll(".needs-validation");

  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();

// let errorArray = [];

// let fullName = document.getElementById("fullName").value;
// let nickname = document.getElementById("nickname").value;
// let email = document.getElementById("email").value;
// let birthdayDate = document.getElementById("birthdayDate").value;
// let CINnumber = document.getElementById("CINnumber").value;
// let phoneNumber = document.getElementById("phoneNumber").value;
// let address = document.getElementById("address").value;
// let occupation = document.getElementById("occupation");

// let nameReg = /([A-Z])\w+\s([A-Z\w]+)/;
// let passReg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;
// let emailReg = /^([A-Za-z0-9]\w+(\.?)\w+(\.?)\w+)@(gmail|yahoo|ofppt)\.(com|ma)$/;
// let phoneReg = /^(05|06|07)([0-9]{8})$|^(\+212)-?([0-9]{9})$/;

// fullName.onfocus = function() {
//   if (nameReg.test(fullName)) {

//   }
// };

document.addEventListener('DOMContentLoaded', function () {
  let reserveButton = document.getElementById('reserve');
  reserveButton.addEventListener('click', function () {
    reserveButton.classList.add('onclic');
    validate();
  });

  function validate() {
    setTimeout(function () {
      reserveButton.classList.remove('onclic');
      reserveButton.classList.add('validate');
      callback();
    }, 2250);
  }

  function callback() {
    setTimeout(function () {
      reserveButton.classList.remove('validate');
    }, 1250);
  }
});
