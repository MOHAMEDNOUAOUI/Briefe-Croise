document.addEventListener('DOMContentLoaded', () => {
  const submit = document.querySelector('#submit');

  submit.addEventListener('click', (event) => {
      event.preventDefault(); // Prevent default form submission

      const email = document.querySelector('#email').value;
      const username = document.querySelector('#username').value;
      const password = document.querySelector('#password').value;
      const verifyPassword = document.querySelector('#verifypassword').value;

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;

      let isValid = true;

      if (!emailRegex.test(email)) {
          isValid = false;
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Please enter a valid email address",
            showConfirmButton: false,
            timer: 2000
          });
      }

      else if (username.length === 0) {
          isValid = false;
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Please enter your username",
            showConfirmButton: false,
            timer: 2000
          });
      }

      else if (!passwordRegex.test(password)) {
          isValid = false;
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Password must be between 6 to 20 characters and contain at least one numeric digit, one uppercase and one lowercase letter",
            showConfirmButton: false,
            timer: 5000
          });
      }

      else if (password !== verifyPassword) {
          isValid = false;
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Passwords do not match",
            showConfirmButton: false,
            timer: 5000
          });
      }

      if (isValid) {
          let xml = new XMLHttpRequest();

          xml.onreadystatechange = function () {
              if (this.readyState === 4) {
                  if (this.status === 200) {
                      if (this.responseText === 'ACCOUNT ALREADY EXIST') {
                          Swal.fire({
                              position: "top-end",
                              icon: "error",
                              title: "Account already exists",
                              showConfirmButton: false,
                              timer: 1500
                          });
                      } else {
                          const Toast = Swal.mixin({
                              toast: true,
                              position: "top-end",
                              showConfirmButton: false,
                              timer: 3000,
                              timerProgressBar: true,
                              didOpen: (toast) => {
                                  toast.onmouseenter = Swal.stopTimer;
                                  toast.onmouseleave = Swal.resumeTimer;
                              }
                          });
                          Toast.fire({
                              icon: "success",
                              title: "Signed in successfully"
                          });

                          setTimeout(() => {
                              window.location.href = 'indexlogin'; 
                          }, 3000);
                      }
                  }
              }
          };

          xml.open('POST', 'register');
          xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xml.send(`email=${email}&username=${username}&password=${password}`);
      }
  });
});
