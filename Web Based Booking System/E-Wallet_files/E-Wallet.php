<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0056)https://ipg.dialog.lk/ezCashIPGExtranet/servlet_sentinal -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link href="https://ipg.dialog.lk/ezCashIPGExtranet/css/styles.css" rel="stylesheet">
<title>E-Wallet</title>

<script language="Javascript">

function Disable(form) {
	
	var validationError="";
	var mobileNumber=document.forms["form1"]["txtMobileNumber"].value;
	var txtMpin=document.forms["form1"]["txtMpin"].value;
	var txtNic=document.forms["form1"]["txtNic"].value;
	
	if(mobileNumber==""){
		document.forms["form1"]["txtMobileNumber"].style.backgroundColor="pink";
		validationError='Error';
	}else{
		document.forms["form1"]["txtMobileNumber"].style.backgroundColor="white";
	}
	 	
	if(txtMpin==""){
		document.forms["form1"]["txtMpin"].style.backgroundColor="pink";
		validationError='Error';
	}else{
		document.forms["form1"]["txtMpin"].style.backgroundColor="white";
	}
	
	if(txtNic==""){
		document.forms["form1"]["txtNic"].style.backgroundColor="pink";
		validationError='Error';
	}else{
		document.forms["form1"]["txtNic"].style.backgroundColor="white";
	}
	
	if(validationError==""){
		return true;
	}else{
		return false;
	}	
}
</script>


</head>

<body>


<form name="form1" onsubmit="return Disable(this);" method="post" action="http://localhost/SLTB/bookingSeat/paymentConform/">				
	<div id="main" class="round">
		<div>
        	<div>
           	  <div>

                    <!-- Your Content will Go here -->
                  <div style=" padding:25px;">
					<?php $bookingID = $_POST['bookingID']; 
					echo '<input type="hidden" name="bookingID" id="selecting_s" value="' . $bookingID . '">';
					?>
                      <table width="510" border="0" cellpadding="0" cellspacing="0">
                        <tbody><tr>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td height="19" background="./E-Wallet_files/line.gif"><strong>Pay Merchant</strong></td>
                          <td background="./E-Wallet_files/line.gif">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
						<tr>
                          <td>Booking ID : <?php echo $bookingID; ?></td>
                          <td>Ammount : <?php echo $_POST['ammount']; ?></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="213"><strong>Transaction Information</strong></td>
                          <td width="297">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td><label></label></td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp;Customer Mobile Number</td>
                          <td><label>
                           :
                            <input type="text" class="text" name="txtMobileNumber" value=" "  id="txtMobileNumber">

                            <span class="style2">*</span><span class="style1"> (Starts with 77xxxxxxx)</span></label></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp;Customer PIN</td>
                          <td><label>
                            :
                            <input type="password" class="text" name="txtMpin" value=""  id="txtMpin">
                            <span class="style2">*</span> </label></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;&nbsp; </td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp; <label>
                            <input class="text" type="submit" value="Ok" name="Submit">
                            <input class="text" type="reset" value="Reset" name="reset">
                          </label></td>
                        </tr>
                      </tbody></table>
                      <p>&nbsp;</p>

                </div>
               	<!-- Your Content will End here -->
              </div>
            </div>
        </div>
	</div>
        </form>
		



</body></html>