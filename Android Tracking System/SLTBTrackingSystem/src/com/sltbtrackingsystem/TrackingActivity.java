package com.sltbtrackingsystem;

import java.util.List;

import com.parse.FindCallback;
import com.parse.Parse;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.graphics.LightingColorFilter;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

public class TrackingActivity extends Activity implements LocationListener{

	//--------
		LocationListener locationListener;
		LocationManager locationManager;
		int day ;
        int month;
        int year;
        String journeyNo;
    	String busNumber;
    	int no_of_seat;
        //--------
		
		protected void onCreate(Bundle savedInstanceState) {
			super.onCreate(savedInstanceState);
			setContentView(R.layout.tracking);
			
			/**
			 * ***** New Code by SLTB Developer **************
			 */
			
			
			Button btnExit = (Button) findViewById(R.id.button1);
			btnExit.getBackground().setColorFilter(new LightingColorFilter(0xFFFFFFFF, 0xFFAA0000));
			
			Intent intent = getIntent();
			
			busNumber = intent.getStringExtra("busNo");
			journeyNo = intent.getStringExtra("journeyNo");
			no_of_seat = intent.getIntExtra("no_of_seat",0);
			
			ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar2);
			progressBar.setVisibility(View.GONE);
			
			TextView txtBusNo = (TextView) findViewById(R.id.textView3);
			txtBusNo.setText(busNumber);//Display Bus Number
			TextView txtJourneyNo = (TextView) findViewById(R.id.textView6);
			txtJourneyNo.setText(journeyNo);
			//Toast.makeText(getBaseContext(),String.valueOf(no_of_seat), Toast.LENGTH_LONG).show();
			
			locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);//On LOCATION_SERVICE
			locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER,10000,0, this);// Update Location After 10s 
			
			Parse.initialize(this,"w6sOkx6IXZPloTIkWcdbfX3RxKrrPJZmWPIGHeYk","3avqsVGqNOLwIQQMst9PMxlIArOfwzkYB6Ls9t1u");//Connection to Parse (Application ID /Client Key)
			
			onRuningClick();
			onWaitingClick();
			onBreakdownClick();
			onStopClick();
			onExitClick();//call Exit System.
			onView();
			
		}
		
		private void onView() {
			Button btnSubmit = (Button) findViewById(R.id.button3);
			//final Spinner spinnertechObj = (Spinner) findViewById(R.id.planets_spinner);
			
			

            btnSubmit.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View arg0) {
					DatePicker datePicker = (DatePicker) findViewById( R.id.datePicker1);
					
					day = datePicker.getDayOfMonth();
					month = datePicker.getMonth();
					year = datePicker.getYear();
					
					Intent intent = new Intent(TrackingActivity.this,SeatActivity.class); //Create new Intent for pass Bus Number to TrackingActivity
					
					intent.putExtra("day", day);
					intent.putExtra("month", month);
					intent.putExtra("year", year);
					
					intent.putExtra("busNumber",busNumber);
			 		intent.putExtra("journeyNo",journeyNo);
			 		intent.putExtra("no_of_seat",no_of_seat);
					
					TrackingActivity.this.startActivity(intent);//Start Intent
					//Toast.makeText(getBaseContext(),String.valueOf(day).toString(),Toast.LENGTH_LONG).show();
				}
			});
		}
		
		private void onRuningClick(){
			
			Button btnExit = (Button) findViewById(R.id.button2);
			btnExit.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View v) {
					final ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar2);
					progressBar.setVisibility(View.VISIBLE);
					ParseQuery<ParseObject> query = ParseQuery.getQuery("Tracking_Data"); // get all data from object to table
					 query.whereEqualTo("bus_number",busNumber);	//filter query equal bus no	(table bus no/enter bus no)
				
					 query.findInBackground(new FindCallback<ParseObject>() {//	Manipulate array data	
						@Override
						public void done(List<ParseObject> objs, ParseException e) {
							 if (e == null) {
								 if(objs.size()==0){ //check Already have or not this bus data
									 //Toast.makeText(getBaseContext(),"Insert",Toast.LENGTH_LONG).show();
								 }else{//++ update data to table ++++
									 for(ParseObject obj:objs){
									 obj.put("status", "R");
									 obj.saveInBackground(); //save data 
									 progressBar.setVisibility(View.GONE);
									 Toast.makeText(getBaseContext(),"Bus is Runing",Toast.LENGTH_LONG).show();
									 }
								 }
								 } else {
									 progressBar.setVisibility(View.GONE);
									 Toast.makeText(getBaseContext(),"Your internet connection is slow. Please check ", Toast.LENGTH_LONG).show();	        	 		
					         }
						}
					 });
				}
			});
		}
		
		private void onWaitingClick(){
			final ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar2);
			
			Button btnExit = (Button) findViewById(R.id.button6);
			btnExit.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View v) {
					progressBar.setVisibility(View.VISIBLE);
					 ParseQuery<ParseObject> query = ParseQuery.getQuery("Tracking_Data"); // get all data from object to table
					 query.whereEqualTo("bus_number",busNumber);	//filter query equal bus no	(table bus no/enter bus no)
				
					 query.findInBackground(new FindCallback<ParseObject>() {//	Manipulate array data	
						@Override
						public void done(List<ParseObject> objs, ParseException e) {
							 if (e == null) {
								 if(objs.size()==0){ //check Already have or not this bus data
									 //Toast.makeText(getBaseContext(),"Insert",Toast.LENGTH_LONG).show();
								 }else{//++ update data to table ++++
									 for(ParseObject obj:objs){
									 obj.put("status", "W");
									 obj.saveInBackground(); //save data 
									 progressBar.setVisibility(View.GONE);
									 Toast.makeText(getBaseContext(),"Bus is Waiting",Toast.LENGTH_LONG).show();
									 }
								 }
								 } else {
									 progressBar.setVisibility(View.GONE);
									 Toast.makeText(getBaseContext(),"Please check your internet connection.", Toast.LENGTH_LONG).show();	        	 		
					         }
						}
					 });
				}
			});
		}
		
		private void onBreakdownClick(){
			final ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar2);
						
			Button btnExit = (Button) findViewById(R.id.button4);
			btnExit.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View v) {
					progressBar.setVisibility(View.VISIBLE);
					ParseQuery<ParseObject> query = ParseQuery.getQuery("Tracking_Data"); // get all data from object to table
					 query.whereEqualTo("bus_number",busNumber);	//filter query equal bus no	(table bus no/enter bus no)
				
					 query.findInBackground(new FindCallback<ParseObject>() {//	Manipulate array data	
						@Override
						public void done(List<ParseObject> objs, ParseException e) {
							 if (e == null) {
								 if(objs.size()==0){ //check Already have or not this bus data
									 //Toast.makeText(getBaseContext(),"Insert",Toast.LENGTH_LONG).show();
								 }else{//++ update data to table ++++
									 for(ParseObject obj:objs){
									 obj.put("status", "B");
									 obj.saveInBackground(); //save data 
									 progressBar.setVisibility(View.GONE);
									 Toast.makeText(getBaseContext(),"Bus is Breakdown",Toast.LENGTH_LONG).show();
									 }
								 }
								 } else {
									 progressBar.setVisibility(View.GONE);
									 Toast.makeText(getBaseContext(),"Please check your internet connection.", Toast.LENGTH_LONG).show();	        	 		
					         }
						}
					 });
				}
			});
		}
		
		private void onStopClick(){
			final ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar2);
			
			Button btnExit = (Button) findViewById(R.id.button5);
			btnExit.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View v) {
					progressBar.setVisibility(View.VISIBLE);
					ParseQuery<ParseObject> query = ParseQuery.getQuery("Tracking_Data"); // get all data from object to table
					 query.whereEqualTo("bus_number",busNumber);	//filter query equal bus no	(table bus no/enter bus no)
				
					 query.findInBackground(new FindCallback<ParseObject>() {//	Manipulate array data	
						@Override
						public void done(List<ParseObject> objs, ParseException e) {
							 if (e == null) {
								 if(objs.size()==0){ //check Already have or not this bus data
									 //Toast.makeText(getBaseContext(),"Insert",Toast.LENGTH_LONG).show();
								 }else{//++ update data to table ++++
									 for(ParseObject obj:objs){
									 obj.put("status", "S");
									 obj.saveInBackground(); //save data 
									 progressBar.setVisibility(View.GONE);
									 Toast.makeText(getBaseContext(),"Bus is Stop",Toast.LENGTH_LONG).show();
									 }
								 }
								 } else {
									 progressBar.setVisibility(View.GONE);
									 Toast.makeText(getBaseContext(),"Please check your internet connection.", Toast.LENGTH_LONG).show();	        	 		
					         }
						}
					 });
				}
			});
		}
		
		private void onExitClick(){
			Button btnExit = (Button) findViewById(R.id.button1);
			btnExit.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View v) {
					finish();
					System.exit(0);
				}
			});
		}
		
		
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	@Override
	public void onLocationChanged(final Location location) {
		// TODO Auto-generated method stub
		//String lon_lat = "Longitude: "+location.getLongitude()+" Latitude: "+location.getLatitude();//Get Longitude, Latitude
		//Toast.makeText(getBaseContext(),lon_lat,Toast.LENGTH_LONG).show();// Show Longitude, Latitude
		
		/** ***** Insert and Update Data to Table ************** */
		
		 ParseQuery<ParseObject> query = ParseQuery.getQuery("Tracking_Data"); // get all data from object to table
		 query.whereEqualTo("bus_number",busNumber);	//filter query equal bus no	(table bus no/enter bus no)
	
		 query.findInBackground(new FindCallback<ParseObject>() {//	Manipulate array data	
			@Override
			public void done(List<ParseObject> objs, ParseException e) {
				String lon_lat = "Longitude: "+location.getLongitude()+" Latitude: "+location.getLatitude();
				 if (e == null) {
					 if(objs.size()==0){ //check Already have or not this bus data
						/* ParseObject ob = new ParseObject("Tracking_Data");
						//++ Insert data to table ++++
						 		ob.put("bus_number",busNumber);
								ob.put("longitude", location.getLongitude());
								ob.put("latitude", location.getLatitude());
								ob.saveInBackground();//save data
								Toast.makeText(getBaseContext(),lon_lat+"Insert",Toast.LENGTH_LONG).show(); */
					 }else{//++ update data to table ++++
						 for(ParseObject obj:objs){
						 obj.put("longitude", location.getLongitude());
						 obj.put("latitude", location.getLatitude());
						 obj.saveInBackground(); //save data 
						 Toast.makeText(getBaseContext(),"Update: "+lon_lat,Toast.LENGTH_LONG).show();
						 }
					 }
					 } else {
						 Toast.makeText(getBaseContext(),e.getMessage(), Toast.LENGTH_LONG).show();	        	 		
		         }
				
			}
		 });	 
				/** *************************************************** */
	}

	@Override
	public void onProviderDisabled(String provider) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onProviderEnabled(String provider) {
		// TODO Auto-generated method stub
		
	}

	@Override
	public void onStatusChanged(String provider, int status, Bundle extras) {
		// TODO Auto-generated method stub
		
	}

}
