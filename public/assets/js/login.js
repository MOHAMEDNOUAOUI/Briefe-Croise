var email = document.querySelector('#email').value;
var password = document.querySelector('#password').value;


var send = document.querySelector('#submit');

send.addEventListener('click' , (event)=>{
    event.preventDefault();
    var email = document.querySelector('#email').value;
var password = document.querySelector('#password').value;
    let xml = new XMLHttpRequest();

    xml.onreadystatechange = function () {
        if(this.status==200){
           var response = JSON.parse(this.responseText);
           console.log(response);
           if(response.status === 'error'){
            if(response.message === 'Password is incorrect'){
                Swal.fire(response.message);
            }
            else if(response.message === 'Account doesnt Exist') {
                Swal.fire(response.message);
            }
           }
           else if (response.status === 'success'){
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
                title: "Welcome on board"
              });

              setTimeout(() => {
                    window.location.href = response.page;
              }, 3000);
              
           }
        }
    }

    xml.open('POST' , 'login');
    xml.setRequestHeader('Content-type' , 'application/x-www-form-urlencoded');
    xml.send(`email=${email}&password=${password}`);
})