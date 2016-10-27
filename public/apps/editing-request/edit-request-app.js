/**
 * Created by nomantufail on 10/27/2016.
 */
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var db = require('./db.js');
var mydb = new db();

app.get('/', function(req, res){
    res.sendfile('index.html');
});
var sockets = [];
io.on('connection', function(socket){
    socket.on('request_editing', function (data) {
        sockets[socket] = data.user_id;
        var editingUserId = mydb.editing(data.request_id);
        if(editingUserId == 0){
            mydb.lockRequest(data.user_id, data.request_id);
        }else if(editingUserId != data.user_id){
            io.emit('request-locked', {
                'editing':"ss"+editingUserId
            });
        }
    });
    socket.on('disconnect', function(){
        //mydb.releaseRequest(sockets[socket]);
    });
});

http.listen(3000, function(){
    console.log('listening on *:3000');
});