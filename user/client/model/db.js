// model/db.js
const mysql = require('mysql2');

const db = mysql.createConnection({
    host: process.env.MYSQL_HOST,
    user: process.env.MYSQL_USER,
    password: process.env.MYSQL_PASSWORD,
    database: process.env.MYSQL_DATABASE
});

// Connect to the database
db.connect((error) => {
  if (error) {
      console.log(error);
  } else {
      console.log("Database Connected!");
  }
});

module.exports = db;
// Error with database: 
  // RUN IN WORKBENCH: ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';
  // THEN: flush privileges;