/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var CURRENT_URL = window.location.href.split('?')[0],
    $BODY = $('body'),
    $SIDEBAR_MENU = $('#sidebar-menu'),
    $NAV_MENU = $('.navbar-header'),
    $FOOTER = $('footer');

 var diacritics = {'&aacute;':"á", 
    '&eacute;':'é', "&iacute;":"í", 
    "&oacute;":"ó", "&uacute;":"ú", 
    "&euro;": "€",
    "&ntilde;": "ñ"};

function formatString(string){

    $.each(diacritics, function(key, value){
        string = string.replace(key, value);
    });

    return string;
}
// ========================================================================
//  Quotations > tables
// ========================================================================

var options_table = {
    retrieve: true,
    "searching": false,
    "paging": false,
    "bInfo": false,
    "ordering": false,
    "language": {
      "emptyTable": lang.no_data_table
    }
};

var table = $('#datatable-responsive').DataTable(options_table); 

// plugin
$(document).ready(function() {

    $('.date').datetimepicker({
      format: 'YYYY-MM-DD',
      ignoreReadonly: true,
    });

    
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    // ========================================================================
    //  Bootstrap Tooltips and Popovers
    // ========================================================================

    if ($('.tooltiped').length) {
        $('.tooltiped').tooltip();
    }

    if ($('.popovered').length) {
        $('.popovered').popover({
            'html': 'true'
        });
    }

    // Making Bootstrap Popover Hovered

    if ($('.popover-hovered').length) {
        $('.popover-hovered').popover({
            trigger: 'hover',
            'html': 'true',
            'placement': 'top'
        });
    }


});
// /plugin


// Switchery
$(document).ready(function() {
    if ($(".js-switch")[0]) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                color: '#5bc0de'
            });
        });
    }
});
// /Switchery


/**
 * script general
 * 
 */

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});

var divId = 'tab-content';

//delete register
$(document).on('click', '.btn-delete', function () {
    $('[data-toggle="tooltip"]').tooltip('hide');
    var $this = $(this);
    swal({   
        title: $this.attr('title'),   
        text: $this.data('confirm-text'),   
        type: "warning",   
        showCancelButton: true,   
        cancelButtonText: lang.cancel,
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: $this.data('confirm-delete'),   
        closeOnConfirm: true },
        function(isConfirm){   
            if (isConfirm) {
                showLoading(); 
                $.ajax({
                    type: 'DELETE',
                    url: $this.data('href'),
                    dataType: 'json',
                    success: function (response) { 
                        hideLoading();                          
                        if(response.success) {  
                            notify('success', response.message);
                            if(response.view) {
                                $('#tab-content').html(response.view);
                                loadResposiveTable();
                            } 
                            if($this.data('current')){
                                CURRENT_URL = $this.data('current');
                            } 
                            if($this.data('close')){
                                $('#general-modal').modal('hide');
                            }
                            getPages(CURRENT_URL);  
                        } else {
                            notify('error', response.message);
                        }
                    },
                    error: function (status) {
                        hideLoading();
                        notify('error', status.statusText);
                    }
                });     
        } 
    });
});

var current_model = null;
var current_title = null;

