const express = require('express');
const router = express.Router();


// Render Pages
router.get('/', (req, res) => {
    res.render('user_login');
});

router.get("/user_login", (req, res) => {
    res.render("user_login");
});

router.get('/contact_admin', (req, res) => {
    res.render('contact_admin');
});

router.get('/user_dashboard', (req, res) => {
    res.render('user_dashboard');
});

module.exports = router;