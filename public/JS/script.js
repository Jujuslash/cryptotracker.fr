const add = document.getElementById('add');
const addCrypto = document.getElementById('add_crypto');
const addQuantity = document.getElementById('add_quantity');
const addPrice = document.getElementById('add_price');

addCrypto.addEventListener('change', changeCrypto);
addQuantity.addEventListener('change', changeQuantity);

let unitPrice = 0;

function changeCrypto(event)
{
    unitPrice = event.target.options[event.target.selectedIndex].dataset.price
    console.log(unitPrice)
    if(addCrypto.value !== '' && addQuantity.value !== '')
    {
        addPrice.value = (unitPrice*addQuantity.value).toFixed(2)
    }
};

function changeQuantity()
{
    if(addCrypto.value!=='')
    {
        if(unitPrice!==0)
        {
            addPrice.value = (unitPrice*addQuantity.value).toFixed(2)
        }else{
            addPrice.value = unitPrice.toFixed(2)
        }

    }
    console.log('qauntité modifiée')
};