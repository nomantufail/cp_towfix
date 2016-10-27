/**
 * Created by nomantufail on 10/27/2016.
 */
var db = function (){
    var self = this;
    var config = {
        host     : 'localhost',
        user     : 'root',
        password : '',
        database: 'towfix'
    };
    self.mysql = function () {
        return require('mysql');
    };
    self.editing = function (requestId){
        var connection = self.mysql().createConnection(config);
        connection.connect();
        connection.query("select editing from cust_vehicle_srv_reqs where id='"+requestId+"'" , function(err, rows, fields) {
            if (err) throw err;
            return rows[0].editing;
        });

        connection.end();
    };
    self.lockRequest = function (userId, requestId){
        var connection = self.mysql().createConnection(config);
        connection.connect();

        connection.query("UPDATE cust_vehicle_srv_reqs SET editing='"+userId+"' WHERE id="+requestId , function(err, rows, fields) {
            if (err) throw err;
        });

        connection.end();
    };
    self.releaseRequest = function (userId){
        var connection = self.mysql().createConnection(config);
        connection.connect();

        connection.query("UPDATE cust_vehicle_srv_reqs SET editing='0' WHERE editing="+userId , function(err, rows, fields) {
            if (err) throw err;
        });

        connection.end();
    };
};
module.exports = db;