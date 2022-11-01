const add = document.getElementById('add');
const addCrypto = document.getElementById('add_crypto');
const addQuantity = document.getElementById('add_quantity');
const addPrice = document.getElementById('add_price');

addCrypto.addEventListener('change', changeCrypto);
addQuantity.addEventListener('change', changeQuantity);

let unitPrice = 0;

function changeCrypto()
{
     fetch('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', {
        headers: {
            'X-CMC_PRO_API_KEY': '904d0623-35e7-4ef2-8c5a-d4b453c7b78b',
            'content-type' : 'application/json',
            'Access-Control-Request-Headers' : 'Content-Type',
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Headers': 'Content-Type, Accept, Origin, Authorization',
            'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, PATCH, OPTIONS',

        },
    })
     .then(response =>
         console.log(response))

       .then(data=>
            console.log(data)
        )
        .catch((error)=>{
            console.error(error);
        })
};

function changeQuantity()
{
console.log('qauntité modifiée')
};


// avant -------------------
/*const request = fetch('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest');

resquest .then((response) => {
    console.log(response);
    const data = response.json(); /*si revoie du json ou response.text(); sur l'API renvoie du txt

    data.then((jsonData)=>{
        console.log(jsonData);
    });
})
.catch((error)=>{
    console.error(error);
})*/