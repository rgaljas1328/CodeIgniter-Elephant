
// ALL POST
function executePost(destination, datum, action, form)
{
    $.ajax
    ({
      url: '../application/server/'+destination+'',
      data: datum,
      method: 'post',
      dataType: 'json',
      beforeSend: function()
      {

      },
      success: function(data)
      {
        if(data.flag == 0)
        {
          executeNotif(data.message,"danger");
        }
        else if(data.flag == 2)
        {
          executeNotif(data.message,"warning");
        }
        else
        {
          if(action == 'login')
          {
             window.location.href=""+data.url+"";
          }
          else
          {
            executeNotif(data.message,"success");
            //executeGet(getDestination, 'table', getComponent,getdataType);
          }
          
          $('#'+ form +'')[0].reset();
          
         
        }
      },
      error: function()
      {
        
      } 
    });
}

//ALL GET
function executeGet(destination, datum, component, dataType)
{
    $.ajax
    ({
      url: '../application/server/'+destination+'',
      data: {type : datum},
      method: 'get',
      dataType: dataType,
      beforeSend: function()
      {

      },
      success: function(data)
      {
        if(datum == 'table')
        {
         
          $('#'+component+'').html(data);
          $('#'+component+'').DataTable();
        }
        else if(datum == 'option')
        {
          var result = $('#'+component+' option[value!=""]').first().html();
          $("#"+component+" option[value='"+result+"']").remove();
           $.each(data, function(index, element) {
            $('#'+component+'').prepend('<option value="'+element.category_id+'" selected="">'+element.category_name+'</option>');
            $('#'+component+'').selectpicker('refresh');
          });
          
        }
      },
      error: function()
      {

      }
    });
}

//ALL PUT
function executePut(destination, datum)
{
    $.ajax
    ({
      url: '',
      data: '',
      method: 'post',
      dataType: 'json',
      success: function()
      {

      },
      error: function()
      {

      }
    });
}