// controllers/auth.js
const jwt = require('jsonwebtoken');
const db = require('../model/db');
const dbops = require('../model/dbops');
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

exports.user_dashboard = (req, res) => {
    // Handle logic for displaying the dashboard
    let currentDate = new Date();
    res.render('user_dashboard', { 
        user: req.user,
        currentDate: currentDate
    });
};

exports.dashboard = async (req, res) => {
    try {
        // Fetch recent transactions
        const transactions = await db.query("SELECT transaction_num, user_id, custodian_id, room_id, equip_id, transaction_date, transaction_status FROM transactions"); 
        
        // Check if transactions are empty or not
        if (transactions && transactions.length > 0) {
            // Render the dashboard view with the transactions data
            res.render('dashboard', { 
                transactions: transactions
            });
        } else {
            // If no transactions found, render the dashboard view with an empty array
            res.render('dashboard', { 
                transactions: []
            });
        }
    } catch (error) {
        console.error('Error fetching transactions:', error.message);
        res.status(500).send('Internal Server Error');
    }
}

exports.rooms = (req, res) => {
    //  Handle logic for displaying the rooms
    try {
        const rooms = dbops.getRooms();  // Fetch rooms using the getRooms function
        res.render('rooms', { 
          rooms: rooms 
        });  // Render the rooms view with the fetched rooms data
      } catch (error) {
        res.send('Error fetching rooms:', error);
        res.status(500).send('Internal Server Error');
      }
}


exports.logout = (req, res) => {
    res.cookie('jwt', 'loggedout', {
        maxAge: 10 * 1000, // Set the expiration time to 10 seconds
        httpOnly: true
    });
    res.status(200).redirect("/user_login");
};