var searchinput = document.querySelector('#search');
var boxsearch = document.querySelector('.wrapper-box');

searchinput.addEventListener('input', () => {
    let xml = new XMLHttpRequest();


    if(searchinput.value === ''){
        boxsearch.classList.remove('active');
      }


    xml.onreadystatechange = function () {
        if (this.readyState === 4) {
            if (this.status === 200) {
                let response = JSON.parse(this.responseText);
              console.log(response);
              boxsearch.innerHTML = '';

             

              if(response && response.length > 0) {
                let ul = document.createElement('ul');
                ul.classList.add('listsearch');
                boxsearch.appendChild(ul);
                response.forEach((wiki,index) => {
                    
                        let li = document.createElement('div');
                        li.innerHTML =  `<img src="data:image/jpeg;base64,${wiki.wikiImage}">

                        <div class="infos d-flex gap-5">
                        <div class="leftinfos">
                        <h5>${wiki.wikiTitle}</h5>
                        <p>${wiki.categoryName}</p>
                        </div>
                       
                        </div>
                        
                        `;
                        li.setAttribute('data-key' , wiki.wikiId);
                        li.onclick = function() {
                            headerlocation(wiki.wikiId);
                        };
                        li.classList.add('lisearch');
                        ul.appendChild(li);
                });
              }
              else {
                let li = document.createElement('li');
                li.textContent = "Nothing was found ";
                boxsearch.appendChild(li);
              }



              boxsearch.classList.add('active');
             
            }
        }
    }

    xml.open('POST', 'home/searchbar', true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send(`search=${searchinput.value}`);
});








const dropZoneElement = document.querySelector('.drop-zone');
const fileInput = document.getElementById('myFileInput');

dropZoneElement.addEventListener('click',e=> {
    fileInput.click();
})

fileInput.addEventListener('change',e=> {
    if(fileInput.files.length) {
        updateThumbnail(dropZoneElement,fileInput.files[0]);
    }
})

dropZoneElement.addEventListener('dragover', e => {
    e.preventDefault();
    dropZoneElement.classList.add('drag-over');
});

dropZoneElement.addEventListener('dragleave', e => {
    e.preventDefault();
    dropZoneElement.classList.remove('drag-over');
});

dropZoneElement.addEventListener('drop', e => {
    e.preventDefault();
    
    
    
    if(e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        updateThumbnail(dropZoneElement,fileInput.files[0]);
    }

    dropZoneElement.classList.remove('drag-over');
});

function updateThumbnail (dropZoneElement,file) {
    let thumbnail = dropZoneElement.querySelector('.drop-zone__thumb');

    if(dropZoneElement.querySelector('.drop-zone__prompt')){
        dropZoneElement.querySelector('.drop-zone__prompt').remove();
    }
    
    if(!thumbnail) {
        thumbnail = document.createElement('div');
        thumbnail.classList.add('drop-zone__thumb');
        dropZoneElement.appendChild(thumbnail);
    }

        if(file.type.startsWith("image/")){
            const reader = new FileReader();

            reader.readAsDataURL(file);
            reader.onload = () => {
                thumbnail.style.backgroundImage = `url('${reader.result}')`;
            };
        }
        else {
            thumbnail.style.backgroundImage = null;
        }
}





var titletext = document.querySelector('#titletext').textContent;
document.querySelector('#titleinput').addEventListener('input', e => {
    if(e.target.value !== ''){
        document.querySelector('#titletext').textContent = e.target.value;
    }
    else{
        document.querySelector('#titletext').textContent = titletext;
    }
});


//submititng a form for adding
document.querySelector('#submit').addEventListener('click' , () => {
    document.querySelector('.myForm').submit();
})








function headerlocation(element) {
    console.log(element);

    window.location.href = `home/wikiindex/${element}`;
}