(function(){
    
    if($(".cGet")){
        $(".cGet").change(function(){
            let Contacts = $("#contacts");
            var props = $(this).prop("checked"), val = $(this).val();

            if(props == true){
                var fvalue = Contacts.val();
                var lastChar = fvalue.charAt((fvalue.length - 1));
                if(lastChar === ",") {
                    // Comma not needed
                } else if(fvalue !== "") {
                    // add commer at the front of the inoming
                    val = "," + val;
                }

                Contacts.val(Contacts.val()+val);
            } else {
                Contacts.val(Contacts.val().replace(val,""));
            }
        });
    }

})();