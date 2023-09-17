<p align=center><a href="https://discord.gg/devroom"><img src="https://github.com/anatolieursu/teste/assets/104382017/5d94febd-d084-4271-b967-e99c79ef742f"></a>
</p>
<p align=center>Version: 1.00<br>All rights reserved - Ursu Anatolie 2023 | Devroom Resource</p>
<p></p>

## Set it for your Server
1. Set the panel for your minecraft server. Follow the steps below to set the ip, server name and logo.
- In the .env file you will find the properties 'MINECRAFT_SERVER_NAME', 'MINECRAFT_SERVER_IP', 'SERVER_IMAGE'. Change the property MINECRAFT_SERVER_NAME with the name of your minecraft server, MINECRAFT_SERVER_IP with the ip of your minecraft server and SERVER_IMAGE with the server logo!

2. Set Authorization through discord
- create a new discord bot in the discord developer portal
- In the .env file you will find the properties:
LARASCORD_CLIENT_ID=
LARASCORD_CLIENT_SECRET=
LARASCORD_GRANT_TYPE=authorization_code
LARASCORD_PREFIX=
LARASCORD_SCOPE=identify&email
Set them with the necessary information from the discord developer portal. Use a tutorial how to enter the necessary information 'https://larascord.jakye.me/getting_started/discord'

3. In .env file set the "APP_URL" url of the current website, domain. Withour the last '/'

4. How to use the api to enter the staff in the database?
- api's link: http://127.0.0.1:8000/api/staff/add
- api type: post
- requests: name, rank, password
- you can change the password from the .env file

## Sections
<ul>
  <li>Welcome Page</li>
  <li>Forum</li>
  <li>Personal</li>
  <li>Wiki</li>
  <li>Staff Applications</li>
  <li>Profile</li>
  <li>Admin ( for admins )</li>
</ul>

## Security Vulnerabilities / Bugs

If you discover a security vulnerability within this project, please send an e-mail to Ursu Anatolie via [ursu.anato.l.3@gmail.com.com](mailto:ursu.anato.l.3@gmail.com). All security vulnerabilities will be promptly addressed.

## Functionalities
- The update system for players on the current server: <br>
If the ip is invalid, the number will always show 0 players<br>
Use the api: https://api.mcsrvstat.us/3/servername<br>
- Event system:
Users with the role of staff or admin have the possibility to insert an event<br>
The Search system, searches for all the events that have the searched title<br>
Pressing the events card will redirect the user to a website where the details will be viewed, such as the image, title, description, version, author, etc.<br>
- Forum System:
You need to log in to add a qa forum, from the profile menu<br>
Only staff/admin users and those who created the forum can add messages.<br>
- Personal staff
The system will retain all rows from the 'staff' database and group them all<br>
It is an api that gives you the possibility to include the staff from java (to redirect all players with staff)<br>
- Wiki
The wiki will be set from the database<br>
- Staff Applications
You must be logged in to be able to insert a staff application<br>
- Profiles
Register your current activity, through the list of forums/staff applications, etc<br>
You can view another user's profile using the url /profile/view/{username}<br>
You can set an about-me<br>
Users with the role of staff and admin have the possibility to create a new event<br>
- Admin Panel
Staff applications, forums and events will be stored here<br>
The admin has the ability to delete each category<br>
The admin can also accept/delete the addition of a reason for staff applications<br>

## Staff API
How to use the api to enter the staff in the database?
- api's link: http://127.0.0.1:8000/api/staff/add
- api type: post
- requests: name, rank, password
- you can change the password from the .env file

## Integrations
- MySql Integration
- Boostrap
- https://api.mcsrvstat.us/ Api for Minecraft Status
- PHP - Laravel Framework | Html | Css | JS
