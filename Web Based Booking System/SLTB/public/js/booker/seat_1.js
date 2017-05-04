//http://www.citstudio.com/articles/jquery-seat-reservation/
$(function(){ 
    setSeat();
     
     
    function setSeat() { //alert(1);
        var session = 1;
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
                session:session
            },
            success:function(o){ //alert(1);
                $('#viweSeat').html(o);
                startRefresh();
            }
        });
    }

    function getselectingSeat(handleData) {
        var seatNo =[];
        $.each($('#place li.selectingSeat '), function (index, value) {
            items = $(this).attr('seatNo');
            seatNo.push(items);
        });
        handleData(seatNo);
    }
    
    function startRefresh() {
        
        getselectingSeat(function(seatNo){
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

        });
    setTimeout(startRefresh,2000);
    }

});