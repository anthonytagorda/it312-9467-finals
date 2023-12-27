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
  
router.get('/user_dashboard', authController.isLoggedIn, authController.dashboard);

router.get('/contact_admin', (req, res) => {
    res.render('contact_admin');
});

router.get('/user_login', (req, res) => {
  res.render('user_login');
});

router.get('/dashboard', (req, res) => {
  res.render('dashboard');
});

router.get('/rooms', async (req, res) => {
  try {
    res.render('rooms', { 
      
    });  // Render the rooms view with the fetched rooms data
  } catch (error) {
    
  }
});


router.get('/equipments', (req, res) => {
  res.render('equipments');
});

module.exports = router;
