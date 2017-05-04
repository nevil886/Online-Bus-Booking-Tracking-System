$(function(){ //alert(1);
$(document).ready(function() {
   
//                                $('#example').dataTable( {
//					"sDom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'
//				} );
                                
				$('#example').dataTable( {
					//"sScrollY": 300,
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				} );
                                
                                $('#exampleBooker').dataTable( {
					"bFilter": false,
                                        "bPaginate": false,
                                        "bInfo": false,
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				} );
                                
//                                oTable = $('#example').dataTable({
//					"bJQueryUI": true,
//					"sPaginationType": "full_numbers"
//				});

});


$(document).ready(function(){
	//alert(1);
        
//     $("#bus_form").validate({
//  
//   submitHandler: function(form) {
//    form.submit();
//  }
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
});