<h1><u>Apartment Complex Management</u></h1>

This is a project done in HTML, CSS and PHP, relying on MySQL for it's Database storage. As the name suggests, this Project involves a number of operations that need to be done on a day-to-day basis in a Housing Complex in order for it to run efficiently.

<br /><br />

<h3><strong>What does it do and how does it do it?</strong></h3>
<ol>
  <li>Enables the addition and management of residents in a Housing Complex, and a database stored procedure warns you if you are trying to allocate someone to a house already occupied, regardless of whether the former is a new resident or an old one looking to shift;</li>
  <li>The project allows you to start off with an initial set of administrators, and will allow you to add and update admin details as the work demands;</li>
  <li>The project allows residents to lodge and track the status of their complaints through resolution. The admin is able to assign a relevant person to carry out repairs or other such needful actions, and the resident concerned is able to track who is handling the complaint along with the latter's contact details. The resident may reopen the complaint if he deems that it has not been resolved satisfactorily;</li>
  <li>A Database trigger included in the database will automatically store information about vacating residents, and store their contact details and feedback for later usage.</li>
</ol>

<br />

<h3><strong>Security Measures taken as of now: </strong></h3>
<ol>
  <li>A resident cannot be randomly assigned to any house unless it is vacant, thus less chances of disputes;</li>
  <li>Adding an administrator requires the authorisation of another administrator, hence unauthorised administrator access is to a certain limit, reduced</li>
  <li>Addition of a vacating resident's personal details is done only after authorisation by the resident himself; hence privacy is maintained upto a degree</li>
</ol>

<br />

<h3><strong>Plans for the future:</strong></h3>
<ol>
  <li>As of now, the project is not set to be real-world compatible because the process of passing SQL statements is largely susceptible to injection as they are not Prepared Statements; making all the database calls as Prepared Statements holds top priority;</li>
  <li>Coded in PHP, which is not exactly a language that you'd want your code to be in. Thus another top-ish priority is to migrate it to some other scripting language, preferably JSP or maybe shift towards Node.js;</li>
  <li>Again it employs MySQL, which is perfect for learning but not for large databases. That stays as another future plan as well;</li>
  <li>Oh yes, a lot of things that actually go on in a Housing Complex needs to be added.</li>
</ol>

<br />

<h3><strong>Common Bugs/Issues/`"Stepbro I'm stuck!" moments` and how to fix them without freaking out:</strong></h3>
<ol>
  <li>Executing apartments.sql but there are issues with charset and collations - Delete the line `DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci` from all the Creation statements given. Simple as;</li>
  <li>Using DATABASE CREATION GUIDE but you get an unfortunate "Database `apartments` not found/does not exist" - CREATE THE DATABASE. No seriously, create it. Please;</li>
  <li>I'm doing things on files in PG-50 but they are not displaying in the main webpage - Well, um, it's playground. It is for testing things _without_ affecting the main project. To test things you write in that file, use "localhost/PH-50/playground.<extension>"</li>
  <li>Did everything properly but "Database connection could not be made: <Error>" - Head to Assets/dbconnect.php and change connection parameters. "admin" is the password I had set for my MySQL installation. Change it to whatever you set. Make it "" if you do not have a password;</li>
  <li>PHPMyAdmin throws a "Access Denied"/unavailable error - Confirm that the passwords you have set across the ini files are consistent. Make sure MySQL port(3306) and localhost(8080) are not blocked by any other application(most commonly IIS). [For reference, I used 3360 and 8090 respectively];</li>
  <li>Bizarre input creating unwanted artifacts on the web page: Check if you have changed the code in PHP files somewhere. If not, maybe I have overlooked that input. Let me know, I will fix it if I want to.</li>
</ol>

<h5>I have not been getting time to work on this due to University and all that. Anyone enthusiastic regarding this project may clone and work on it, maybe to make it better, more efficient, or to overhaul it in general. Or you may use it for your college projects, maybe. You get to decide.</h5>
