$(document).ready(function () {
            

              function pending() {
                    $.ajax({

                        url: route_quotation_count,
                        type : 'get',
                        success:
                            function (json) {
                               $(".quotation-black").text(json.black);
                               $(".quotation-danger").text(json.danger);
                               $(".quotation-success").text(json.success);
                            }
                    });

               }
            pending();
            setInterval(pending,30000);

        });