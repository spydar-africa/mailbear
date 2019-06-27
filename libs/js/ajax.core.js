(function(){


    if($("#ajaxForm")){ 
        $("#ajaxForm").submit(function(event){ 
            event.preventDefault();
            
            var data = new FormData(this);
            var url = $(this).attr("action");
            var method = $(this).attr("method");
         
        $.ajax({ 
            url, method, data, cache: false, contentType: false, processData: false, 
                beforeSend: function(loader) {
                    $("button").attr("disabled","disabled");
                    loader = '<i class="fas fa-spin fa-spinner"></i>';
                    $("#ajaxStatus").html(loader);
                },
                success: function(res){
                    console.log(res);

                    if(res == "sent"){
                        var ToastSuccess = '<div id="" class="toast-bottom-right"><div class="toast toast-success" aria-live="polite" style=""><div class="toast-message">Message Sent</div></div></div>';
                        $("#ajaxStatus").html(ToastSuccess);
                    } else {
                        var ToastErr = '<div id="toast-container" class="toast-bottom-right"><div class="toast toast-error" aria-live="assertive" style=""><div class="toast-message">Message not sent</div></div></div>';
                        $("#ajaxStatus").html(ToastErr);
                    }

                    $("#toast-container").fadeOut(7000);

                }
            });
        });
    }
})();