var searchinput = document.querySelector('#search');
var boxsearch = document.querySelector('.wrapper-box');
var debounceTimer;

searchinput.addEventListener('input', () => {
    let xml = new XMLHttpRequest();

    xml.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var response = JSON.parse(this.responseText);
            boxsearch.innerHTML = '';

            // category 
                if (response && response.categorys && response.categorys.length > 0) {
                    if (Array.isArray(response.categorys)) {
                        response.categorys.forEach(category => {
                            let li = document.createElement('li');
                            li.textContent = category;
                            boxsearch.appendChild(li);
                        });
                    } else {
                        response.categorys.forEach(category => {
                            let li = document.createElement('li');
                            li.textContent = category;
                            boxsearch.appendChild(li);
                        });
                    }
                    boxsearch.classList.add('active');
                }
                else {
                    let li = document.createElement('li');

                    li.textContent = 'Categoy not found';
                    boxsearch.appendChild(li);
                    boxsearch.classList.add('active');
                }
            

        }
    }

    xml.open('POST', 'home/searchbar', true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send(`search=${searchinput.value}`);
});
