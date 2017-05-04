$(function(){
   
    //  $(document).ready(function(){
    $('input[name="cBus_departureTime"]').timepicker(); //ptTimeSelect();
    //    });
    
    //    $(document).ready(function(){
    $('input[name="cBus_arrivalTime"]').timepicker(); //ptTimeSelect();
    //    });
  
    //    $(document).ready(function(){
    $('input[name="uBus_departureTime"]').timepicker(); //ptTimeSelect();
    //    });
    
    //    $(document).ready(function(){
    $('input[name="uBus_arrivalTime"]').timepicker(); //ptTimeSelect();
    //    });  
    
    $('.datepicker_bus_date').datepicker({ 
        dateFormat: 'yy-mm-dd',
        minDate:0
    });
        
    $('.datepicker_repot').datepicker({ 
        dateFormat: 'yy-mm-dd'
    });
 
//  <input name="time" value="" />
   
});