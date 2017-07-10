$(function () {
    // local variables to manipulate signup form
    var $signupSubmit = $("#signup form button");
    var $signup = $("#signup");
    var $signupinput = $("#signup form input");

    $signup.show();
    //click event listener on form submit button
    $signupSubmit.on("click", function () {
        //prevent button from submitting the form
        event.preventDefault ? event.preventDefault() : (event.returnValue = false);
        //get the current displaying fieldset
        var $current = $("#current");
        //call validation function and store return value
        var isValid = validate(this);
        //check if its valid or not
        if(isValid[0] == false){
            //show error message
            $signup.find('.local').text(isValid[2]).show();
            $signup.find("form fieldset").hide();
            $signup.find(isValid[1]).parent().show();
        }else{
            //animate current fieldset out-of-view
            $current.animate({
                marginLeft: "-100%"
            }).fadeOut().removeAttr("id","style");
            //animate next fieldset into view if it is not a view
            //or else submit the form
            if($current.next().is("button")){
               $signup.find("form").submit();
            }else{
                $current.next().css({
                    marginLeft: "100%",
                    display: "block"
                }).animate({
                    marginLeft: "0"
                }).fadeIn().attr("id","current");
            }
        }
    });

    //input event listener on any input field
    $signupinput.on("input",function () {
        //hide local error msg
        $signup.find(".local").fadeOut();
    });

    //validation function
    function validate(e) {
        //local variables
        var $form = e.parentNode;
        var $inputs = $("#current input");
        var valid = [];
        //go through each input
        $inputs.each(function () {
            //check if it empty or not
            if($.trim($(this).val()).length < 1){
                //set valid array with msg, current field and false for invalid
                valid = [false, this, "Empty field(s) detected"];
            }else{
                //set valid array with msg, current field and true for valid
                var switchval = switchtest($(this).val(),$(this).attr('type'));
                valid = [switchval[0], this, switchval[1]];
            }

        });
        //validate the field according to its type
        function switchtest(fieldval, fieldtype) {
            switch (fieldtype){
                case "email":
                    var atpos = fieldval.indexOf("@");
                    var dotpos = fieldval.lastIndexOf(".");
                    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=fieldval.length) {
                        return [false, "invalid email"]
                    }else{
                        return [true]
                    }
                    break;
                case "file":
                    var validext = [".jpg", ".jpeg", ".png", ".svg"];
                    var extdot = fieldval.lastIndexOf(".");
                    var extension = fieldval.substr(extdot);
                    if($.inArray(extension, validext) != -1){
                        return [true];
                    }else{
                        return [false, "invalid logo image format. Must be 'png', 'jpg/jpeg' and 'svg'."]
                    }
                case "text":
                    if(fieldval.match(/^[a-zA-Z]+$/)){
                        return [true]
                    }else{
                        return [false, "Letter only. No symbols or numbers please."]
                    }
                    break;
                case "password":
                    if(fieldval.length < 8){
                        return [false, "Password must be at least 8 characters long"]
                    }else{
                        return [true]
                    }
                    break;
            }
        }

        return valid;
    }
});