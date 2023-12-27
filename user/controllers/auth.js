// controllers/auth.js
const jwt = require('jsonwebtoken');
const db = require('../model/db');
const bcrypt = require('bcryptjs');
const { promisify } = require('util');

exports.login = async (req, res) => {
    const { school_id, password } = req.body;

    // 1) Check if the school_id and password exist
    if (!school_id || !password) {
        return res.status(400).render("login", {
            message: 'Please provide School ID and Password'
        });
    }

    // 2) Check if user exists && password is correct
    db.query('SELECT * FROM user_credentials WHERE school_id = ?', [school_id], async (error, results) => {
        console.log('SQL Query:', db.format('SELECT * FROM user_credentials WHERE school_id = ?', [school_id]));
        console.log('Query Results:', results);

        // Check if results is defined and not empty
        if (!results || results.length === 0) {
            return res.status(401).render("user_login", {
                message: 'Incorrect school id or password'
            });
        }

        const isMatch = password === results[0].password;

        console.log('Entered Password:', password);
        console.log('Stored Password:', results[0].password);
        console.log('isMatch:', isMatch);

        if (!results || !isMatch) {
            return res.status(401).render("user_login", {
                message: 'Incorrect school id or password'
            });
        } else {
            // Redirect to /user_dashboard on successful login
            res.status(200).redirect("/user_dashboard");
        }
    });
};

exports.isLoggedIn = async (req, res, next) => {
    console.log(req.cookies);
    if (req.cookies.jwt) {
        try {
            // 1) Verify Token
            const decoded = await promisify(jwt.verify)(
                req.cookies.jwt,
                process.env.JWT_SECRET
            );
            console.log("decoded");
            console.log(decoded);

            // 2) Check if user still exists
            db.start.query('SELECT * FROM user_credentials WHERE school_id = ? A', [decoded.id], (error, result) => {
                console.log(result)
                if(!result) {
                    return next();
                }
                // THERE IS A LOGGED IN USER
                req.user = result[0];
                console.log("next")
            });
        } catch (err) {
            return next();
        }
    } else {
        next();
    }
};

exports.dashboard = (req, res) => {
    // Handle logic for displaying the user dashboard
    let currentDate = new Date();
    res.render('user_dashboard', { 
        user: req.user,
        currentDate: currentDate
    });
};

exports.logout = (req, res) => {
    res.cookie('jwt', 'loggedout', {
        maxAge: 10 * 1000, // Set the expiration time to 10 seconds
        httpOnly: true
    });
    res.status(200).redirect("/");
};