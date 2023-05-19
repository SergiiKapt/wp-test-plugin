window.onload = function (e) {

    const propertyBtn = document.querySelectorAll('.property_filter_submit')
    propertyBtn.forEach(btn => {
        btn.addEventListener('click', () => sendForm(btn))
    })

    function sendForm(btn) {
        let formData = new FormData(btn.parentNode.parentNode);
        formData.append('action', 'property_filter')
        postData(ksaRealEstateAjaxurl.url, formData)
            .then(response => response.json())
            .then((data) => {
                render(btn.parentNode.parentNode.parentNode, data)
            });
    }

    async function postData(url = "", data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: "POST",
            body: data,
        });
        return response;
    }

    function render(container, data) {
        let divIsset = container.querySelector('.property_filter_result')
        if (divIsset) {
            container.removeChild(divIsset)
        }
        let div = document.createElement('div'); // is a node
        div.setAttribute("class", "property_filter_result");
        div.innerHTML = data.data.html;
        container.appendChild(div)
        pagInit()
    }

    function pagInit() {
        let parents = document.querySelectorAll('.property_filter');
        for (let i = 0, parent; parent = parents[i]; i++) {
            parent.onclick = function (e) {
                if (e.target.className == 'propery_filter_paginate_item') {
                    let formData = new FormData(this.querySelector('.property_filter_form'));
                    formData.append('action', 'property_filter')
                    formData.append('page', e.target.dataset.page)
                    postData(ksaRealEstateAjaxurl.url, formData)
                        .then(response => response.json())
                        .then((data) => {
                            render(this, data)
                        });
                }
            }
        }
    }
}