// routes/pages.js
const express = require('express');
const authController = require('../controllers/auth');
const dbops = require('../model/dbops'); 

const router = express.Router();

router.get('/', authController.isLoggedIn, (req, res) => {
    console.log("inside");
    console.log(req.user);
    res.render('user_login', {
      user: req.user
    });
});
  
router.get('/user_dashboard', authController.isLoggedIn, authController.user_dashboard);

router.get('/contact_admin', (req, res) => {
    res.render('contact_admin');
});

router.get('/user_login', (req, res) => {
  res.render('user_login');
});

router.get('/dashboard', authController.isLoggedIn, authController.dashboard);

router.get('/rooms', authController.isLoggedIn, authController.rooms);

router.get('/equipments', (req, res) => {
  res.render('equipments');
});

module.exports = router;
