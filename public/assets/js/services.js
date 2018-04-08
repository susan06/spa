function add_services() {
  
  if(verifiquePrice()) {
    $('#services_table').show();

    var input = document.createElement("input");
    var tr    = document.createElement("TR");
    var td    = document.createElement("TD");  

    input.type  = 'text';
    input.name  = 'services_name[]';
    input.className = 'form-control', 
    input.setAttribute('required', 'required');

    var input1 = document.createElement("input");
    var td1    = document.createElement("TD");

    input1.type  = 'text';
    input1.name  = 'services_prices[]';
    input1.className = 'form-control services_price',
    input1.value = 0;
    input1.setAttribute('required', 'required');

    if(edit){
      var input2 = document.createElement("input");
      input2.type  = 'hidden';
      input2.name  = 'service_id[]';
      input2.value = 0;
    }

    var input3 = document.createElement("input");
    var td3    = document.createElement("TD");

    input3.type  = 'checkbox';
    input3.name  = 'services_offer[]';

    var input4 = document.createElement("input");
    var td4    = document.createElement("TD");

    input4.type  = 'text';
    input4.name  = 'services_offer_porcent[]';
    input4.className = 'form-control';

    var td5 = document.createElement("TD");
    var select2 = document.createElement("select");

    select2.name  = 'services_status[]';
    select2.className = 'form-control',
    $.each(select_option_service, function(index, value) { 
      var option = document.createElement("option");
      option.value = index;
      option.text = value;
      select2.appendChild(option);
    });

    var td6    = document.createElement("TD");

    button               = document.createElement('button');
    button.className     = 'btn btn-fill btn-danger delete-service';

    var icon               = document.createElement('i');
    icon.style.cursor  = 'pointer';
    icon.className     = 'fa fa-trash';
    
    button.appendChild(icon);

    td.appendChild(input);
    if(edit){
      td.appendChild(input2);
    }
    td1.appendChild(input1);
    td3.appendChild(input3);
    td4.appendChild(input4);
    td5.appendChild(select2);
    td6.appendChild(button);

    tr.appendChild(td); 
    tr.appendChild(td1); 
    tr.appendChild(td3); 
    tr.appendChild(td4); 
    tr.appendChild(td5); 
    tr.appendChild(td6); 

    container = document.getElementById('services_list');
    container.appendChild(tr); 
    //total();
    count++;
  } else {
    notify('error', 'Debe establecer un precio diferente de cero');
  }
}

function total() {
  var sum = 0;  
  var count2 = count - 1;
  var container = document.getElementById('services_table');  
    $("#services_list tr").each( function() {       
      var price = $(this).find('td:eq(1) input');
      if (price.val() != null || price.val() != '') {
        sum += parseFloat(price.val());
      }             
    })   
  if(count2 == 0) {
    var promedio = sum; 
  } else {
    var promedio = sum / count2;
  }
    
    $("#price").val(promedio.toFixed(2).toString());  
} 

function verifiquePrice() { 
  var result = true;
  var container = document.getElementById('services_table');

    $("#services_list tr").each( function() {       
      var price = $(this).find('td:eq(1) input');
      if (price.val() == 0) {
        result = false;
      }             
    })   

  return result;
}

$(document).on('click', '.delete-service', function () {
    var row = $(this).closest('tr');
    count--;
    row.remove();
});

$(document).on('click', '.delete-photo-upload', function () {
    var row = $(this).closest('tr');
    row.remove();
});

$(document).on('click', '.delete-photo', function () {
    var row = $(this).closest('div');
    row.remove();
});


function add_photos() {

    var input = document.createElement("input");
    input.type  = 'file';
    input.name  = 'photos[]';
    input.className = 'form-control'; 

    var div1    = document.createElement("div");
    var div2    = document.createElement("div");
    var div3    = document.createElement("div");

    div3.className = 'form-group inline-flex';
    div2.className = 'col-md-10 col-sm-10 col-xs-12';
    div1.className = 'row';

    button               = document.createElement('button');
    button.className     = 'btn btn-fill btn-danger mg-left-10 delete-photo';
    var icon               = document.createElement('i');
    icon.style.cursor  = 'pointer';
    icon.className     = 'fa fa-trash';
    button.appendChild(icon);

    div3.appendChild(input); 
    div3.appendChild(button); 
    div2.appendChild(div3); 
    div1.appendChild(div2); 

    container = document.getElementById('load_photos');
    container.appendChild(div1); 
}

