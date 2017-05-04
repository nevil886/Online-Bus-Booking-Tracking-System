$(function(){
    

       
    $('#Uploade').live('click',function(){   
               
        Parse.initialize('w6sOkx6IXZPloTIkWcdbfX3RxKrrPJZmWPIGHeYk','A2yVM8pivVRG45md3dmHP0g0rDGloutMDK2ETgdv');
                        
        var Booking_Infor = Parse.Object.extend("Booking_Infor");
        
                        
        //------------------------------------------------
        
        var r_journeyDate = document.getElementById("r_journeyDate").value;
        var r_busNo = document.getElementById("r_busNo").value;
        var r_journeyNo = document.getElementById("r_journeyNo").value;
        
        $.ajax({
            type:'POST',
            url:'/SLTB/report/xhrSearchBookingData',
            data:{
                busNo:r_busNo,
                journeyNo:r_journeyNo,
                journeyDate:r_journeyDate
            },
            dataType:'json',
            beforeSend:function(o){
                $(".loading").fadeIn();
            },
            success:function(o){ //alert(o[1].status);
                for (var j=0; j<o.length; j++){ //alert(o[j].status);
                    
                    var booking_Infor = new Booking_Infor();
                    
                    booking_Infor.set("seatNo",o[j].seatNo);
                    booking_Infor.set("status",o[j].status);
                    booking_Infor.set("ticketNo",o[j].ticketNo);
                    booking_Infor.set("gender",o[j].gender);
                    booking_Infor.set("busNo",o[j].busNo);
                    booking_Infor.set("journeyDate",o[j].journeyDate);
                    booking_Infor.set("journeyNo",o[j].journeyNo);
                    
                    booking_Infor.save();
                }
                
                booking_Infor.save(null, {
                    success: function(booking_Infor) { 
                        $(".loading").fadeOut();
                        alert('Save : ' + booking_Infor.id);
                    },
                    error: function(booking_Infor, error) {
                        alert('Failed to create new object, with error code: ' + error.message);
                    }
                });
                
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });        
                           
    //------------------------------------------------
        

    
    });
   
        
        
        
       
    $('#busNoforBookingReport').change(function(){
            
        $('#journeyNoforBookingReport option[value!="0"]').remove()
        var busNo = document.getElementById("busNoforBookingReport").value;
        $.ajax({
            type:'POST',
            url:'/SLTB/report/xhrSearchJourneyforSingleBus',
            data:{
                busNo:busNo
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                $("#journeyNoforBookingReport").append(new Option(o[0].journeyNo,o[0].journeyNo));
                $("#journeyNoforBookingReport").append(new Option(o[1].journeyNo,o[1].journeyNo));
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
            
    });
  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
});