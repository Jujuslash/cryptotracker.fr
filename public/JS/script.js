const request = fetch('https://pro.coinmarketcap.com/api/' );

resquest .then((response) => {
    console.log(response);
    const data = response.json(); /*si revoie du json ou response.text(); sur l'API renvoie du txt*/

    data.then((jsonData)=>{
        console.log(jsonData);
    });
})
.catch((error)=>{
    console.error(error);
})

/*const axios = require('axios');

let response = null;
new Promise(async (resolve, reject) => {
    try {
        response = await axios.get('https://pro.coinmarketcap.com/api/', {
            headers: {
                'X-CMC_PRO_API_KEY': '904d0623-35e7-4ef2-8c5a-d4b453c7b78b',
            },
        });
    } catch(ex) {
        response = null;
        // error
        console.log(ex);
        reject(ex);
    }
    if (response) {
        // success
        const json = response.data;
        console.log(json);
        resolve(json);
    }
});*/