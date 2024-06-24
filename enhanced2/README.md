# INFO4345 WEB APPLICATION SECURITY | Class Assignment - Student Management System (Client & Server Side)

This is a simple student management system built with PHP and MySQL. It allows users to register, log in, and view student details. The system has two roles: user and admin.

## Roles

- **User**: After logging in, users are redirected to `userPage.php` where they can view and update their own details. The user's details are fetched from the database using their email stored in the session and displayed in a form. If the form is submitted, the user's details are updated in the database.

- **Admin**: After logging in, admins are redirected to `studentDetailsPage.php` where they can view the details of all students. The student details are fetched from the database by `displayStudents.php` and displayed directly on the page. Admins can also edit a student's details using `editStudentPage.php` and `editStudent.php`, or delete a student using `deleteStudent.php`.

## Files

- `registerPage.html`: The registration page where users can create a new account. The form fields for the user's email and password are validated using Regex upon form submission.

- `register.php`: The server-side script that handles the registration process. It receives the data from the registration form, validates it again using Regex, and then inserts it into the database.

- `loginPage.html`: The login page where users can log in to their account. It contains a form with fields for the user's email and password.

- `login.php`: The server-side script that handles the login process. It receives the data from the login form, checks it against the database, and starts a session if the user's credentials are correct. It also stores the user's email in the session.

- `userPage.php`: The user profile page where users can view and update their details. It fetches the user's details from the database using their email stored in the session and displays them in a form. If the form is submitted, the user's details are updated in the database. This page now includes CSRF protection by generating a CSRF token and comparing it with the one stored in the session.

- `studentDetailsPage.php`: The page that admins see after they log in. It is protected by a session-based authentication system, so only logged-in admins can access it. It displays the student details from the database.

- `displayStudents.php`: The server-side script that fetches the student details from the database and returns them as a PHP array. It is included in `studentDetailsPage.php` to display the student details directly on the page.

- `editStudentPage.php` and `editStudent.php`: These files allow admins to edit the details of a student. `editStudentPage.php` displays a form with the current details of the student, and `editStudent.php` updates the database with the new details.

- `deleteStudent.php`: This file allows admins to delete a student from the database.

- `db_connect.php`: This file contains the code for connecting to the database. It is included in `register.php`, `login.php`, `displayStudents.php`, and `userPage.php`.

## App Navigation

- Users first register a new account at 'registerPage.html'. The data entered in the form is validated using inline Regex for initial client-side validation. 

- After the form is submitted, 'validation.js' validates the input again using built-in regex functions for additional client-side validation.

- The data is then sent to the server and validated once more by the 'register.php' script, which also uses built-in regex functions for server-side validation.

- If the registration is successful, the system will redirect the user to the 'loginPage.html'.

- The user enters their credentials, which are then validated by the 'login.php' script. If the credentials are correct, a new session is started for the user and their email is stored in the session.

- After the user successfully logs in, the system will display the 'userPage.php' for users and 'studentDetailsPage.php' for admins. These pages are protected by session-based authentication, so only logged-in users and admins can access them.

## Security Updates

- Content Security Policy (CSP) has been implemented to only allow scripts to be loaded from the same origin ('self') and from 'https://stackpath.bootstrapcdn.com'. Inline scripts have been moved to external files to comply with this policy.

- Cross-Site Request Forgery (CSRF) protection has been added to the forms in `registerPage.html`, `loginPage.html`, `userPage.php`, and `editStudentPage.php`. A CSRF token is generated when each form is displayed and stored in the session. When the form is submitted, the token from the form is compared with the one stored in the session in `register.php`, `login.php`, `userPage.php`, `editStudent.php`.

- To prevent Cross-Site Scripting (XSS) attacks, a three-layer validation approach is used:

1. **Client-side validation**: Inline regex is used in the registration form to validate inputs as soon as they are entered. This is the first layer of defense against invalid or malicious inputs.

2. **Client-side validation using `validation.js`**: The inputs are validated again using the same regex rules in `validation.js` before the form is submitted. This serves as a double check to ensure that only valid inputs are submitted.

3. **Server-side validation in form handler**: Before the inputs are sent to the database, they are validated once again in the form handler. This is the final layer of defense to ensure that only valid and safe inputs are stored in the database.
