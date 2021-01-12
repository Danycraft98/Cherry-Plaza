function edit_card(element) {
    if (element.innerText.includes('Edit')) {
        const icon = document.createElement('i');
        icon.setAttribute('class', 'fa fa-save');
        element.innerHTML = '';
        element.appendChild(icon);
        element.innerHTML += ' Save';
        element.setAttribute('onclick', 'this.form.submit()')
        const card = document.getElementById(element.id.split('-')[0]);

        card.querySelectorAll('label').forEach(function (item) {
            item.setAttribute('class', item.className + ' my-2');
        });

        card.querySelectorAll("[class*='value']").forEach(function (item) {
            if (item.id === 'username') {
                item.setAttribute('class', item.className + ' my-2');
            } else {
                let inputElement;
                if (item.id === 'country') {
                    inputElement = document.createElement('select');
                    inputElement.setAttribute('class', 'custom-select');
                    get_country_list(inputElement, item.innerText);
                } else {
                    inputElement = document.createElement('input');
                    inputElement.setAttribute('class', 'form-control');
                    inputElement.value = item.innerText;
                }
                inputElement.setAttribute('id', item.id);
                inputElement.setAttribute('name', item.id);
                item.innerText = '';
                item.appendChild(inputElement);
            }
        });
    }
}