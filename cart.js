function addToCart(itemName, itemPrice) {
  var cart = document.getElementById('cart-items');

  var items = cart.getElementsByTagName('li');
  
  var currentQuantity = 0;
  
  var cartContent = JSON.parse(localStorage.getItem('cartContent')) || [];
  
  for (var i = 0; i < items.length; i++) {
    if (items[i].textContent.includes(itemName)) {
      currentQuantity = parseInt(items[i].getAttribute('data-quantity'));
      items[i].setAttribute('data-quantity', currentQuantity + 1);
      items[i].textContent = itemName + ' - ' + itemPrice + ' руб. x' + (currentQuantity + 1);
      totaprice = updateTotalPrice(itemPrice, 'increase');
	  
	  for (var j = 0; j < cartContent.length; j++) {
		if (cartContent[j].name === itemName) {
		  cartContent[j].quantity = currentQuantity + 1;
		  localStorage.setItem('cartContent', JSON.stringify(cartContent));
		  //console.log(cartContent[j].quantity);
		  break;
		}
	  }
	  
      return;
    }
  }

  var item = document.createElement('li');
  item.textContent = itemName + ' - ' + itemPrice + ' руб. x1';
  item.setAttribute('data-quantity', 1);
  cart.appendChild(item);
  updateTotalPrice(itemPrice, 'increase');
  currentQuantity = currentQuantity + 1;
  
  var idItem = items.length;
  
  var newItem = { name: itemName, price: itemPrice, quantity: currentQuantity , id: idItem };
  cartContent.push(newItem);
  localStorage.setItem('cartContent', JSON.stringify(cartContent));
}

function updateTotalPrice(itemPrice, action) {
  var totalPrice = document.getElementById('total-price');
  var currentTotal = parseInt(totalPrice.textContent);
  if (action === 'increase') {
    totalPrice.textContent = currentTotal + itemPrice;
  } else if (action === 'decrease') {
    totalPrice.textContent = currentTotal - itemPrice;
  }
  
  var tPrice = JSON.parse(localStorage.getItem('tPrice')) || [];
  var newItem = { tprice: totalPrice.textContent };
  tPrice.push(newItem);
  localStorage.setItem('tPrice', JSON.stringify(tPrice));
}


function clearCart() {
  var cart = document.getElementById('cart-items');
  
  while (cart.firstChild) {
    cart.removeChild(cart.firstChild);
  }
  
  var price = document.getElementById('total-price');
  
  while (price.firstChild) {
    price.removeChild(price.firstChild);
  }
  
  var totalPrice = document.getElementById('total-price');
  totalPrice.textContent = '0';
  
  localStorage.clear();
}

window.onload = function() {
  var cartContent = JSON.parse(localStorage.getItem('cartContent'));
  if (cartContent) {
    var cart = document.getElementById('cart-items');
    cart.innerHTML = '';
    cartContent.forEach(function(item) {
      var itemElement = document.createElement('li');
	  itemElement.id = item.id;
      itemElement.textContent = item.name + ' - ' + item.price + ' руб. x' + item.quantity;
      itemElement.setAttribute('data-quantity', 1);
      cart.appendChild(itemElement);
    });
  }
    
   var tPrice = JSON.parse(localStorage.getItem('tPrice'));
   if (tPrice) {
    var price = document.getElementById('total-price');
    price.innerHTML = '';
	
    tPrice.forEach(function(item) {
      price.innerHTML = item.tprice;
    });
  }
}





window.addEventListener("DOMContentLoaded", event => {
	document.getElementById('open-cart').onclick = function() {
	  document.getElementsByClassName('cart')[0].style.display = "block";
	}

	document.getElementsByClassName('close')[0].onclick = function() {
	  document.getElementsByClassName('cart')[0].style.display = "none";
	}
	
	document.getElementsByClassName('close_modal')[0].onclick = function() {
	  document.getElementsByClassName('modal')[0].style.display = "none";
	}

	/*window.onclick = function(event) {
	  if (event.target != document.getElementsByClassName('cart')[0] 
	  && event.target != document.getElementById('open-cart')
	  && event.target != document.getElementById('open-cart-img')
	  && event.target != document.getElementById('clcart')) {
		document.getElementsByClassName('cart')[0].style.display = "none";
		return;
	  }
	}*/
})


function showModal(modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "block";
}

function closeModal(modalId) {
  var modal = document.getElementById(modalId);
  modal.style.display = "none";
}

document.addEventListener('click', function(event) {
  var modal = document.querySelector('.modal');
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});