
## Question 1

Step to execute
1. Open the terminal.
2. Change the directory to the project.
```bash
cd /trilogy-emit-coexist
```
3. run the command to create the table in database.
```bash
./vendor/bin/sail artisan migration
```
4. run the command to insert the record into database.
```bash
./vendor/bin/sail artisan db:seed
```

## Question 2
1. Once the system is running, access the application via: http://localhost/auth/login
2. The system comes with two pre-configured users. You may log in using either account.
3. If incorrect credentials are entered, an error message will be displayed.
4. Upon successful login, you will be redirected to the Announcement List page.
5. The page displays a total of 5 announcements.
6. If you are logged in as Customer 1, the first announcement will be marked as read and will not display a blue dot on the right.
7. All other unread announcements will display a blue dot indicator on the right side of the list item.
8. A Logout button is available at the top right corner. Clicking it will log you out and redirect you back to the login page.


SQL query for Announcement List
```bash
select `announcements`.*, `announcement_read`.`read_at` from `announcements` left join `announcement_read` on `announcements`.`id` = `announcement_read`.`announcement_id` and `announcement_read`.`user_id` = ?  
```

## Question 3
1. In announcement listing page there got 2 input fields
2. You can search the Customer ID and Announcement ID.
3. Click "Submit" button to record the customer read the announcement.
4. if the Customer ID or Announcement ID is not found in system, will return erorr message to alert user.
5. Once successful update the database, will have successful message and refresh the page with the new records.
