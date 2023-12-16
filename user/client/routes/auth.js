const express = require('express');
const authController = require('../controllers/auth')
const router = express.Router();

// Required Pages
router.post('/user_login', authController.login);

module.exports = router;