
function LoadTable(destination)
{
  let controllerName = destination.split('/')[5];
  
  switch(controllerName)
  {
    case 'groups':
      GET('../admin/groups/getGroups', 'table', 'groupTable');
      break;
  }
}

//ALL GET
function GET(destination, datum, component, dataType = "html")
{
  let data = (datum != 'table' && datum != 'option')? {type: '',id: datum} : {type:datum};
 
  return new Promise(resolve => {
  APIRequest(destination,"GET", data,dataType).then(
    function(data){
      //DISPLAY TABLE
      if(datum == 'table')
      {
        $('#'+component+'').DataTable().destroy();
        $('#'+component+'').html(data); 
        $('#'+component+'').DataTable();
      }
      //DISPLAY COMBOBOX
      else if(datum == 'option')
      {
        $('#'+component+'').html(data);
      }
      //RETURN JSON
      else
      {
        resolve(data);
      }
    },
    function(error){console.log(error);}
    );
  });
}

// ALL POST
function POST(destination, data, form)
{
  APIRequest(destination, "POST", data, "json").then(
    function(data){
      executeNotif(data,form);
      LoadTable(destination);
    },
    function(error)
    {
      console.log(error);
    });
}

function PUT(destination, data, form, modal)
{
  APIRequest(destination, "POST", data, "json").then(
    function(data){
      executeNotif(data,form);
      $('#'+modal+'').modal('hide');
      LoadTable(destination);
    },
    function(error)
    {
      console.log(error);
    });
}


function DELETE(destination, data, dataType ="json")
{
  APIRequest(destination, "GET", data, "json").then(
    function(data){
      executeNotif(data,"");
      LoadTable(destination);
    },
    function(error)
    {
      console.log(error);
    });

}

function APIRequest(url, method = 'GET', data = null, dataType = 'html')
{
  let promise = new Promise(function(resolve,reject){
    let request = $.ajax
    ({
      url: url,
      data: data,
      method: method,
      dataType: dataType
    });
    request.done(function(data){
      resolve(data);
    });
    request.fail(function(jqXHR, textStatus){
      reject({
        status: jqXHR,
        content: textStatus,
      })
    });

  });
  
  return promise;

}