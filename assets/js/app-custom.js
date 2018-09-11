/*
* JS to Refresh DataTables
* Start here. Please Group
*/

function LoadDataTable() {

    let location = window.location;

    let path = (location.pathname).toLowerCase();

    if (path.indexOf('index') !== -1  | path.indexOf('') !== -1) {

        let model = path.split("/")[1] || "";

        if (model !== '') { 
            ReloadListOf(model);
            
        }
    }
    return false;
}

function ReloadListOf(table) {

    switch(table)
    {
        case 'units':
            LoadDataFromUrlToTable('/Units/GetList', 'holder_for_list', 'units-all');
            break;
        case 'categories':
            LoadDataFromUrlToTable('/Categories/GetList', 'holder_for_list', 'categories-all');
            break;
        case 'items':
            LoadDataFromUrlToTable('/Items/GetList', 'holder_for_list', 'items-all');
            break;
        case 'purchaserequests':
            LoadDataFromUrlToTable('/PurchaseRequests/GetList', 'holder_for_list', 'prs-all');
            break;
        case 'purchaseorders':
            LoadDataFromUrlToTable('/PurchaseOrders/GetList', 'holder_for_list', 'pos-all');
            break;
        
    }
   
}

/*
* JS to Refresh DataTables
* Ends here. Next Group
*/

//wrapper function for PUT operations

function PutDataToUrl(data, url) {

    return new Promise(resolve => {
        openApiRequest(url, "PUT", "script", data_ = data)
            .then(function (data) {
                resolve();
            },
            function (error) {
                reject();
            })
    });
}

//end wrapper for PUT functions
//-----------------------------------------------------------------
//wrapper function for DELETE operations

function DeleteDataFromUrl(data, url) {

    return new Promise(resolve => {
        openApiRequest(url, "DELETE", "script", data_ = data)
            .then(function (data) {
                resolve();

            },
            function (error) {
                console.log(error);
                if(error.status == 500 || error.status == 401)
                {
                    toastr.error("You are about to delete record that in used.");
                }
            })
    });
}

//END for DELETE operations
//-----------------------------------------------------------------
//wrapper function for POST operations

function PostDataFromUrl(data,url)
{
    return new Promise(resolve => {
        openApiRequest(url, "POST", "script", data_ = data)
            .then(function (data) {
                resolve();
            },
            function (error) {
                reject();
            })
    });
}

//ENDfor POST operations
//-----------------------------------------------------------------
//wrapper function for ajax call
function openApiRequest(url_, method_ = "GET", dataType_ = "html", data_ = null) {

    let promise = new Promise(function (resolve, reject) {

        let data = {
            status: '',
            content: '',
        };

        let request = $.ajax({
            statusCode: {
                404: function () {
                    reject({
                        status: 'error',
                        content: 'API endpoint error! Please contact administrator.',
                    })
                }
            },
            url: url_,
            method: method_,
            data: data_,
            dataType: dataType_
        });

        request.done(function (data_) {
            resolve({
                status: 'ok',
                content: data_,
            });
        });

        request.fail(function (jqXHR, textStatus) {
            reject({
                status: jqXHR.status,
                content: textStatus,
            })
        });
    });
    
    return promise
}

//wrapper function to convert Table to DataTable
//After data population

function LoadDataFromUrlToTable(url, holderDiv, tableId) {

    openApiRequest(url)
        .then(function (data) {

            if (data !== null && data.status === 'ok' | data == "True") {

                let html_ = data.content;
                console.log(data);
                //From $('#holder_for_list').html(html_); (jQuery)
                //to generic JS
                let partialView = document.getElementById(holderDiv);
                partialView.innerHTML = '';
                partialView.innerHTML = html_;

                let table = document.getElementById(tableId);

                $('#' + tableId).DataTable({
                    drawCallback: function () {
                        $('[data-toggle=confirmation]').confirmation({
                            rootSelector: '[data-toggle=confirmation]',
                            onConfirm: function (e) {
                                ExecuteConfirm(this[0].parentNode);
                            },
                            onCancel: function (e) {
                                console.log("You have choosen to cancel execution.");
                            },
                        });
                    }
                });
            }
        },
        function (error) {
            //notify error
            console.log(error)
        });

};