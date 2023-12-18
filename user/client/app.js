// app.js
const express = require('express');
const path = require('path');
const app = express();
const cookieParser = require('cookie-parser');
const dotenv = require('dotenv');

dotenv.config({ path: './.env' });
const db = require('./model/db');

// Parse URL-encoded bodies (as sent by HTML forms)
app.use(express.urlencoded({ extended: false }));

// Parse JSON bodies (as sent by API clients)
app.use(express.json());
app.use(cookieParser());

app.set('view engine', 'hbs');

// retrieve assets
const publicDir = path.join(__dirname, './public');
app.use(express.static(publicDir));

// Define Routes (refer to router/pages.js)
app.use('/', require('./routes/pages'));
app.use('/auth', require('./routes/auth'));

// Fetch number of Reservations
app.get('/reservationCount', (req, res) => {
    const query = 'SELECT COUNT(*) as count FROM reservations';
    db.query(query, (err, results) => {
        if (err) {
            res.status(500).send('Error fetching data.');
            return;
        }
        const count = results[0].count;
        res.json({ count });
    });
});


const port = process.env.PORT;

app.listen(port, () => {
    console.log(`Server started at port ${port}`);
});
