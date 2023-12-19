const express = require('express');
const authController = require('../controllers/auth');  
const router = express.Router();

// Required Pages
router.post('/user_login', authController.login);
router.post('/user_dashboard', authController.login);
router.get('/logout', authController.logout);

module.exports = router;
