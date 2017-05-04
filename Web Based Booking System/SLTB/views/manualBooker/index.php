<title>Sri Lanka Online Bus Ticket Booking</title>


<link href="css/div.css" rel="stylesheet" type="text/css" />
<link href="css/seatview.css" rel="stylesheet" type="text/css" />
<div id="main_about">
    <script>
        $(document).ready(function() {
 
  
            $("#Submit").click(function()
            {
                var busSeatEmty = document.getElementById("selectViewSeat").value;
                $("#divErrorMsg").removeClass().hide();
                if(busSeatEmty==""){
                    $("#divErrorMsg").removeClass().addClass('messageboxerror').text('__Seleted Seat Empty!').show();
                    return false;
                }
	
	
	
                //alert(busSeatEmty);
	
            });
  
        });
    </script>
    <div id="about_panel">
        <h3>Bus Seat Booking</h3>
        <div id="busViews">

            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="274" height="40" align="left" valign="middle"><span class="tx3">Service Provider : </span>&nbsp;THE TRAVELLER</td>
                    <td colspan="2" align="left" valign="middle"><span class="tx3">Travelling  From  :</span> &nbsp;COLOMBO&nbsp;&nbsp;<span class="tx3">To  :</span>&nbsp;&nbsp;JAFFNA</td>
                </tr>
                <tr>
                    <td height="40" align="left" valign="middle"><span class="tx3">Travelling Date :</span>
                        2014-03-04</td>
                    <td width="177" align="left" valign="middle"><span class="tx3">Bus Fare : </span>&nbsp;
                        Rs 1350.00</td>
                    <td width="149" align="left" valign="middle"><span class="tx3">Bus Type : </span>&nbsp;TATA GLOBUS</td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td> <div id="seatInfoPot"></div></td>
                    <td>&nbsp;</td>
                </tr>
            </table>





            <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="500" height="40" align="left" valign="middle">   <script type="text/javascript">
                        $(function () {
                            var settings = {
                                rows: 11,
                                cols: 5,
                                rowCssPrefix: 'row-',
                                colCssPrefix: 'col-',
                                seatWidth: 40,
                                seatHeight: 40,
                                seatCss: 'seat',
                                hideSeatCss: 'hidingSeats',
                                removeSeatCss: 'hidingSeat',
                                selectedSeatCss: 'selectedSeat',
                                selectedSeatTmpCss: 'selectedSeatTmp',
                                selectingSeatCssby: 'selectingSeatby',
                                selectingSeatCss: 'selectingSeat'
                            };
			
			
	
                            Array.prototype.unique = function () {
                                var r = new Array();
                                o:for(var i = 0, n = this.length; i < n; i++)
                                {
                                    for(var x = 0, y = r.length; x < y; x++)
                                    {
                                        if(r[x]==this[i])
                                        {
                                            //alert('this is a DUPE!');
                                            continue o;
                                        }
                                    }
                                    r[r.length] = this[i];
                                }
                                return r;
                            }
	
	
                            function findingNamed(seatNo){
                                if(seatNo=='1'){ return '3'; }
                                if(seatNo=='2'){ return '8'; }
                                if(seatNo=='3'){ return '12'; }
                                if(seatNo=='4'){ return '16'; }
                                if(seatNo=='5'){ return '20'; }
                                if(seatNo=='6'){ return '24'; }
                                if(seatNo=='7'){ return '28'; }
                                if(seatNo=='8'){ return '32'; }
                                if(seatNo=='9'){ return '36'; }
                                if(seatNo=='10'){ return '40'; }
                                if(seatNo=='11'){ return '45'; }
                                if(seatNo=='12'){ return '4'; }
                                if(seatNo=='13'){ return '7'; }
                                if(seatNo=='14'){ return '11'; }
                                if(seatNo=='15'){ return '15'; }
                                if(seatNo=='16'){ return '19'; }
                                if(seatNo=='17'){ return '23'; }
                                if(seatNo=='18'){ return '27'; }
                                if(seatNo=='19'){ return '31'; }
                                if(seatNo=='20'){ return '35'; }
                                if(seatNo=='21'){ return '39'; }
                                if(seatNo=='22'){ return '44'; }
                                if(seatNo=='33'){ return '43'; }
                                if(seatNo=='34'){ return '2'; }
                                if(seatNo=='35'){ return '6'; }
                                if(seatNo=='36'){ return '10'; }
                                if(seatNo=='37'){ return '14'; }
                                if(seatNo=='38'){ return '18'; }
                                if(seatNo=='39'){ return '22'; }
                                if(seatNo=='40'){ return '26'; }
                                if(seatNo=='41'){ return '30'; }
                                if(seatNo=='42'){ return '34'; }
                                if(seatNo=='43'){ return '38'; }
                                if(seatNo=='44'){ return '42'; }
                                if(seatNo=='45'){ return '1'; }
                                if(seatNo=='46'){ return '5'; }
                                if(seatNo=='47'){ return '9'; }
                                if(seatNo=='48'){ return '13'; }
                                if(seatNo=='49'){ return '17'; }
                                if(seatNo=='50'){ return '21'; }
                                if(seatNo=='51'){ return '25'; }
                                if(seatNo=='52'){ return '29'; }
                                if(seatNo=='53'){ return '33'; }
                                if(seatNo=='54'){ return '37'; }
                                if(seatNo=='55'){ return '41'; }
				
                            }
			
				

                            var init = function (reservedSeat,tempReservedSeat,bookedSeatsTmpBy,removeSeat) {
                                var str = [], seatNo, className,newSeat=0;
                                for (i = 0; i < settings.rows; i++) {
                                    for (j = 0; j < settings.cols; j++) {

                    
                                        seatNo = (i + j* settings.rows  + 1);
                                        var namedCustom = findingNamed(seatNo);
							
                                        className = settings.seatCss + ' ' + settings.rowCssPrefix + i.toString() + ' ' + settings.colCssPrefix + j.toString();
                                        if($.isArray(bookedSeatsTmpBy) && $.inArray(seatNo, bookedSeatsTmpBy) != -1) {
                                            className += ' ' + settings.selectingSeatCssby;
                                            newSeat = newSeat  + 1;
                                        }else if ($.isArray(removeSeat) && $.inArray(seatNo, removeSeat) != -1) {
                                            className += ' ' + settings.hideSeatCss;
							
                                        }else if($.isArray(reservedSeat) && $.inArray(seatNo, reservedSeat) != -1) {
                                            className += ' ' + settings.selectedSeatCss;
                                            newSeat = newSeat  + 1;
                                        }else if($.isArray(tempReservedSeat) && $.inArray(seatNo, tempReservedSeat) != -1) {
                                            className += ' ' + settings.selectedSeatTmpCss;
                                            newSeat = newSeat  + 1;
                                        }else{ newSeat = newSeat  + 1; }
						
                                        if(namedCustom!=' '){ seatCustomze=namedCustom;  }else{ seatCustomze=newSeat; }
                                        str.push('<li class="' + className + '"' +
                                            'style="top:' + (j * settings.seatHeight).toString() + 'px;left:' + (i * settings.seatWidth).toString() + 'px" viewSeat=' + seatCustomze+' realSeat='+seatNo+'>' +
                                            '<a title="' + seatCustomze + '" realSeat='+seatNo+' class="seatNumber" >' + seatCustomze + '</a>' +
                                            '</li>');
                                    }
                                }
               
                                $('#place').html(str.join(''));
                            };

                            //case I: Show from starting
                            //init();

                            //Case II: If already booked
			
                            var bookedSeats = [];
                            var bookedSeatsTmp = [1,];
                            var bookedSeatsTmpBy = [1];
                            var hideSeats = [23,24,25,26,27,28,29,30,31,32,];
                            init(bookedSeats,bookedSeatsTmp,bookedSeatsTmpBy,hideSeats);


                            $('.' + settings.seatCss).click(function () {
			
                                if ($(this).hasClass(settings.selectingSeatCssby)){
				
                                    var mineView = $(this).attr('viewSeat');
                                    var mineReal = $(this).attr('realSeat');
                                    $.post("common/ajexdtf.php?removeSeat",{ 
                                        selectViewSeat:mineView, busdate:$("#busdate").val(),rtbid:$("#rtbid").val(),bus_unic_id:$("#bus_unic_id").val(),realseatno:mineReal  } ,function(data){
                                        //alert('wait...this seat removing...');
                                        $("#seatInfoPot").html('Please Wait...').addClass('messageboxerror').show().fadeOut(10000);	
                                        //alert(data);
                                    });
			
				
                                    //alert(mines+"This seat yours");
                                }else if ($(this).hasClass(settings.selectedSeatTmpCss)){
				
                                    selectSeat();
                                    $("#seatInfoPot").html('This seat is under pending status').addClass('messageboxerror').show().fadeOut(10000);
                                }else if ($(this).hasClass(settings.selectedSeatCss)){
                                    selectSeat();
                                    $("#seatInfoPot").html('Seat already reserved').addClass('messageboxerror').show().fadeOut(10000);
				
                                }
                                else{
                                    $(this).toggleClass(settings.selectingSeatCss);
                                    selectSeat();
                                }
				
                            });
			
                            function selectSeat(){
                                var slctSeat = [3],realSeat=[1], busfair='1350.00', totSeat=0;;
				
                                $.each($('#place li.'+ settings.selectingSeatCss + ' a'), function (index, value) {
                                    items = $(this).attr('title'); 
                                    slctSeat.push(items); 
                                    ritem=$(this).attr('realSeat');                  
                                    realSeat.push(ritem);
					
                                });
				
				
	
				
                                var myslctSeat = slctSeat.unique();
                                var myrealSeat= realSeat.unique();
                                totSeat = myslctSeat.length;
                                //alert(totSeat);
                                //alert(slctSeat.join(',').split(',').length);
                                document.getElementById('selectViewSeat').value = myslctSeat;
                                document.getElementById('selectRealSeat').value = myrealSeat;
                                document.getElementById('selectValue').value = (totSeat*busfair).toFixed(2);
				
                                $.post("common/ajexdtf.php?bookingSeat",{ selectViewSeat:$("#selectViewSeat").val(),busdate:$("#busdate").val(),rtbid:$("#rtbid").val(),bus_unic_id:$("#bus_unic_id").val(),realseatno:$("#selectRealSeat").val()  } ,function(data)
                                {
                                    //alert(data); Function Working
                                    //alert(data);
                                    if(data == 'b4used')
                                    {
                                        alert('Seat already hold');
                                        //location.reload();
                                        //window.location = document.URL;
                                    }
                                });
		
                            }

          
		   
                        });
    
                        </script>
                        &nbsp;
                        <div class="msg_text" id='thisDiv'></div>

                        <div id="diver"><img src="css/images/driver_seat_img.gif" width="33" height="33"></div>
                        <div id="holder"> 

                            <ul  id="place">
                            </ul>
                        </div>
                    </td>
                    <td width="187" colspan="2" align="left" valign="top">

                        <table width="176" border="0" align="right" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="15" align="left" valign="middle">&nbsp;</td>
                                <td width="50" height="45" align="left" valign="middle"><img src="css/images/available_seat_img.gif" width="33" height="33" /></td>
                                <td width="111" align="left" valign="middle"><span class="tx3">Available</span></td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle">&nbsp;</td>
                                <td height="45" align="left" valign="middle"><img src="css/images/selected_seat_img.gif" width="33" height="33" /></td>
                                <td align="left" valign="middle"><span class="tx3">Your  Selection</span></td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle">&nbsp;</td>
                                <td height="45" align="left" valign="middle"><img src="css/images/pending_seat_img.gif" width="33" height="33" /></td>
                                <td align="left" valign="middle"><span class="tx3">Hold Other</span></td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle">&nbsp;</td>
                                <td height="45" align="left" valign="middle"><img src="css/images/booked_seat_img.gif" width="33" height="33" /></td>
                                <td align="left" valign="middle"><span class="tx3">Booked</span></td>
                            </tr>
                        </table>


                    </td>
                </tr>
            </table>



        </div>

    </div>

    <div id="rt_side">
        <h3>Selected Seat </h3>
        <h2>Feel free working with us</h2>
        <div id="seatForm">


            <div>
                <p style="height:60px;">
                    <label>Seat #  :</label>

                    <textarea name="selectViewSeat" class="form" id="selectViewSeat" style="width:140px; height:45px;">3</textarea>
                </p>
                <p>
                    <label>Value ( Rs ): </label>
                    <input name="selectValue" type="text" class="form" id="selectValue" style="width:80px;" value="1,350.00" >
                </p>
                <p>
                    <script> function onButtonClick(){
              document.location = "busdatesearch.php?busfrom=1&busto=55&busdate=2014-03-04";
          } </script>

                    <input name="busdate" type="hidden" id="busdate" value="2014-03-04">
                    <input name="strid" type="hidden" id="strid" value="5">
                    <input name="rtbid" type="hidden" id="rtbid" value="12">
                    <input name="bus_unic_id" type="hidden" id="bus_unic_id" value="63b8b108db85f6e18d2f7273a2510202">
                    <input name="selectRealSeat" id="selectRealSeat" type="hidden" value="1"> 
                </p>


                <input name="Submit" id="Submit" type="image" src="images/battons/continue.jpg" style="border:0; height:23px; width:80px;" class="button" value="Continue" />
                <input name="back" type="image" src="images/battons/reset.jpg" style="border:0; height:23px; width:80px;" class="button" value="&laquo; Back" onclick="onButtonClick();"/>


            </div>
            <div id="divErrorMsg"></div>

        </div>




    </div>

</div>