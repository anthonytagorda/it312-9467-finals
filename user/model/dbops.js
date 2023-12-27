// model/dbops.js
const config = require('./db');
const mysql = require('mysql');

// Create a pool using the configuration
const pool = mysql.createPool(config);

// Retrieve rooms from the database
async function getRooms() {
    try {
        let rooms = await pool.query("SELECT * FROM rooms");
        return rooms[0]; // rooms[0] contains the result
    } catch (error) {
        console.log(error);
        throw error; // Rethrow the error so it can be caught by the caller
    }
}

module.exports = {
    getRooms: getRooms
};
