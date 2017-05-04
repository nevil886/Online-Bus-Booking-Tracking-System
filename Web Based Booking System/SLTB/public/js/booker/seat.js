//http://www.citstudio.com/articles/jquery-seat-reservation/
$(function(){ 
    //        var rows="";
    //        
    //        if((rows != null))
    //            alert(1);
    //        else
    //            alert(2);
    // var url = location.pathname.split("/");
    //        alert(url[4]);

    //alert(url[2]);
    
    //================================================
    
    //================================================
   
    var busNo=document.getElementById("seat_book_busNo").value; 
    var noOfSeat = document.getElementById("seat_book_numberOfSeat").value;
    var bus_book_date= document.getElementById("seat_book_date").value;
    var journeyNo= document.getElementById("seat_book_journeyNo").value;
    var bookSeat=[];
    var bookStatus=[];
    
    //++++++++++++++++++++++++++++++++++++++++++++++++
    /* funtion is getBus Data*/
    
    /* call  searchAvailableSeat funtion get Available Seat bookStatus*/
    searchAvailableSeat();
     
    //++++++++++++++++++++++++++++++++++++++++++++++++ 

    
    /* funtion is get Available Seat*/
    function searchAvailableSeat() {
        
        $.post('/SLTB/booker/xhrSearchAvailableSeat',{
            'busNo':busNo,
            'bus_book_date':bus_book_date,
            'journeyNo':journeyNo
        },function(o){  
            for (var u=0;u<o.length;u++){
                bookSeat[u]=o[u].seatNo;
                bookStatus[u]=o[u].status;
            }//alert(1);
            /* call  displayBusSeat funtion display Bus Seat on web page*/
            displayBusSeat();
        },'json');
        return true;
    }
    
    /* funtion is set Seat*/
    function displayBusSeat() {
        var rows = 5;
        var cols = 13;
//        var rows2 = 5;
//        var cols2 = 10;
        var rowCssPrefix = 'row-';
        var colCssPrefix = 'col-';
        var seatWidth = 40;
        var seatHeight = 40;
        var seatCss = 'seat';
        var hidingSeatCss = 'hidingSeats';
        var selectedSeatCss = 'selectedSeat';
        var selectingSeatCss = 'selectingSeat';
        var pendingSeatCss = 'pendingSeat';
        var str = [], seatNo, className, p, x=0; //alert(noOfSeat);
                              
        
        if(noOfSeat == 49){
            for (var i=0; i < cols; i++) {
                for (var j = 0; j < rows; j++) {
                    p = (i* rows + j + 1);
                    if(p==3 || p==8 || p==13 || p==18 || p==23 || p==28 || p==33|| p==38|| p==43|| p==48|| p==53|| p==58|| p==4 || p==5 || p==39 || p==40){
                        seatNo = null;
                        className = seatCss + ' ' + hidingSeatCss + ' ' + rowCssPrefix + i.toString() + ' ' + colCssPrefix + j.toString();
                    }else{
                        seatNo = (++x); //bookSeat=[5,8,9];
                        for (var v = 0; v < bookSeat.length; v++){ //alert(x); alert(bookSeat[v]);
                            if(x == bookSeat[v]){
                                if(bookStatus[v]=='B')
                                    className = seatCss  + ' ' + rowCssPrefix + i.toString() + ' ' + colCssPrefix + j.toString() + ' ' + selectedSeatCss;
                                if(bookStatus[v]=='P')
                                    className = seatCss  + ' ' + rowCssPrefix + i.toString() + ' ' + colCssPrefix + j.toString() + ' ' + pendingSeatCss;
                                break;
                            }else{
                                className = seatCss + ' ' + rowCssPrefix + i.toString() + ' ' + colCssPrefix + j.toString();
                            }
                        }
                    }
                    str.push('<li class="' + className + '"' + 'seatno="' + seatNo + '"' +'style="top:' + (j * seatHeight).toString() + 'px;left:' + (i * seatWidth).toString() + 'px">' +'<a title="' + seatNo + '">' + seatNo + '</a>' +'</li>');
                }
            }
        }
//        else if(noOfSeat == 400){
//            for (var i=0; i < cols2; i++) {
//                for (var j = 0; j < rows2; j++) {
//                    p = (i* rows2 + j + 1);
//                    if(p==3 || p==8 || p==13 || p==18 || p==23 || p==28 || p==33|| p==38|| p==43|| p==48|| p==53|| p==58|| p==4 || p==5 || p==39 || p==40){
//                        seatNo = null;
//                        className = seatCss + ' ' + hidingSeatCss + ' ' + rowCssPrefix + i.toString() + ' ' + colCssPrefix + j.toString();
//                    }else{
//                        seatNo = (++x); //bookSeat=[5,8,9];
//                        for (var v = 0; v < bookSeat.length; v++){ //alert(x); alert(bookSeat[v]);
//                            if(x == bookSeat[v]){
//                                if(bookStatus[v]=='B')
//                                    className = seatCss  + ' ' + rowCssPrefix + i.toString() + ' ' + colCssPrefix + j.toString() + ' ' + selectedSeatCss;
//                                if(bookStatus[v]=='P')
//                                    className = seatCss  + ' ' + rowCssPrefix + i.toString() + ' ' + colCssPrefix + j.toString() + ' ' + pendingSeatCss;
//                                break;
//                            }else{
//                                className = seatCss + ' ' + rowCssPrefix + i.toString() + ' ' + colCssPrefix + j.toString();
//                            }
//                        }
//                    }
//                    str.push('<li class="' + className + '"' + 'seatno="' + seatNo + '"' +'style="top:' + (j * seatHeight).toString() + 'px;left:' + (i * seatWidth).toString() + 'px">' +'<a title="' + seatNo + '">' + seatNo + '</a>' +'</li>');
//                }
//            }
//        }
        $('#place').html(str.join(''));
        //startRefresh();
    }

    //______________________________________________________________________________________________________
    
    function searchAvailableSeatAfterUpdate(handleData) {
        
        var bookSeatAfter=[];
        var bookStatusAfter=[];
        var alData=[];
        $.ajax({
            type:'POST',
            url:'/SLTB/booker/xhrSearchAvailableSeat',
            data:{
                busNo:busNo,
                bus_book_date:bus_book_date,
                journeyNo:journeyNo
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){ 
                for (var u=0;u<o.length;u++){
                    bookSeatAfter[u]=o[u].seatNo;
                    bookStatusAfter[u]=o[u].status;
                }
                alData[0]=bookSeatAfter;
                alData[1]=bookStatusAfter; //console.log(alData);
                handleData(alData);
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            //alert("error aaa"+errorThrown);
            }
        });
    }
    
    function startRefresh() {
        
        searchAvailableSeatAfterUpdate(function(seat){
            for (var i = 1; i < noOfSeat; i++){ //alert(1); //alert(bookSeat[v]);
                $('li[seatno="'+i+'"]').removeClass('pendingSeat');
                for (var j = 0; j < seat[0].length; j++){
                    //alert( i +' '+seat[0][j]);
                    if(i==seat[0][j]){ //break;
                        if(seat[1][j]=='B'){
                            $('li[seatno="'+i+'"]').addClass("selectedSeat");        
                        }
                        if(seat[1][j]=='P'){ //alert('p');
                            $('li[seatno="'+i+'"]').addClass("pendingSeat");
                        }
                        break;
                    }
                }
            }

        });
        setTimeout(startRefresh,1000);
    }
    
///______________________________________________________________________________________________________
    
  
});

