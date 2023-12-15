const express = require('express');
const path = require('path');
const mysql = require('mysql');
const dotenv = require('dotenv');

dotenv.config();

const app = express();

// create database connection
const db = mysql.createConnection({
    host: process.env.MYSQL_HOST,
    user: process.env.MYSQL_USER,
    password: process.env.MYSQL_PASSWORD,
    database: process.env.MYSQL_DATABASE
});

// retrieve assets 
const publicDir = path.join(__dirname, './public');
app.use(express.static(publicDir));

// Parse URL-encoded bodies (as sent by HTML forms)
app.use(express.urlencoded({ extended: false}));

// Parse JSON bodies (as sent by API clients)
app.use(express.json());

app.set('view engine', 'hbs');

// connect to database 
db.connect((error) => {
    if (error) {
        console.log(error);
    } else {
        console.log("Database Connected!");
    }
});

// Define Routes (refer to router/pages.js)
app.use('/', require('./routes/pages'))
app.use('/auth', require('./routes/auth'))

app.listen(5000, () => {
    console.log("Server started at port 5000");
});
