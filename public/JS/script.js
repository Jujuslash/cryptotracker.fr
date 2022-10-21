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