var statusButtons = document.querySelectorAll('.btnstatus');

statusButtons.forEach(function(btn) {
    btn.addEventListener('click', () => {
        let wikiId = btn.value;
        let newStatus;

        if (btn.classList.contains('btn-success')) {
            btn.classList.remove('btn-success');
            btn.classList.add('btn-danger');
            newStatus = 'archived'; 
        } else {
            btn.classList.remove('btn-danger');
            btn.classList.add('btn-success');
            newStatus = 'active'; 
        }

        changeStatus(wikiId, newStatus, btn); 
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Succefuly changed",
            showConfirmButton: false,
            timer: 1500
          });
        btn.innerText = newStatus; 
    });
});

function changeStatus(id, status, btn) {
    let xml = new XMLHttpRequest();

    xml.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
    
        }
    }

    xml.open('POST', 'dashboard/change_status');
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send('wikiId=' + id + '&status=' + status);
}







//category  delete

var deletebutton = document.querySelectorAll('.delete');

deletebutton.forEach((btn) => {
    btn.addEventListener('click', () => {
        var categoryId = btn.value;

       
        if(btn.classList.contains('category')){
            Swal.fire({
                title: "Are you sure?",
                text: "deleting a category may cause deleting Articles that contains it!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
              }).then((result) => {
                if (result.isConfirmed) {
                    let xml = new XMLHttpRequest();
    
                    xml.onreadystatechange = function () {
                        if(this.status==200){
                            // Swal.fire({
                            //     title: "Deleted!",
                            //     text: "Your file has been deleted.",
                            //     icon: "success"
                            //   });
    
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                              });
    
                              setTimeout(() => {
                                    location.reload();
                              }, 2000);
                        }
                    }
    
                    xml.open('POST' , 'delete');
                    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xml.send('categoryId='+categoryId);
                }
              });
        }

        else if(btn.classList.contains('tag')){
             Swal.fire({
            title: "Are you sure?",
            text: "deleting a tag may cause disattaching Tags from Articles that contains it!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
                let xml = new XMLHttpRequest();

                xml.onreadystatechange = function () {
                    if(this.status==200){

                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                          });

                          setTimeout(() => {
                                location.reload();
                          }, 2000);
                    }
                }

                xml.open('POST' , 'delete');
                xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xml.send('tagId='+categoryId);
            }
          });
        }
    });
});


//category modify 

var modifybutton = document.querySelectorAll('.modify');

modifybutton.forEach((btn)=>{
    btn.addEventListener('click' , ()=>{
        var Id = btn.value;

        var row = btn.closest('tr');

        const Name = row.querySelector('td').textContent.trim();

        if(btn.classList.contains('category')){
            (async () => {
                const { value: category } = await Swal.fire({
                  title: "CATEGORY",
                  input: "text",
                  inputLabel: "Your category name",
                  inputValue: Name,
                  inputPlaceholder: "Enter the new categoey name"
                });
                if (category) {
                  let xml = new XMLHttpRequest();
    
                  xml.onreadystatechange = function () {
                    if(this.status==200){
                        Swal.fire(`Category name: ${category}`);
    
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                  }
    
                  xml.open('POST' , 'modify');
                  xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                  xml.send('categoryId='+Id+'&input='+category);
                }
              })()
        }
        else if(btn.classList.contains('tag')) {
            (async () => {
                const { value: tag } = await Swal.fire({
                  title: "TAG",
                  input: "text",
                  inputLabel: "Your tag name",
                  inputValue: Name,
                  inputPlaceholder: "Enter the new tag name"
                });
                if (tag) {
                  let xml = new XMLHttpRequest();
                  xml.onreadystatechange = function () {
                    if(this.status==200){
                        Swal.fire(`Tag name: ${tag}`);
                        
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                  }
    
                  xml.open('POST' , 'modify');
                  xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                  xml.send('tagId='+Id+'&input='+tag);
                }
              })()
        };
    })
})





document.addEventListener('DOMContentLoaded' , () =>{
    var addcategorybutton = document.querySelector('#ADDCATE');
    if(addcategorybutton){
        addcategorybutton.addEventListener('click' , ()=>{
            (async () => {
                const { value: categoryname } = await Swal.fire({
                  input: "text",
                  inputLabel: "category section",
                  inputPlaceholder: "Enter the category name"
                });
                if (categoryname) {
                  let xml = new XMLHttpRequest();
        
                  xml.onreadystatechange = function () {
                    if(this.status==200){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Category added succefully",
                            showConfirmButton: false,
                            timer: 1500
                          });
        
                          setTimeout(() => {
                            location.reload();
                          }, 2000);
                    }
                  }
        
                  xml.open('POST' , 'add');
                  xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                  xml.send('categoryName='+categoryname);
                }
              })()
        })
    }
})





document.addEventListener('DOMContentLoaded' , ()=>{
    var addtagsbutton = document.getElementById('ADDTAGS');
    if(addtagsbutton) {
        addtagsbutton.addEventListener('click' , ()=>{
            (async () => {
                const { value: tagName } = await Swal.fire({
                  input: "text",
                  inputLabel: "Tags section",
                  inputPlaceholder: "Enter the tag name"
                });
                if (tagName) {
                  let xml = new XMLHttpRequest();
        
                  xml.onreadystatechange = function () {
                    if(this.status==200){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Tag added succefully",
                            showConfirmButton: false,
                            timer: 1500
                          });
        
                          setTimeout(() => {
                            location.reload();
                          }, 2000);
                    }
                  }
        
                  xml.open('POST' , 'add');
                  xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                  xml.send('tagName='+tagName);
                }
              })()
        })
    }

})


