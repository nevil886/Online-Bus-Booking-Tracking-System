$(function(){

    //    $(document).ready(function() {
    //        //alert(1); 
    //        });

    $(function(){     
        $('.table-delete-button').live('click',function(){   
            var conf = confirm("Are you sure you want to delete this record?");
            if(conf == true){
                return true;
            }else{
                return false;
            }
        });
    });

    /*------------------------------------------------------------------------------- */

    $(function(){     
        $('.user-search-button').live('click',function(){   
            var userName=document.getElementById("uUserName").value;
            $.post('/SLTB/systemUser/xhrSearchSingleUser',{
                'userName':userName
            },function(o){           
                for (var i=0;i<o.length;i++){
                    document.getElementById("uUserName").value = o[0].userName;
                    document.getElementById("uEmpolyeeNo").value = o[0].empolyeeNo;
                    document.getElementById("uEmpolyeeName").value = o[0].empolyeeName;
                    document.getElementById("uEmpolyeeMNo").value = o[0].empolyeeMNo;
                }
               
                                
            },'json');
            return true;
             
        });
    });

    $('#test').live('click',function(){   
        var prtContent = document.getElementById("booking_ticket_area");
        var WinPrint = window.open('', '', 'letf=0,top=0,width=500,height=500,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    });
    
    $('#printbusTicketsbtn').live('click',function(){   
        var prtContent = document.getElementById("bus_ticket_sub_area");
        var WinPrint = window.open('', '', 'letf=0,top=0,width=500,height=500,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    });

    // for redo button in enter J No
    $(function(){     
        $('#journeyNoRedioBtn').live('click',function(){ 
            var jNo = $('input[name=journeyNo]:checked').val();
            //alert(jNo);
            $.ajax({
                type:'POST',
                url:'/SLTB/journey/xhrSearchSingleJourney',
                data:{
                    jNo:jNo
                },
                dataType:'json',
                beforeSend:function(o){
                },
                success:function(o){
                    alert(' [ Route No => '+o[0].routeNo + ']\n [ Journey From => '+o[0].journeyFrom + ' ]\n [ Journey To => '+o[0].journeyTo + ' ]\n [ Dep. Time => '+o[0].departureTime+' ]'); 
                //alert("sometext \n"+"defaultText");
                },
                error : function(XMLHttpRequest, textStatus, errorThrown){
                }
            });
            
        });
    });
    
    //-------------Parse-------------------------------------------------

    $('#UploadeBusNo').live('click',function(){   
               
        Parse.initialize('w6sOkx6IXZPloTIkWcdbfX3RxKrrPJZmWPIGHeYk','A2yVM8pivVRG45md3dmHP0g0rDGloutMDK2ETgdv');
        var Journey = Parse.Object.extend("journey");
        
        $.ajax({
            type:'POST',
            url:'/SLTB/bus/xhrSearchAllBusandJourney',
            data:{
            },
            dataType:'json',
            beforeSend:function(o){
                $(".loadingDefault").fadeIn();
            },
            success:function(o){ //alert(1);
                var query = new Parse.Query(Journey);
                query.find({
                    success: function(obj) {
                        Parse.Object.destroyAll(obj).then(function() {
                            //----------------------------------------------
                            for (var j=0; j<o.length; j++){ //alert(o[j].status);
                    
                                var journey = new Journey();
                    
                                journey.set("busNo",o[j].busNo);
                                journey.set("journeyNo",o[j].journeyNo);
                                journey.set("no_of_seat",parseInt(o[j].numberOfSeat));
                                
                                journey.save();
                            }
                
                            journey.save(null, {
                                success: function(journey) { 
                                    $(".loading").fadeOut();
                                    alert('Save : ' + journey.id);
                                },
                                error: function(journey, error) {
                                    $(".loading").fadeOut();
                                    alert('Failed to create new object, with error code: ' + error.message);
                                }
                            });
                            //----------------------------------------------
                            $(".loadingDefault").fadeOut();
                        });
                    },
                    error: function(error) {
                        alert('' + error.message);
                        $(".loadingDefault").fadeOut();
                    }
                });
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                $(".loadingDefault").fadeOut();
            }
        });        
    });
    
//-----------------------------------------------
});