//open create show or edit in modal or content
$(document).on('click', '.create-edit-show', function () {
    showLoading();
    $('[data-toggle="tooltip"]').tooltip('hide');
    var $this = $(this);
    var title = $this.attr("title");
    if(!title) {
        title = $this.data("title");
    }
    var message = $this.data("message");

    current_model = $this.data('model');
    if($this.data('current')){
        CURRENT_URL = $this.data('current');
    }
    if($this.data('div')){
        divId = $this.data('div');
    } else {
        divId = 'tab-content';
    }
    var href = $this.data('href');
    if($this.data('url')){
        href = $this.data('url');
    }
    $.ajax({
        url: href,
        type:'GET',
        success: function(response) {
            hideLoading();
            //console.log(response);
            if(response.success){
                if(current_model == 'modal') {
                    $('#modal-title').text(title);
                    $('#modal-title').html(title);
                    $('#content-modal').html(response.view);
                    $('#general-modal').modal('show');
                } else {
                    $('.top_search').hide();
                    $('.btn-create').hide();
                    current_title = $('#content-title').text();
                    $('#content-title').text(title);
                    $('#tab-content').html(response.view);
                }
                if(message){
                    $('#title-message-'+message).addClass('text-gray');
                }
            } else {
                notify('error', response.message);
            }
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});

//cancel return page old
$(document).on('click', '.btn-cancel', function (e) {
    e.preventDefault();
    getPages(CURRENT_URL);
    $('#content-title').text(current_title);
    $('.btn-create').show();
    $('.top_search').show();
});

//reset search
$(document).on('click', '.search-cancel', function (e) {
    e.preventDefault();
    getPages(CURRENT_URL);
    $('#search').val('');
    $(this).hide();
    loadResposiveTable();
});

// search register all
$(document).on('click', '.search', function () {
    showLoading();
    var term = $('#search').val();
    var $this = $(this);
    $('.search-cancel').show();
    if(term){
        $.ajax({
            url: CURRENT_URL,
            type:"GET",
            data:{ search: term },
            dataType: 'json',
            success: function(response) {
                hideLoading();
                if(response.success){
                    $('#tab-content').html(response.view);
                    loadResposiveTable();
                } else {
                    notify('error', response.message);
                }
            },
            error: function (status) {
                hideLoading();
                notify('error', status.statusText);
            }
        });
    } else {
        //
    }
});

// search status all
$(document).on('change', '#status', function () {
    showLoading();
    var $this = $(this);
    $.ajax({
        url: CURRENT_URL,
        type:"GET",
        data:{ status: $this.val() },
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if(response.success){
                $('#tab-content').html(response.view);
                //loadResposiveTable();
            } else {
                notify('error', response.message);
            }
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});

$(document).on('change', '#date_reservation', function () {
    showLoading();
    var $this = $(this);
    $.ajax({
        url: CURRENT_URL,
        type:"GET",
        data:{ date: $this.val() },
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if(response.success){
                $('#tab-content').html(response.view);
                //loadResposiveTable();
            } else {
                notify('error', response.message);
            }
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});
// search by branch
$(document).on('change', '#branch_list', function () {
    showLoading();
    var $this = $(this);
    $.ajax({
        url: CURRENT_URL,
        type:"GET",
        data:{ branch: $this.val() },
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if(response.success){
                $('#tab-content').html(response.view);
                //loadResposiveTable();
            } else {
                notify('error', response.message);
            }
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});
// search statusby roles all
$(document).on('change', '#select_roles', function () {
    showLoading();
    var $this = $(this);
    $.ajax({
        url: CURRENT_URL,
        type:"GET",
        data:{ role: $this.val() },
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if(response.success){
                $('#tab-content').html(response.view);
                //loadResposiveTable();
            } else {
                notify('error', response.message);
            }
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});

    $(document).on('click', '.pagination a', function (e) {
        getPages($(this).attr('href'));
        e.preventDefault();
    });


    $(document).on('click', '.check', function (e) {
        var $this = $(this);
        if($this.data('favorite')) {
            showLoading();
            $.ajax({
                url: $(this).data('delete'),
                type:'GET',
                success: function(response) {
                    hideLoading();
                    if(response.success){
                        $this.removeClass('active');
                        $this.removeClass('check');
                        $this.addClass('save-check');
                        notify('success', response.message);
                    } else {
                        if(response.login){
                            showLoading();
                            window.location.href = response.login;
                        } else {
                            notify('error', response.message);
                        }
                    }
                },
                error: function (status) {
                    hideLoading();
                    notify('error', status.statusText);
                }
            });

        } else {
          notify('info', $(this).data('msg'));  
        } 
    });


function getPages(page) {
    if(page) {
        showLoading();
        $.ajax({
            url: page,
            type:"GET",
            dataType: 'json',
            success: function(response) {
                hideLoading();
                if(response.success){
                    $('#tab-content').html(response.view);
                    CURRENT_URL = page;
                    /*
                    $('html,body').animate({
                        scrollTop: $(".top").offset().top
                    }, 2000);*/
                }
            },
            error: function (status) {
                hideLoading();
                //console.log(status.statusText);
            }
        });
    }
}

function notify(type_msg, content){
    var icon_default = 'pe-7s-bell';
    if(type_msg == 'error') {
        icon_default = 'pe-7s-volume1';
    } else if(type_msg == 'success') {
        icon_default = 'pe-7s-like2';
    } else if(type_msg == 'info') {
        icon_default = 'pe-7s-info';
    }

    $.notify({
        icon: icon_default,
        message: content

    },{
        type: type_msg,
        timer: 40000
    });
}

// datatable-responsive
function loadResposiveTable() {  
    table.destroy();
    table = $('#datatable-responsive').DataTable(options_table);
}

$(document).on('change', '#file_image', function () { 
    showLoading();
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image_upload').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }
    hideLoading();
});

function showLoading() {
    $('#loading').addClass('is-active');
}

function hideLoading() {
    $('#loading').removeClass('is-active'); 
}

$(document).ready(function() {

  $('form').keypress(function(e){   
    if(e == 13){
      return false;
    }
  });

  $('input').keypress(function(e){
    if(e.which == 13){
      return false;
    }
  });

});


$(document).on('click', '.tab-ext', function(e){
    e.preventDefault();
    var url = $(this).attr("data-url");
    if (typeof url !== "undefined") {
        $('.tab-ext').removeClass('active');
        $(this).addClass('active');
        showLoading();
        var $data = {};
        $.ajax({
            url: url,
            type:'GET',
            data: $data,
            success: function(response) {
                hideLoading();
                if($('html,body').width() < 768) {
                    $('#btn-search-toggle').trigger('click');
                }
                if(response.success){
                    $('#tab-content').html(response.view);
                } else {
                    notify('error', response.message);
                }
            },
            error: function (status) {
                hideLoading();
                notify('error', status.statusText);
            }
        });
    } 
});

$(document).on('click', '.menu-click', function () {
    showLoading();
});

$(document).on('click', '.save-check', function () {
    showLoading();
    var url = $(this).data("url");
    var $this = $(this);
    var active = $(this).data("active");

    /*if($this.data('auth') == false) {
        window.location.href = url_login;
    }*/

     $.ajax({
        url: url,
        type:'GET',
        success: function(response) {
            hideLoading();
            if(response.success){
                if(active == true) {
                    $this.removeClass('save-check');
                    $this.addClass('active');
                    $this.addClass('check');
                }
                notify('success', response.message);
            } else {
                if(response.login){
                    showLoading();
                    window.location.href = response.login;
                } else {
                    notify('error', response.message);
                }
            }
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});

$(document).on('click', '.show-start', function () {
    var $this = $(this);
    showLoading();
    if($this.data('auth') == true) {
        hideLoading();
        $('#start-modal').modal('show');
    } else {
        window.location.href = url_login;
    }
});

$(document).on('click', '.show-recommend', function () {
    var $this = $(this);
    showLoading();
    if($this.data('auth') == true) {
        hideLoading();
        //$('#tags_1').val('');
        $('#recommendation-modal').modal('show');
    } else {
        window.location.href = url_login;
    }
});


$(document).on('click', '.btn-submit-modal', function (e) {
    e.preventDefault();
    showLoading();
    var $this = $(this);
    var form = $('#form-generic-modal'); 
    var type = $('#form-generic-modal input[name="_method"]').val();
    if(typeof type == "undefined") {
        type = form.attr('method');
    }
    $.ajax({
        url: form.attr('action'),
        type: type,
        data: form.serialize(),
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if(response.success){

                $('#modal-general').modal('hide');
                $('.modal').modal('hide');
                
                if(response.url_return) {
                    showLoading();
                    window.location.href = response.url_return;
                }

                if(response.message) {
                    notify('success', response.message);
                }

                getPages(CURRENT_URL);

            } else {
                if(response.login){
                    showLoading();
                    window.location.href = response.login;
                } 
                if(response.validator) {
                  var message = '';
                  $.each(response.message, function(key, value) {
                    message += value+' ';
                  });
                  notify('error', message);
                } 
            }
           
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});

$(document).on('click', '.btn-submit-modal-2', function (e) {
    e.preventDefault();
    showLoading();
    var $this = $(this);
    var form = $('#form-generic-modal-2'); 
    var type = $('#form-generic-modal-2 input[name="_method"]').val();
    if(typeof type == "undefined") {
        type = form.attr('method');
    }
    $.ajax({
        url: form.attr('action'),
        type: type,
        data: form.serialize(),
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if(response.success){
        
                $('#modal-general').modal('hide');
                ('.modal').modal('hide');
                
                if(response.url_return) {
                    showLoading();
                    window.location.href = response.url_return;
                }

                if(response.message) {
                    notify('success', response.message);
                }

                getPages(CURRENT_URL);

            } else {
                if(response.login){
                    showLoading();
                    window.location.href = response.login;
                } 
                if(response.validator) {
                  var message = '';
                  $.each(response.message, function(key, value) {
                    message += value+' ';
                  });
                  notify('error', message);
                } 
            }
           
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
})

$(document).on('click', '.btn-submit-modal-file', function (e) {
    e.preventDefault();
    showLoading();
    var $this = $(this);
    var form = $('#form-generic-modal'); 
    var type = $('#form-generic-modal input[name="_method"]').val();
    if(typeof type == "undefined") {
        type = form.attr('method');
    }

    var formData = new FormData();
    formData.append('image', $('input[type=file]')[0].files[0]); 
    formData.append('priority', $('#priority').val());
    formData.append('status', $('#status-input').val());

    $.ajax({
        url: form.attr('action'),
        type: type,
        data:  formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if(response.success){

                $('#modal-general').modal('hide');
                $('.modal').modal('hide');
                
                if(response.url_return) {
                    showLoading();
                    window.location.href = response.url_return;
                }

                if(response.message) {
                    notify('success', response.message);
                }

                getPages(CURRENT_URL);

            } else {
                if(response.login){
                    showLoading();
                    window.location.href = response.login;
                } 
                if(response.validator) {
                  var message = '';
                  $.each(response.message, function(key, value) {
                    message += value+' ';
                  });
                  notify('error', message);
                } 
            }
           
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});

$(document).on('click', '.btn-submit', function (e) {
    e.preventDefault();
    showLoading();
    var $this = $(this);
    var form = $('#form-generic'); 
    var type = $('#form-generic input[name="_method"]').val();

    if(typeof type == "undefined") {
        type = form.attr('method');
    }

    if($this.data('auth') && $this.data('auth') == false) {
        window.location.href = url_login;
    }

    $.ajax({
        url: form.attr('action'),
        type: type,
        data: form.serialize(),
        dataType: 'json',
        success: function(response) {
            hideLoading();
            //console.log(response);
            if(response.success){

                if(response.url_next){
                    $('#content-title').text(response.title_next);
                    getPages(response.url_next);
                } 
                    
                if(response.url_return) {
                    showLoading();
                    window.location.href = response.url_return;
                }

                if(response.reservation) {
                    $('#date-input-reservation').val('');
                    $('#time-input-reservation').val('');
                    $('.resumen').hide();
                }

                if(response.message) {
                    notify('success', response.message);
                }

                getPages(CURRENT_URL);
                
            } else {
                if(response.login){
                    showLoading();
                    window.location.href = response.login;
                } 
                if(response.validator) {
                  var message = '';
                  $.each(response.message, function(key, value) {
                    message += value+' ';
                  });
                  notify('error', message);
                } 
            }
           
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});

$(document).on('click', '.btn-cancel-status', function () {
    var $this = $(this);
    swal({   
        title: $this.attr('title'),   
        text: $this.data('confirm-text'),   
        type: "warning",   
        showCancelButton: true,   
        cancelButtonText: 'Cancelar',
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: $this.data('confirm-delete'),   
        closeOnConfirm: true },
        function(isConfirm){   
            if (isConfirm) {
                showLoading(); 
                $.ajax({
                    type: 'GET',
                    url: $this.data('href'),
                    dataType: 'json',
                    success: function (response) { 
                        hideLoading();                          
                        if(response.success) {  
                            notify('success', response.message);
                            if(response.view) {
                                $('#tab-content').html(response.view);
                                //loadResposiveTable();
                            } 
                            if($this.data('current')){
                                CURRENT_URL = $this.data('current');
                            } 
                            if($this.data('close')){
                                $('#general-modal').modal('hide');
                            }
                            getPages(CURRENT_URL);  
                        } else {
                            notify('error', response.message);
                        }
                    },
                    error: function (status) {
                        hideLoading();
                        notify('error', status.statusText);
                    }
                });     
        } 
    });
});

$(document).on('change', '#change_province', function () {
    showLoading();
    var $this = $(this);
    var url = $this.attr("data-url");
    $.ajax({
        url: url,
        type:"GET",
        data:{ province_id: $this.val() },
        dataType: 'json',
        success: function(response) {
            hideLoading();
            if(response.success){
                $('#tab-content').html(response.view);
            } else {
                notify('error', response.message);
            }
        },
        error: function (status) {
            hideLoading();
            notify('error', status.statusText);
        }
    });
});

$(document).on('click', '.check_gps', function () {
    var $this = $(this);
    showLoading();
    var url_locations = $this.data('href');
    if (navigator.geolocation) {// Try HTML5 geolocation.
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            url_locations = url_locations+'?lat='+lat+'&lng='+lng;
            window.location.href = url_locations;
        }, function() {
            handleLocationError(true);
        });
    } else {     
        handleLocationError(false); // Browser doesn't support Geolocation
    }
});

function handleLocationError(browserHasGeolocations) {
    hideLoading();
    if(browserHasGeolocations) {
        notify('error', 'La geolocalización fallo, active su GPS o recargue su navegador');
    } else {
        notify('error', 'Su navegador no soporta la geolocalización');
    }
}