const express = require('express');
const app = express();
const http = require('http').Server(app);
const io = require('socket.io')(http);
const axios = require('axios');
const fs = require('fs');

let checkInLogs = [];
let checkedInLogs = [];
io.of('/checkin').on('connection', (client) => {
    // console.log('connected to /checkin: ' + client.id);
    io.of('/checkin').emit('documents', JSON.stringify(checkInLogs));
    client.on('documents', (data) => {
      // console.log('recieved document from /checkin: ' + data);
      checkInLogs = checkInLogs.filter((item) => item.userId != data);
      checkedInLogs = checkedInLogs.filter((item) => item.userId != data);
    });
    client.on('disconnect', () => {
      // console.log('disconnected: ' + client.id);
    });
  });
  io.on('connection', (client) => {
    // console.log('connected to /: ' + client.id);
    client.on('documents', async (user) => {

        try {
            console.log(user);
            const response = await axios.get("http://192.168.100.58:8000/fin");
            console.log(response.data);
          } catch (error) {
            console.error('Error fetching data:', error);
          }
    //   let data = { userId: user };
    //   if (!checkInLogs.find((item) => item.userId == data.userId)) {
    //     const oldUser = (await getUsersData()).find((element, index) => {
    //       return element.user_id == data.userId;
    //     });
    //     if (oldUser) {
    //       // console.log(oldUser);
    //       data.userId = oldUser.uid;
    //       checkInLogs.push(data);
    //       // temp = JSON.parse(fs.readFileSync(${__dirname}/checkInLog.json));
    //       // temp.push(data);
    //       // fs.writeFile(${__dirname}/checkInLog.json, JSON.stringify(temp));
    //       io.of('/checkin').emit('documents', JSON.stringify(checkInLogs));
    //     }
    //   }


    });
    client.on('attandamce',function (params) {
        console.log(params);
    })
    client.on('disconnect', () => {
      // console.log('disconnected: ' + client.id);
    });
  });

  http.listen(3003,"0.0.0.0", function () {
    console.log(`listening on http*:${3003}`);
  });
