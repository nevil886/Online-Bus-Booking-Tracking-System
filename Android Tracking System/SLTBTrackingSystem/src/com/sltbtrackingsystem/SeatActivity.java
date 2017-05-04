package com.sltbtrackingsystem;

import java.util.Arrays;
import java.util.List;

import com.parse.FindCallback;
import com.parse.Parse;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.LightingColorFilter;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

public class SeatActivity extends Activity {
	int day ;
    int month;
    int year;
    
    String journeyNo = null;
	String busNumber = null;
    int no_of_seat=40;
	String journeyDate = null;
	String setMonth;
	String setDay;
	
	int i;
	int j;
	int p,q,r = 0;
	
	private int[] bookedSeat = new int[50];
	int x = 0;
	int y = 0;
	
	int btnId;
	boolean status=false;
	boolean confirmMasseg=false;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_seat);
		
		Intent intent = getIntent();
		Bundle extras = getIntent().getExtras();
		
		day = extras.getInt("day");
	    month =extras.getInt("month");
	    year = extras.getInt("year");
	    
	    if((month+1)<10)
	    	setMonth='0'+String.valueOf(month+1);
	    else
	    	setMonth= String.valueOf(month+1);
	    
	    if((day)<10)
	    	setDay='0'+String.valueOf(day);
	    else
	    	setDay= String.valueOf(day);
	    
	    busNumber = intent.getStringExtra("busNumber");
		journeyNo = intent.getStringExtra("journeyNo");
		no_of_seat = intent.getIntExtra("no_of_seat",0);
		
		journeyDate = String.valueOf(year)+'-'+setMonth+'-'+setDay;
		
		ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar1);
		progressBar.setVisibility(View.GONE);
		
		TextView txtBusNo = (TextView) findViewById(R.id.textView1);
		txtBusNo.setText("Bus Number is "+busNumber);
		//txtBusNo.setText(busNumber+" "+journeyNo+" "+journeyDate);
   		Parse.initialize(this,"w6sOkx6IXZPloTIkWcdbfX3RxKrrPJZmWPIGHeYk","3avqsVGqNOLwIQQMst9PMxlIArOfwzkYB6Ls9t1u");//Connection to Parse (Application ID /Client Key)
   		onGetBookedSeat();
   		
	}
	
	private void onGetBookedSeat() {
		final ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar1);
		progressBar.setVisibility(View.VISIBLE);
		ParseQuery<ParseObject> query = ParseQuery.getQuery("Booking_Infor"); // get all data from object to table
		query.whereEqualTo("journeyNo",journeyNo);	//filter query equal bus no	(table bus no/enter bus no)
		query.whereEqualTo("busNo",busNumber);
		query.whereEqualTo("status","B");
		query.whereEqualTo("journeyDate",journeyDate);
		query.findInBackground(new FindCallback<ParseObject>() {//	Manipulate array data	
			@Override
			public void done(List<ParseObject> objs, ParseException e) {
				if (e == null) {
					 if(objs.size()==0){ //check Already have or not this bus data
						 
					 }else{//++ data to table ++++
						  bookedSeat[x++] = 0;
						 	 for(ParseObject obj:objs){
						 		bookedSeat[x++] = obj.getInt("seatNo");
						 	 }
					 	 	
					 }
					 //--View Seat----------------------------------------
					 if(no_of_seat == 49)
						 onViewSeatLarge();
					 else if(no_of_seat == 40)
						 onViewSeatSmall();
					 //---------------------------------------------------
				} else {
					progressBar.setVisibility(View.GONE);
				    Toast.makeText(getBaseContext(),"Please check your internet connection.", Toast.LENGTH_LONG).show();	        	 		
		        }
			}
		 });
	}
	
	private void onViewSeatLarge() {
		final ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar1);
		LinearLayout myLayout = (LinearLayout) findViewById(R.id.linearLayout1);
   		final int[] numbers = {0,3,4,5,8,13,18,23,28,33,38,39,40,43,48,53,58};
   		  
   		   
   		for(i=1; i<=13; i++){
   		   q=4;
     	   for(j=0; j<5; j++){
     		    LinearLayout.LayoutParams buttonParams = 
                        new LinearLayout.LayoutParams(
                        		LinearLayout.LayoutParams.WRAP_CONTENT, 
                        		LinearLayout.LayoutParams.WRAP_CONTENT);
     		    Button myButton = new Button(this);
     		    myButton.setWidth(50);
                myButton.setHeight(50);
                if(Arrays.binarySearch(numbers,++p) > 0){
             	   myButton.setBackgroundColor(Color.WHITE);
                }else{
                	//Toast.makeText(getBaseContext(),String.valueOf(seatNumbers[2]), Toast.LENGTH_LONG).show();
                	
                	if(checkArray(bookedSeat,++r)){
                	   myButton.setText(String.valueOf(r));
      	         	   myButton.setId(r);
                  	   myButton.getBackground().setColorFilter(new LightingColorFilter(0xFFFFEEEE, 0xFFFF0000));//(FF,RR,GG,BB)
                     }else{
                       myButton.setText(String.valueOf(r));
     	         	   myButton.setId(r);
     	         	   myButton.setOnClickListener(new OnClickListener() {
						
						@Override
						public void onClick(View v) {
							progressBar.setVisibility(View.GONE);
							AskOption(v.getId());
							
						}
					});
     	         	}
	         	}
                if(j == 0){
             	   if(i==1)
             		   buttonParams.setMargins(q--*50,(20), 0, 0);
             	   else
             		   buttonParams.setMargins(q--*50,(0), 0, 0);
                }else{
             	   buttonParams.setMargins(q--*50,-(50), 0, 0);
                }
     		   myLayout.addView(myButton,buttonParams);
            }
        }
   		progressBar.setVisibility(View.GONE);
    }
	
	private void onViewSeatSmall() {
		final ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar1);
		LinearLayout myLayout = (LinearLayout) findViewById(R.id.linearLayout1);
   		final int[] numbers = {0,3,4,8,13,18,23,28,33,38,43};
   		  
   		   
   		for(i=1; i<=10; i++){
   		   q=4;
     	   for(j=0; j<5; j++){
     		    LinearLayout.LayoutParams buttonParams = 
                        new LinearLayout.LayoutParams(
                        		LinearLayout.LayoutParams.WRAP_CONTENT, 
                        		LinearLayout.LayoutParams.WRAP_CONTENT);
     		    Button myButton = new Button(this);
     		    myButton.setWidth(50);
                myButton.setHeight(50);
                if(Arrays.binarySearch(numbers,++p) > 0){
             	   myButton.setBackgroundColor(Color.WHITE);
                }else{
                	//Toast.makeText(getBaseContext(),String.valueOf(seatNumbers[2]), Toast.LENGTH_LONG).show();
                	
                	if(checkArray(bookedSeat,++r)){
                	   myButton.setText(String.valueOf(r));
      	         	   myButton.setId(r);
                  	   myButton.getBackground().setColorFilter(new LightingColorFilter(0xFFFFEEEE, 0xFFFF0000));//(FF,RR,GG,BB)
                     }else{
                       myButton.setText(String.valueOf(r));
     	         	   myButton.setId(r);
     	         	   myButton.setOnClickListener(new OnClickListener() {
						
						@Override
						public void onClick(View v) {
							progressBar.setVisibility(View.GONE);
							AskOption(v.getId());
							
						}
					});
     	         	}
	         	}
                if(j == 0){
             	   if(i==1)
             		   buttonParams.setMargins(q--*50,(20), 0, 0);
             	   else
             		   buttonParams.setMargins(q--*50,(0), 0, 0);
                }else{
             	   buttonParams.setMargins(q--*50,-(50), 0, 0);
                }
     		   myLayout.addView(myButton,buttonParams);
            }
        }
   		progressBar.setVisibility(View.GONE);
    }
	
	private boolean checkArray(int[] argArray,int val) {
		for(y=0; y<argArray.length; y++){
			if(argArray[y]==val){
				return true;
			}
		}
		return false;
	}
	
	private void updateSeat(int val) { 
		final int id=val;
		final ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar1);
		ParseQuery<ParseObject> query = ParseQuery.getQuery("Booking_Infor"); // get all data from object to table
		query.whereEqualTo("journeyNo",journeyNo);	//filter query equal bus no	(table bus no/enter bus no)
		query.whereEqualTo("busNo",busNumber);
		query.whereEqualTo("status","A");
		query.whereEqualTo("journeyDate",journeyDate);	
		query.whereEqualTo("seatNo",val);
		
		 query.findInBackground(new FindCallback<ParseObject>() {//	Manipulate array data	
			@Override
			public void done(List<ParseObject> objs, ParseException e) {
				 if (e == null) { 
					 if(objs.size()==0){ //check Already have or not this bus data
						 progressBar.setVisibility(View.GONE);
						 //Toast.makeText(getBaseContext(),"Insert",Toast.LENGTH_LONG).show();
					 }else{//++ update data to table ++++
						 //Toast.makeText(getBaseContext(),String.valueOf(a), Toast.LENGTH_LONG).show();
						 for(ParseObject obj:objs){
						 obj.put("status","B");
						 obj.saveInBackground(); //save data 
						 progressBar.setVisibility(View.GONE);
						 Button btnSubmit = (Button) findViewById(id);
						 btnSubmit.getBackground().setColorFilter(new LightingColorFilter(0xFFFFEEEE, 0xFFFF0000));
						 Toast.makeText(getBaseContext(),"Seat is Booked",Toast.LENGTH_LONG).show();
						 }
					 }
					 } else {
						 progressBar.setVisibility(View.GONE);
						 Toast.makeText(getBaseContext(),"Please check your internet connection.", Toast.LENGTH_LONG).show();	        	 		
		         }
			}
		 });
		 
	}
	
	private void AskOption(int val)
	 {
		final int id=val;
		final ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar1);
		DialogInterface.OnClickListener dialogClickListener = new DialogInterface.OnClickListener() {
		    @Override
		    public void onClick(DialogInterface dialog, int which) {
		        switch (which){
		        case DialogInterface.BUTTON_POSITIVE:
		        	progressBar.setVisibility(View.VISIBLE);
		        	updateSeat(id);
		        	break;

		        case DialogInterface.BUTTON_NEGATIVE:
		        	break;
		        }
		    }
		};
		AlertDialog.Builder ab = new AlertDialog.Builder(this);
		    ab.setMessage("Do you want to Book ?").setPositiveButton("Yes", dialogClickListener)
		        .setNegativeButton("No", dialogClickListener).show();
	        
		}
	
}
