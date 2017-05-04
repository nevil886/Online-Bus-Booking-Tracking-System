$(function(){ 
    $("#exampleBooker tr").live('click',function(){
        //alert(1);
        document.getElementById("book_busNo").value=$(this).find("td").eq(0).html();
        document.getElementById("book_numberOfSeat").value=$(this).find("td").eq(1).html();
        document.getElementById("book_price").value=$(this).find("td").eq(6).html();
    
//        $.ajax({
//            type:'POST',
//            url:'/SLTB/booker/booking',
//            data:{
//                book_date:document.getElementById("book_date").value,
//                book_journeyNo:document.getElementById("book_journeyNo").value,
//                book_busNo:$(this).find("td").eq(0).html(),
//                book_numberOfSeat:$(this).find("td").eq(1).html(),
//                book_price:$(this).find("td").eq(6).html()
//            },
//            dataType:'json',
//            beforeSend:function(o){
//            },
//            success:function(o){
//            //alert(' [ Route No => '+o[0].routeNo + ']\n [ Journey From => '+o[0].journeyFrom + ' ]\n [ Journey To => '+o[0].journeyTo + ' ]\n [ Dep. Time => '+o[0].departureTime+' ]'); 
//            //alert("sometext \n"+"defaultText");
//            },
//            error : function(XMLHttpRequest, textStatus, errorThrown){
//            }
//        });
            
    });
//    abcx();
//        
//    function abcx() {
//        setTimeout(abcx,1000);
//        var allSeatNo = [];
//        $.each($('#place li.selectingSeat '), function (index, value) {
//            items = $(this).attr('seatNo');
//            //alert(1);
//            allSeatNo.push(items);
//        });
//        document.getElementById("selecting_s").value=allSeatNo;
//    }
       
//       $.ajax({
//            url:'/SLTB/booker/abc',
//            success:function(data){ //alert(1);
//                $('#abc').html(data);
//            }
//        });
      
  
                
});