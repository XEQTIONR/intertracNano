# intertracNano

<span>June 29, 2017</span>
Added basic laravel validation to LcController. The error messages use the name from the 'name' attribute of each for field.
Error messages are displayed in the form if there are errors.


<span>June 28, 2017</span>
Added auth as middleware to the base Controllers
Added admin middleware to add new user action.

<span>June 27, 2017/<span>
Created a new middleware <code>CheckAdmin</code> and attached to LcController
<span>June 23, 2017<span>
Starting to implement user authentication.
Implemented login and register.

<span>June 19, 2017</span>
Displaying order informtion using ajax in 'payments/create' end-point

<span>June 18, 2017</span>
'/stock' end-point works - shows current stock



<span>June 16, 2017</span>
Order profile page.
Bootstrapify most tables


<span>June 15, 2017</span>
Added  new create function (<code>createGivenLC</code>) in <code>ConsignmentController</code> which passes in the LC number and does the same things as <code>create</code> function</br>
Some more bootstrap.
Consignment profile page.


<span>June 21, 2017</span>
Implemented editing of basic customer info in customer profile page. Edit function in CustomerController is not needed, as we display the form right in the profile page.

<span>June 12, 2017</span>
Beginning integration of Twitter Bootstap Framework for front-end.

<span>June 7, 2017</span>
Added containers section in Consignments.

<span>June 6, 2017</span>
LC profile page now has display sections Performa invoice and Consignments belonging to LC.


<span>June 4, 2017</span>
Can insert performa invoice along with LC in one go. (previously tried on May 7)

<span>May 31, 2017</span>
Added profile pages for LCs and Perform Incoices.

<span>May 28, 2017</span>
Remove item button in end-point 'performa_invoice/create'

<span>May 24, 2017</span>
Can add directly from <code>/container_contents/create</code> without having to attach a new container to a consignment first.

<span>May 22, 2017</span>
Order contents are properly filled.
<b>TEST TO CHECK ONE ITEM ENTERED FROM MULTIPLE CONTAINERS.</b>



<span>May 17, 2017</span>
<b>Implemented sql for stock-remaining. THIS CODE WILL BE REUSED</b>


<span>May 14, 2017</span>
Added functionality to add tyres to containers (Commercial Invoice.)

<span>May 7, 2017</span>
Can insert performa invoice along with LC in one go.


<span>May 7, 2017</span>
Integrating Consignemnt_container end-point.
Database on server contains inconsistencies. Update changes on db model.

<span>May 6, 2017</span>
Integrating Consignment end-point. First table with foreign key constraints.



<span>May 5, 2017</span>
Removed hard-coded database credentials.

<span>May 2, 2017</span>
MVC for LC end-point

<span>May 1, 2017</span>
1. Added the sql file for our database schema.
<i>Note: (Posed on June 12, 2017)</i> : The sql file is not valid anymore. Made changes to the schema
2. Implemented most of tyre end-point


<span>Apr 30, 2017</span>
Main menu built along with its animatable sub-menu.


<span>Apr 26, 2017</span>
Changed database to chaos_db


<span>Apr 25, 2017</span>
Can pull raw info from database tables now.
