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
        sockets[socket.id] = {user_id: data.user_id, request_id: data.request_id};
        var getEditingUserId = mydb.editing(data.request_id);
        getEditingUserId.then(function (editingUserId) {
            if(editingUserId == 0){
                mydb.lockRequest(data.user_id, data.request_id);
            }else if(editingUserId != data.user_id){
                io.emit('request-locked', {
                    'editing':editingUserId,
                    'request_id':data.request_id
                });
            }
        }, function (err) {
            console.log('error');
        });

    });
    socket.on('disconnect', function(){
        if(sockets[socket.id] != undefined){
            mydb.releaseRequest(sockets[socket.id].user_id).then(function (result) {
                io.emit('request-released',{
                    'request_id':sockets[socket.id].request_id
                });
            });
        }
    });
});

http.listen(3000, function(){
    console.log('listening on *:3000');
});