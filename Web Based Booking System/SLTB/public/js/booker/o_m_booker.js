//______________________________________________________________________________
$(function(){
    var http = location.protocol;
    var slashes = http.concat("//");
    var host = slashes.concat(window.location.hostname);
    //alert(1);
    getSessionSelectin_s();
    function getSessionSelectin_s() {
        //var allSeatNo = []
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/getSessionSelectin_s',
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                $('#passenger_info').append('<table cellpadding="0" width="500" cellspacing="5" border="0">');
                $('#passenger_info').append('<tr><th>Seat No</th><th>Passenger Name</th><th>Gender</th></tr>');
                for (var i=0;i<o.length;i++){
                    $('#passenger_info').append('<tr><td>'+ o[i]+'<input type="hidden" name="seat'+i+'" value="'+ o[i]+'"/></td><td><input id="" class="" type="text" name="passenger'+i+'"  value="" ></td><td><input name="gender'+i+'" type="radio" value="M" checked=""/>Male<input name="gender'+i+'" type="radio" value="F"/>Female</td></tr>');
                }
                $('#passenger_info').append('</table>');
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                
            }
        });
    }   

    $('#booker_data').live('click',function(){
        var booker_nic = document.getElementById("booker_nic").value;
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrserchBookerInfo',
            data:{
                booker_nic:booker_nic
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                document.getElementById("bookername").value = o[0].bookerName;
                document.getElementById("booker_mno").value = o[0].bookerMNo;
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    //alert("ok");
    });
    
    timeOut();
    function timeOut() {//alert("ok");
        timer = setTimeout(timeOut,1000);
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrtimeOut',
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                if(o == 1){
                    $('#timeOutBooking').html('Your Reservation Expires in ['+parseInt(o)+'] (s)');
                    $('#timeOutBooking').html('');
                    clearTimeout(timer);
                    if(host+'/SLTB/booker/booking/' != window.location){
                    window.location.replace(host+"/SLTB/index");
                    }
                }else
                    $('#timeOutBooking').html('Your Reservation Expires in ['+parseInt(o)+'] (s)');
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                clearTimeout(timer);
            }
        });
    }   

});