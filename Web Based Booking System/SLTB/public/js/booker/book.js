$(function(){
    
    var busNo=document.getElementById("seat_book_busNo").value; 
    var bus_book_date= document.getElementById("seat_book_date").value;
    var journeyNo= document.getElementById("seat_book_journeyNo").value;
    
    cliarPrint();
    $(".seat").live('click',function(){
        if ($(this).hasClass('selectedSeat')){
            $('#print').html('This seat is already reserved ...');
        }
        else if ($(this).hasClass('selectingSeat') && $(this).hasClass('pendingSeat')){
            var allSeatNo = [], selectArry=[], i=0;
            allSeatNo.push($(this).attr('seatNo'));
            clearAllSeate(allSeatNo);
            $(this).removeClass('selectingSeat');
            $(this).removeClass('pendingSeat');
            $.each($('#place li.selectingSeat '), function (index, value) {
                selectArry[i++]=i;
            });
            if(selectArry.length==0){
                $('#timeOut').html('');
                clearTimeout(timer);
            }
        }
        
        else if ($(this).hasClass('pendingSeat')){
            if (!($(this).hasClass('selectingSeat')))
                $('#print').html('This seat is hold other ...');
        //sessionTimeOut();
        }
        else if(!($(this).hasClass('selectingSeat'))){
            $(this).removeClass('cancelSeat');
            $(this).toggleClass('selectingSeat');
            //setSession();
            insertSeattoTable($(this).attr('seatNo'));
        }
        else{
            $('#print').html('Pls wait ...');
        }
    });
    
    function cliarPrint() {
        setTimeout(cliarPrint,2500);
        $('#print').html('');
    }
    
    function setSession() {
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrsetSession',
            beforeSend:function(o){
            },
            success:function(o){
                sessionTimeOut();
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }
    
    function sessionTimeOut() {
        var allSeatNo = []
        timer = setTimeout(sessionTimeOut,1000);
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrSessionTimeOut',
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                $('#timeOut').html('Your Reservation Expires in ['+o+'] S');
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                $('#timeOut').html('');
                $.each($('#place li.selectingSeat '), function (index, value) {
                    items = $(this).attr('seatNo');
                    $(this).toggleClass('selectingSeat');//alert(1);
                    allSeatNo.push(items);
                }); //alert(allSeatNo);
                clearAllSeate(allSeatNo);
                clearTimeout(timer);
            }
        });
    }
    
    function insertSeattoTable(seatNo) {
        //alert(sNo);              
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
                var selectArry = [],i=0;
                $.each($('#place li.selectingSeat '), function (index, value) {
                    selectArry[i++]=i;
                });
                //console.log(selectArry.length);
                if(selectArry.length==1){
                    setSession();
                }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }
    
    function clearAllSeate(allSeatNo) {
        var seatNo = allSeatNo;  //alert(allSeatNo);          
        var status = 'P';
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
                for(var i = 0; i<seatNo.length; i++){
                    $('li[seatno="'+seatNo[i]+'"]').removeClass("pendingSeat");//alert(1);
                }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            //alert("error aaa"+errorThrown);
            }
        });
    }
    
    
});   