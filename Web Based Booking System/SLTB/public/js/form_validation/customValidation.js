$(function(){


    $(document).ready(function(){
        //alert(1);
        $.validate();   
    //     $("#bus_create_form").validate({
    //  
    //   submitHandler: function(form) {
    //    form.submit();
    //  }
    // });
    //   $("#bus_create_form").validate({
    //     
    //  
    // });
    // $.validate({
    //  modules : 'security',
    //  onModulesLoaded : function() {
    //    var optionalConfig = {
    //      fontSize: '12pt',
    //      padding: '4px',
    //      bad : 'Very bad',
    //      weak : 'Weak',
    //      good : 'Good',
    //      strong : 'Strong'
    //    };
    //
    //    $('input[name="pass"]').displayPasswordStrength(optionalConfig);
    //  }
    //});

    //$('#Bus_arrivalTime input').ptTimeSelect({
    //	onBeforeShow: function(i){
    //		$('#Bus_arrivalTime #sample4-data').append('onBeforeShow(event) Input field: ' + $(i).attr('name') + "");
    //	},
    //	onClose: function(i) {
    //		$('#Bus_arrivalTime #sample4-data').append('onClose(event)Time selected:' + $(i).val() + "");
    //	}
    //	
    //});

    //$('#Bus_arrivalTime input').ptTimeSelect();

    //$(document).ready(function(){
    //        $('input[name="time"]').ptTimeSelect();
    //    });
    //    
    
  
    });  
    
     $(function(){     
        $('#updatePassword').live('click',function(){   
            if(document.getElementById("newPassword").value == document.getElementById("confirmPassword").value){
                return true;
            }else{
                alert('new password and confirm password not match');
                return false;
            }
        });
    });
    
});