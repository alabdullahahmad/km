const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const axios = require('axios');
const cors = require('cors');

const app = express();
const server = http.createServer(app);
const io = socketIo(server, {
  cors: {
    origin: "http://127.0.0.1:8000", // السماح للطلبات من Laravel
    methods: ["GET", "POST"]
  }
});

// استخدام CORS في Express
app.use(cors());

let checkInLogs = [];
let checkedInLogs = [];

// Namespace '/checkin'
const checkinNamespace = io.of('/checkin');

checkinNamespace.on('connection', (client) => {
  console.log('Connected to /checkin:', client.id);
  
  checkinNamespace.emit('documents', JSON.stringify(checkInLogs));
  
  client.on('documents', (data) => {
    checkInLogs = checkInLogs.filter(item => item.userId != data);
    checkedInLogs = checkedInLogs.filter(item => item.userId != data);
  });

  client.on('disconnect', () => {
    console.log('Disconnected from /checkin:', client.id);
  });
});

// Root socket events
io.on('connection', (client) => {
  console.log('Client connected:', client.id);

  client.on('checkIn', async (data) => {
    try {
      console.log('Check-in request received for:', data);
      
      const branchId = data.branchId;
      // Call external API
      const response = await axios.post('http://localhost:8000/api/fin',
        {
          userId : data.userId
        }
      );
      console.log('Data fetched from Laravel:', response.data);
      
      // Send data back to the client
      io.emit(`checkInUser-${branchId}`, response.data);
      
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  });

  client.on('attandamce', (params) => {
    console.log('Attendance event received:', params);
  });

  client.on('disconnect', () => {
    console.log('Client disconnected:', client.id);
  });
});

// تشغيل الخادم
server.listen(3003, "0.0.0.0", () => {
  console.log(`Listening on port 3003`);
});
