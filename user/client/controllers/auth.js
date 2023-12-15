const mysql = require('mysql');
const path = require('path');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');

// create database connection
const db = mysql.createConnection({
    host: process.env.MYSQL_HOST,
    user: process.env.MYSQL_USER,
    password: process.env.MYSQL_PASSWORD,
    database: process.env.MYSQL_DATABASE
});

exports.login = async (req, res) => {
    console.log(req.body);
    const { school_id, password } = req.body;

    try {
        // Check if the school ID is already registered
        const results = await db.query('SELECT school_id, password FROM credentials WHERE school_id = ?', [school_id]);

        if (results.length > 0) {
            const storedPassword = results[0].password;

            // Compare the provided password with the stored hashed password
            const passwordMatch = await bcrypt.compare(password, storedPassword);

            if (passwordMatch) {
                // Password is correct, proceed to another page
                // You can redirect to a different route or render another page
                return res.render('user_dashboard', {
                    message: 'Login successful!',
                    images: ['./assets/images/rentify-icon.png']
                    // Include other data needed for rendering the page
                });
            } else {
                // Password is incorrect, inform the user
                return res.render('user_login', {
                    message: 'Incorrect password. Please try again.',
                    images: ['./assets/images/rentify-icon.png']
                });
            }
        }
    } catch (error) {
        console.log(error);
        return res.status(500).send('Internal Server Error');
    }
};
