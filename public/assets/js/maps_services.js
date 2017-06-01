function addMark(location){
  marker.setPosition(location);
  changeInfoWindow(marker);
  google.maps.event.addListener(marker, 'dragend', function(){ changeInfoWindow(marker); });
  google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser does not support geolocation.');
}

function openInfoWindow(marker) {
    infowindow.close();
    infowindow = new google.maps.InfoWindow();
    var markerLatLng = marker.getPosition();
    infowindow.setContent('<div class="lat-lng"><strong>Lat:</strong><br> ' + markerLatLng.lat() + '<br><strong>Lng:</strong><br>' + markerLatLng.lng() +'</div>');
    infowindow.open(map, marker);
    google.maps.event.addListener(marker, 'dragend', function(){ changeInfoWindow(marker); });
    google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });    
}

function changeInfoWindow(marker) {
    var markerLatLng = marker.getPosition();
    var loc_change = {lat: markerLatLng.lat(), lng: markerLatLng.lng() };
    infowindow.setContent('<div class="lat-lng"><strong>Lat:</strong><br> ' + markerLatLng.lat() + '<br><strong>Lng:</strong><br>' + markerLatLng.lng() +'</div>');
    //infowindow.open(map, marker);
    $('#lat').val(loc_change.lat);
    $('#lng').val(loc_change.lng);
}

function initMap() {
  map = new google.maps.Map(document.getElementById('map-form'), {
    center: map_center,
    zoom: 8
  });

  infowindow = new google.maps.InfoWindow({map: map});

  var input = (document.getElementById('address_search'));
  // country default system
  var options = {componentRestrictions: {country: 'PA'}};
  autocomplete = new google.maps.places.Autocomplete(input, options);
  autocomplete.bindTo('bounds', map);
  autocomplete.setTypes(['geocode']);

  marker = new google.maps.Marker({
    map: map,
    draggable: true,
    title: 'local'
  });

  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(16);  
    }

    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    addMark({lat: place.geometry.location.lat(), lng: place.geometry.location.lng()});
    document.getElementById('address_search').value = '';

  });

  if(edit){

      marker = new google.maps.Marker({
        position: new google.maps.LatLng([local_lat, local_lng]),
        map: map,
        draggable: true,
        zoom: 14
      });
      map.setCenter({lat: local_lat, lng: local_lng});
      map.setZoom(16); 
      addMark({lat: local_lat, lng: local_lng});

  }

  infowindow.close();

  google.maps.event.addListener(marker, 'dragend', function(){ changeInfoWindow(marker); });
  google.maps.event.addListener(marker, 'click', function(){ openInfoWindow(marker); });
  google.maps.event.addListener(map, 'click', function(event) {addMark(event.latLng); });

}

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
    input1.id = 'end-'+count;
    input1.setAttribute('required', 'required');

    if(edit){
      var input2 = document.createElement("input");
      input2.type  = 'hidden';
      input2.name  = 'service_id[]';
      input2.value = 0;
    }

    var td2    = document.createElement("TD");
    var select2 = document.createElement("select");

    select2.name  = 'services_status[]';
    select2.className = 'form-control',
    $.each(select_option_service, function(index, value) { 
      var option = document.createElement("option");
      option.value = index;
      option.text = value;
      select2.appendChild(option);
    });

    var td3    = document.createElement("TD");

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
    td2.appendChild(select2);
    td3.appendChild(button);

    tr.appendChild(td); 
    tr.appendChild(td1); 
    tr.appendChild(td2); 
    tr.appendChild(td3); 

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

initMap();
