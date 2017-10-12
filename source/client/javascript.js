


function httpRequest(method, url, payload, callback) {
    var httpRequest = new XMLHttpRequest();

    httpRequest.onreadystatechange = function () {
        // Process the server response here.
        if (httpRequest.readyState !== XMLHttpRequest.DONE) {
            // Not ready yet
            return
        }

        if (httpRequest.status !== 200) {
            alert('Something went wrong: ' + httpRequest.responseText);
            return
        }

        callback(JSON.parse(httpRequest.responseText));
    };

    httpRequest.open(method, url);
    httpRequest.setRequestHeader('Content-Type', 'application/json');

    if (payload) {
        payload = JSON.stringify(payload)
    }

    httpRequest.send(payload);
}

function getItemsClick(event) {
    var htmlContainer = document.getElementById('items_container');
    htmlContainer.innerHTML = '';

    event.preventDefault();
    hideAllSections();

    httpRequest('GET', 'http://localhost/api/items', undefined, function (data) {
        for (var i = 0; i < data.length; i++) {
            var item = data[i];
            htmlContainer.innerHTML += 
                `<div class="itemBox">
                    
                    <div class="title">${item["name"]}</div>
                    <div class="description">${item["description"]}</div>
                    <div class="price">$${item["price"]}</div>
                
                </div>`;
        }
    });

}

function getItem(id) {

}



function hideAllSections() {

}


function loaded() {
    /// Button Listeners
    document.getElementById("items_btn").addEventListener('click', getItemsClick, false);
    document.getElementById("items_btn").click();
}