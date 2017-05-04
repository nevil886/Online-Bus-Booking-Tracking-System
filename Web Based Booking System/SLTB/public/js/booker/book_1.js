$(function(){
    var http = location.protocol;
    var slashes = http.concat("//");
    var host = slashes.concat(window.location.hostname);
    //alert(host+'/SLTB/booker/onlineBooker/');
    //if(host+'/SLTB/booker/onlineBooker/'==window.location)
    //window.location.replace("http://localhost/SLTB/index")
    /*_______________________________ Seat Book _______________________________*/
 
    //______________________________________________________________________________
    cliarPrint();
    sessionforSelectin_s();
    function cliarPrint() {
        //setTimeout(cliarPrint,3000);
        $('.print').html('');
    }
    
    function sessionforSelectin_s() {
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrgetSessionforSelectin_s',
            data:{
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                if(host+'/SLTB/booker/booking/' == window.location)
                    document.getElementById("selecting_seate_for_booker").value = o;
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
        
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrgetSessionforSelectin_s_tot',
            data:{
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                if(o != null){
                    if(host+'/SLTB/booker/booking/' == window.location)
                        document.getElementById("total_price_for_selecting_seate").value = o;
                }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }
    
    //______________________________function for session Time Out_______________
    sessionTimeOut();
    function sessionTimeOut() {
        timer = setTimeout(sessionTimeOut,1000);
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrSessionTimeOut',
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                if(o.length > 0){
                    clearAllSeateformDB(o);
                    $('.timeOut').html('');
                    clearTimeout(timer);
                    $("#passenger_info").remove();
                    $("#booker_info").remove();
                    if(host+'/SLTB/booker/booking/' == window.location){
                        document.getElementById("total_price_for_selecting_seate").value = 0;
                        document.getElementById("selecting_seate_for_booker").value = "";
                    }
                    $.each($('#place li.selectingSeat '), function (index, value) {
                        $(this).removeClass('selectingSeat');
                    //$(this).removeClass('pendingSeat');
                    });
                }else{
                    $.each($('#place li.selectingSeat '), function (index, value) {
                        if(($(this).hasClass('selectingSeat')))
                            $('.timeOut').html('Your Reservation Expires in ['+parseInt(o)+'] (s)'); //minute
                    });
                }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                clearTimeout(timer);
            }
        });
    }   
    //________________________click on the seate________________________________    
    
    $(".seat").live('click',function(){
        if ($(this).hasClass('selectedSeat')){
            //$(this).removeClass('selectedSeat');
            $('#print').html('This seat is already reserved ...');
        }
        
        else if ($(this).hasClass('selectingSeat') && $(this).hasClass('pendingSeat')){
            var allSeatNo = [], selectArry=[], i=0;
            allSeatNo.push($(this).attr('seatNo'));
            clearAllSeateformDB(allSeatNo);
            setSubtractionSessionforSelectin_s(allSeatNo)
            $(this).removeClass('selectingSeat');
            $(this).removeClass('pendingSeat');
            $.each($('#place li.selectingSeat '), function (index, value) {
                selectArry[i++]=i;
            });
            if(selectArry.length==0){
                $('.timeOut').html('');
                clearTimeout(timer);
            }
        }
        
        else if ($(this).hasClass('pendingSeat')){
            if (!($(this).hasClass('selectingSeat')))
                $('#print').html('This seat is hold other ...');
        }
        
        else if(!($(this).hasClass('selectingSeat'))){
            $(this).toggleClass('pendingSeat');
            $(this).toggleClass('selectingSeat');
            var selectArry_ = [],j=0;
            $.each($('#place li.selectingSeat '), function (index, value) {
                selectArry_[j++]=j;
            });
            if(selectArry_.length==1){
                setSessionforTime();
            }
            insertSeattoTable($(this).attr('seatNo'));
            setIncrementSessionforSelectin_s($(this).attr('seatNo'));
        }
        else{
            $('#print').html('Pls wait ...');
        }
    });
 
    //_________________function set Session for all Increment Selectin Seat_______________
    
    function setIncrementSessionforSelectin_s(seatNo) {
        var price = document.getElementById("seat_book_price").value;
        var tot_price = document.getElementById("total_price_for_selecting_seate").value;
        tot_price = parseInt(tot_price) + parseInt(price);
            
        
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrIncrementSessionforSelectin_s',
            data:{
                seatNo:seatNo,
                tot_price:tot_price
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                document.getElementById("selecting_seate_for_booker").value = o;
                document.getElementById("total_price_for_selecting_seate").value = tot_price;
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }
    
    //_________________function set Session for all Subtraction Selectin Seat_______________
    
    function setSubtractionSessionforSelectin_s(seatNo) {
        var price = document.getElementById("seat_book_price").value;
        var tot_price = document.getElementById("total_price_for_selecting_seate").value;
        tot_price = parseInt(tot_price) - parseInt(price);
            
        
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrSubtractionSessionforSelectin_s',
            data:{
                seatNo:seatNo,
                tot_price:tot_price
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                document.getElementById("selecting_seate_for_booker").value = o;
                document.getElementById("total_price_for_selecting_seate").value = tot_price;
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }
  
    //______________function insert Seat to Database____________________________  
    function insertSeattoTable(seatNo) {
        var busNo=document.getElementById("seat_book_busNo").value; 
        var bus_book_date= document.getElementById("seat_book_date").value;
        var journeyNo= document.getElementById("seat_book_journeyNo").value;             
        var status = 'P';
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrInsertBookingSeat',
            data:{
                seatNo:seatNo,
                busNo:busNo,
                journeyNo:journeyNo,
                bus_book_date:bus_book_date,
                status:status
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                var seatNo =[];
                $.each($('#place li.selectingSeat '), function (index, value) {
                    items = $(this).attr('seatNo');
                    seatNo.push(items);
                });
            //afterInsertSeat(seatNo);
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }
    
    //___________function After Insert Seat view new Bus seat___________________
    function afterInsertSeat(seatNo) {
        var seatNo = seatNo;
        var busNo=document.getElementById("seat_book_busNo").value; 
        var bus_book_date= document.getElementById("seat_book_date").value;
        var journeyNo= document.getElementById("seat_book_journeyNo").value;
        var noOfSeat= document.getElementById("seat_book_numberOfSeat").value;
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/viewBusSeat',
            data:{
                busNo:busNo,
                noOfSeat:noOfSeat,
                journeyNo:journeyNo,
                bus_book_date:bus_book_date,
                seatNo:seatNo
            },
            success:function(o){ //alert(1);
                $('#viweSeat').html(o);
            }
        });
    }
    
    //________function set Session for Time ____________________________________
    
    function setSessionforTime() {
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrsetSession',
            beforeSend:function(o){
            },
            success:function(o){
                sessionTimeOut();
            //abc();
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }
      
    //_________function clear All Seate form DB_________________________________  

    function clearAllSeateformDB(allSeatNo) {
        var seatNo = allSeatNo;  //alert(allSeatNo);          
        var status = 'P';
        var busNo=document.getElementById("seat_book_busNo").value; 
        var bus_book_date= document.getElementById("seat_book_date").value;
        var journeyNo= document.getElementById("seat_book_journeyNo").value;
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrClearAllSeate',
            data:{
                seatNo:seatNo,
                busNo:busNo,
                journeyNo:journeyNo,
                bus_book_date:bus_book_date,
                status:status
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                if(host+'/SLTB/booker/booking/' != window.location){
                    window.location.replace(host+"/SLTB/index");
                }
            //                $.each($('#place li.selectingSeat '), function (index, value) {
            //                    $(this).removeClass('selectingSeat');
            //                    $(this).removeClass('pendingSeat');
            //                });
                
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            //alert("error aaa"+errorThrown);
            }
        });
    }
    
    //_______________________________________________________________________________


    /*_______________________________  _______________________________*/

    $("#reset").live('click',function(){ //alert(1);
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrreset',
            data:{
            },
            success:function(o){ //alert(1);
                var seatNo =[];
                $.each($('#place li.selectingSeat '), function (index, value) {
                    items = $(this).attr('seatNo');
                    seatNo.push(items);
                });
                clearAllSeateformDB(seatNo);
                $('.timeOut').html('');
                document.getElementById("total_price_for_selecting_seate").value = 0;
                document.getElementById("selecting_seate_for_booker").value = "";
            }
        });
    });
    
    
    
});   