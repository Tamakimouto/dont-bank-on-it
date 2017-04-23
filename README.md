# Don't Bank on It
Don’t Bank On It, is aimed at displaying the strengths
and weaknesses of various banks across the United States.
The Financial Services Consumer Complaint Database,
available to the public through data.gov, contains complaints
about every branch of every bank in the nation.
Don’t Bank On It will allow the user to find the best and worst
bank branches in their area based on the number of complaints.
The user may filter the information based on zip code and/or
the name of his/her bank.

## Installation
- Make sure LAMP Stack is installed.
- Drop the directory into apache server.
- Import database located in [bonit.sql](https://github.com/Tamakimouto/dont-bank-on-it/blob/master/db/bonit.sql)
- Import the data using [branch-import.sql](https://github.com/Tamakimouto/dont-bank-on-it/blob/master/db/branch_import.sql)
- Change the settings in dbconfig to match your own MySQL server.

## License
GNU Public Use 3.0
