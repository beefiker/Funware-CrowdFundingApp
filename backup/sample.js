
const cors = require('cors');
const express= require('express');
const axios = require('axios');
const app = express();

app.use(cors()); 

axios({
    url: "https://api.igdb.com/v4/games",
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Client-ID': '55579kuwsr394aey29xk10drjwwsba',
        'Authorization': 'Bearer nrin1segj0xlcvm2o0o0vez38l8ppr'
    },
    data: "fields na3me; limit 5; "
  })
    .then(response => {
        console.log(response.data);
    })
    .catch(err => {
        console.error(err);
    });

  