package com.sltbtrackingsystem;

import java.util.ArrayList;
import java.util.List;

import com.parse.FindCallback;
import com.parse.Parse;
import com.parse.ParseException;
import com.parse.ParseObject;
import com.parse.ParseQuery;

import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.ActionBar;
import android.support.v4.app.Fragment;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.view.View.OnClickListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;
import android.os.Build;

public class MainActivity extends ActionBarActivity {

	CharSequence usarName;
	CharSequence password;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);

		if (savedInstanceState == null) {
			getSupportFragmentManager().beginTransaction()
					.add(R.id.container, new PlaceholderFragment()).commit();
		}
		
		/**
		 * ***** New Code by SLTB Developer **************
		 */
		
		ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar1);
		progressBar.setVisibility(View.GONE);
		Parse.initialize(this,"w6sOkx6IXZPloTIkWcdbfX3RxKrrPJZmWPIGHeYk","3avqsVGqNOLwIQQMst9PMxlIArOfwzkYB6Ls9t1u");//Connection to Parse (Application ID /Client Key)
		//-----------------------------------------------------------------------
		/*ParseQuery<ParseObject> query = ParseQuery.getQuery("Tracking_Data"); // get all data from object to table
		    query.findInBackground(new FindCallback<ParseObject>() {//	Manipulate array data	
			@Override
			public void done(List<ParseObject> objs, ParseException e) {
				ArrayList<String> items=new ArrayList<String>();
				 if (e == null) {
					 for(ParseObject obj:objs){
						 items.add(obj.getString("bus_number"));
						 }
				 } else {
						Toast.makeText(getBaseContext(),e.getMessage() , Toast.LENGTH_LONG).show();	        	 		
				 }
				 Spinner spinnertech = (Spinner) findViewById(R.id.planets_spinner);
				 ArrayAdapter<String> adapter = new ArrayAdapter<String>(getBaseContext(),android.R.layout.simple_spinner_item,items);
				 spinnertech.setAdapter(adapter);
			}
		 });*/
		 //__________________________________________________________________________
		
		onSubmit();
		/**
		 * ***** End Code ********************************
		 */
	}
	
	/**
	 * ***** New Code by SLTB Developer **************
	 */
	
	private void onSubmit() {
		Button btnSubmit = (Button) findViewById(R.id.button1);
		EditText txtUserName = (EditText) findViewById(R.id.editText1);
		EditText txtPassword = (EditText) findViewById(R.id.editText2);
		
		usarName = txtUserName.getText();
		password = txtPassword.getText();
		
		btnSubmit.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View arg0) {
				final ProgressBar progressBar = (ProgressBar) findViewById(R.id.progressBar1);
				final Intent intent = new Intent(MainActivity.this,TrackingActivity.class); //Create new Intent for pass Bus Number to TrackingActivity
				ParseQuery<ParseObject> query = ParseQuery.getQuery("journey"); // get all data from object to table
				query.whereEqualTo("journeyNo",password.toString());	//filter query equal bus no	(table bus no/enter bus no)
				query.whereEqualTo("busNo",usarName.toString());
				progressBar.setVisibility(View.VISIBLE);
				 query.findInBackground(new FindCallback<ParseObject>() {//	Manipulate array data	
					@Override
					public void done(List<ParseObject> objs, ParseException e) {
						if (e == null) {
							 if(objs.size()==0){ //check Already have or not this bus data
								 progressBar.setVisibility(View.GONE);
								 Toast.makeText(getBaseContext(),"Invalid Username or Password",Toast.LENGTH_LONG).show();
							 }else{//++ data to table ++++
								 	 for(ParseObject obj:objs){
								 		intent.putExtra("busNo",obj.getString("busNo"));
								 		intent.putExtra("journeyNo",obj.getString("journeyNo"));
								 		intent.putExtra("no_of_seat",obj.getInt("no_of_seat"));
								 	 }
								 	progressBar.setVisibility(View.GONE);
								 	MainActivity.this.startActivity(intent);//Start Intent
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
	
	/**
	 * ***** End Code ********************************
	 */

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {

		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}

	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		// Handle action bar item clicks here. The action bar will
		// automatically handle clicks on the Home/Up button, so long
		// as you specify a parent activity in AndroidManifest.xml.
		int id = item.getItemId();
		if (id == R.id.action_settings) {
			return true;
		}
		return super.onOptionsItemSelected(item);
	}

	/**
	 * A placeholder fragment containing a simple view.
	 */
	public static class PlaceholderFragment extends Fragment {

		public PlaceholderFragment() {
		}

		@Override
		public View onCreateView(LayoutInflater inflater, ViewGroup container,
				Bundle savedInstanceState) {
			View rootView = inflater.inflate(R.layout.fragment_main, container,
					false);
			return rootView;
		}
	}

}
