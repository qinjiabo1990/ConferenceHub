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
    if (username != '' && password != ''){
        connection.query("INSERT INTO USERS_INFO (username, password) VALUES (?,?)", [username, password], function(err, row, fields){
            if (err) console.log(err);
            if (err) {
                res.send({'success': false, 'message': 'Email has been used'});
            } else {
                res.send({'success': true});
            }
        });
    } else{
        res.send({'success': false, 'message': 'Email or password cannot be empty, please try again'});
    }
});

module.exports = router;