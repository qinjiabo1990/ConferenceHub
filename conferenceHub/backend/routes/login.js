var express = require('express');
var router = express.Router();
var mysql = require('mysql');

var connection = mysql.createConnection({
    host: 'localhost',
    user: 'id6742935_root',
    password: '123456',
    database: 'id6742935_conference_app',
});

/* Our backend endpoint to check for users in the database */
router.post('/', function(req, res, next) {
    var username = req.body.username;
    //Encrypt
    var password = req.body.password;
    connection.query("SELECT * FROM USERS_INFO WHERE username = ? AND password = ?", [username, password], function(err, row, fields){
        if (err) console.log(err);

        if (row.length > 0) {
            res.send({'success': true, 'message': row[0].username});
        } else {
            res.send({'success': false, 'message': 'User or password is wrong, please try again'});
        }
    });
});

module.exports = router;
