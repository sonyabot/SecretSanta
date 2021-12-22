# SecretSanta #

This app takes a CSV list of names and email addresses and randomizes the list to match an address to a name, then sends an email to the recipient with the name of the person they have been matched with gifting.
People should never get their own names. This effectively acts as a virtual "name in the hat" to help with Covid/distance complications WRT secret santa celebrations.

SecretSanta requires a Mandrill Transactional Email account. (Don't have one? Know Sonya? Just reach out!)

You'll need an API Key for your Mandrill account as well as a csv file of names and email addresses of the folks you plan to include in your secret santa celebration
following this pattern:

name, email /* newline */
name, email

** Step 1: **

Clone the repo

** Step 2: **

visit the Secret Santa app locally in terminal

** Step 3: **

run `php app.php`

** Step 4: **

input your API Key when prompted

** Step 5: **

input the path to your CSV file when prompted

~Done~

You should be able to see your sent emails in your Mandrill account.