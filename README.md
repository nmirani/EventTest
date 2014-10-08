EventTest
=========

So the only file I have tested using Heroku and AWS is the index.php file

The file createevent.php is another solution to create an event once a valid user session is authenticated
and rsvpquery.php is a file that creates a session and then uses FQL query to get the RSVP of the number of people that are attending a particular
event.

The folder facebook-php-sdk is the sdk folder required to connect to facebook API.
The file facebook.php is used to initialise the SDK and create a login session for a particular user.