$("#btnShowNew").live('click',function(){ 
    //alert(1);
    //        //var str = [], item;
    //$.each($('#place li.seat'), function (index, value) {
    //    if($(this).attr('seatno') == 3)
    //        $(this).toggleClass('selectedSeat');
    // });
    ////alert(str.join(','));
    //});
    //    
    //    var j=1;
    //
    //    //$('li[seatno="'+j+'"]').removeClass("blue");
    //    //$('li[seatno="'+j+'"]').hasClass('selectedSeat');
    //    if($('li[seatno="'+j+'"]').toggleClass('selectedSeat')){
    //        $('li[seatno="'+j+'"]').removeClass('selectedSeat');
    //        $('li[seatno="'+j+'"]').addClass("selectedSeat");
    //    }
    //
    //    else if($('li[seatno="'+j+'"]').toggleClass('pendingSeat')){
    //        $('li[seatno="'+j+'"]').removeClass('pendingSeat');
    //        $('li[seatno="'+j+'"]').addClass("pendingSeat");
    //    }
    //
    //    else if($('li[seatno="'+j+'"]').toggleClass('selectingSeat')){
    //        $('li[seatno="'+j+'"]').removeClass('selectingSeat');
    //        $('li[seatno="'+j+'"]').addClass("selectingSeat");
    //    }



    });