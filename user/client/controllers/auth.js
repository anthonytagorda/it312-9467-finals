const mysql = require('mysql');
const path = require('path');

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
        const results = await db.query('SELECT * FROM credentials WHERE school_id = ?', [school_id]);

        if (results.length > 0) {
            const user = results[0];

            // Check if the entered password matches the password in the database
            if (password === user.password) {
                // Passwords match, redirect to the user_dashboard
                return res.render('user_dashboard', {
                    message: 'Login successful!',
                });
            } else {
                // Passwords don't match, return to user_login
                return res.render('user_login', {
                    message: 'Invalid password!',
                });
            }
        } else {
            // School ID is not registered
            return res.render('user_login', {
                message: 'School ID is not yet registered!',
            });
        }
    } catch (error) {
        console.log(error);
        return res.status(500).send('Internal Server Error');
    }
};
