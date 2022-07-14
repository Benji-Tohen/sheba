function loadMoreUpdates(numOfItems) {
    var limit = numOfItems;
    var start = $('#updatesFeed').children().length;
    var pageid = $('#updatesFeed').attr('pageid');

    $.ajax({
        method: "POST",
        url: "ajax/library_updates",
        data: { 
            pageid: pageid,
            start: start,
            limit: limit
        }
    }).done(function( data ) {
        var jsonResponse = JSON.parse(data);
        createItemsFromResponse(jsonResponse);

        if(jsonResponse.total_items <= $('#updatesFeed').children().length){
            $('#loadMoreUpdatesBtn').hide();
        }
    });
}

function createItemsFromResponse(jsonResponse) {
    if(jsonResponse.items > 0){
        jsonResponse.data.forEach(appendNewUpdateItemExpended);
    } else {
        $('#loadMoreUpdatesBtn').hide();
    }
}

function appendNewUpdateItemExpended(itemData) {
    var itemElem = $(`
        <div class="updates-item">
            <div class="container">
                <a class="updates-item-link" href="`+itemData.url+`" target="`+itemData.target+`">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <img class="updates-item-img img-fluid" src="`+itemData.thumb+itemData.img+`" />
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="updates-item-title">`+itemData.title+`</div>
                            <div class="updates-item-subtitle">`+itemData.sub_title+`</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    `);

    $('#updatesFeed').append(itemElem);
}


function loadServices(numOfItems) {
    var limit = numOfItems;
    var start = $('#servicesFeed').children().length;
    var pageid = $('#servicesFeed').attr('pageid');

    $.ajax({
        method: "POST",
        url: "ajax/library_services",
        data: { 
            pageid: pageid,
            start: start,
            limit: limit
        }
    }).done(function( data ) {
        var jsonResponse = JSON.parse(data);
        createServicesItemsFromResponse(jsonResponse);
    });
}

function createServicesItemsFromResponse(jsonResponse) {
    if(jsonResponse.items > 0){
        jsonResponse.data.forEach(appendNewServicesItem);
    }
}

function appendNewServicesItem(itemData) {
    var itemElem = $(`
        <div class="services-item">
            <div class="container">
                <a class="services-item-link" href="`+itemData.url+`" target="`+itemData.target+`">
                    <div class="row">
                        <div class="col-md-2 col-12  service-item-side">
                            <img class="services-item-img img-fluid" src="`+itemData.thumb+itemData.img+`" />
                        </div>
                        <div class="col-md-10 col-12 service-item-side">
                            <div class="services-item-title">`+itemData.title+`</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    `);

    $('#servicesFeed').append(itemElem);
}

$(document).ready(function() {
    loadMoreUpdates(10);
    loadServices(100);
});