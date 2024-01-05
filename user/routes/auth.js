const express = require('express');
const authController = require('../controllers/auth');
const router = express.Router();

// Required Pages
router.post('/user_login', authController.login);
router.post('/contact_admin', authController.contact_admin);
router.post('/user_dashboard', authController.login);
router.get('/rooms', authController.rooms);
router.get('/equipments', authController.equipments);
router.get('/logout', authController.logout);


module.exports = router;
