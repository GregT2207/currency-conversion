## Currency Conversion
A simple project to allow for creation of a freelancer profile with basic information.

Currency for freelancer's hourly rate can be converted using a driver specified in the user.php config file.

## Programming notes
Front-end components are purely functional, to simply enable demonstration of the back-end.

Conversion feature is in a "Money" class with future expansion in mind. Classes other than User may want to take advantage of the money conversion method, or similar money-related methods.

## Usage notes
When viewing raw JSON data your browser may display the number wrong due to floating point number behaviour. The Network tab will show the correct figure being returned.

Unit tests and a database seeder are provided.