<img src="https://raw.githubusercontent.com/XEQTIONR/intertracNano/master/public/images/intertracnanologocolor.bmp" />

# intertracNano

This is a secondary version of the nanoDB app written by Ishtehar Hussain for Intertrac Nano. The web application is written mostly in PHP on Laravel 5.4 Framework.
Following are some basic instructions to get you up and running on how to run this app on a local artisan server (or similar).

**1. Requirements.**

Some general requirements. You may have work-arounds on these.

 1. PHP, Laravel (>=5.4),
 Basically everything you need to launch a laravel app on a local machine.

 2. Mysql database.
 You need access to a mysql database where we will create our database schema.

 3. Sparkpost Key
 We send email for password resets. So if you want access to this feature then you need a register a domain on SparkPost and obtain a key for that domain.

 3. Also needs internet to access Bootstrap and Jquery files/scripts/styles etc.


**2. Set Up.**
  1. **Clone or Download the repository**

  2. **Modify the Database creation script.**

   Since only authenticated users can access the features we are going to create one with admin previledges.

   A sql creation script called 'default_db.sql' is given. Modify one of the insert statements for the users table with your name and email data. Also set the admin field to 1.

  3. **Create a mysql database.**

  We have not used database migrations on this project.  You can use this script to create your database tables. Some basic data is also provided.
  ```   
      DB_CONNECTION=mysql
      DB_HOST=your-db-host
      DB_PORT=your-db-port
      DB_DATABASE=your-db-name
      DB_USERNAME=your-db-username
      DB_PASSWORD=your-db-password

      MAIL_DRIVER=sparkpost
      SPARKPOST_KEY=your-secret-sparkpost-key
  </code>
  ```

  4. **Create a ENV file.**

  You must create a (.env) file to hold all your environment variables. Create it at the root level of your app directory structure. The following fields must be set.

  5. **Run your server**

  The simplest way is to use the artisan console to run a local server
  <code>  php artisan serve</code>

  6. **Reset your account password**

  If you followed the instructions then the user table in the database contains an entry with your email address which has admin privileges.

  Now the password must be reset.
  Go to the homepage and click on log-in and then forgot passwords. Follow the instructions on resetting the password. Once the password has been reset you are ready to use the app using all features and admin privileges.


  -- END --
  ___

  ## Docker Instructions
  - Put a copy of production sql in `.docker/nano_db.sql`
  - `docker compose up`
  - Site is on - http://localhost



<span>July 2, 2017</span>
Paginator added to the tyres catalog in the 'new_lc' form.
Paginator now uses ajax requests to only refresh the tyre catalog instead of the entire page.


<span>July 1, 2017</span>
Validation logic for new_lc form.
We are now using Validators.

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
