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
  
  var newItem = { name: itemName, price: itemPrice, quantity: currentQuantity };
  cartContent.push(newItem);
  localStorage.setItem('cartContent', JSON.stringify(cartContent));
}

function updateTotalPrice(itemPrice, action) {
  var totalPrice = document.getElementById('total-price');
  var currentTotal = parseInt(totalPrice.textContent);
  
  if (action === 'increase') 
  {
    totalPrice.textContent = currentTotal + itemPrice;
  } 
  else if (action === 'decrease') 
  {
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
  var i = 0;
  if (cartContent) { 
    var cart = document.getElementById('cart-items'); 
    cart.innerHTML = ''; 
    cartContent.forEach(function(item) { 
      var itemElement = document.createElement('li'); 
	  itemElement.id = item.name;
	  
      var leftArrow = document.createElement('button');  		//'<button id="decQuantity" onclick="decQuantity()">&#10094;</button>'; 
      leftArrow.id = "decQuantity";
	  
	  leftArrow.addEventListener('click', function() {
			for (var j = 0; j < cartContent.length; j++) {
				if (cartContent[j].name === item.name) {			
					if (cartContent[j].quantity <= 1)
					{
						console.log(j);
						cartContent.splice(j, 1);
						del_item = document.getElementById(item.name);
						cart.removeChild(del_item);
						localStorage.setItem('cartContent', JSON.stringify(cartContent));
						totaprice = updateTotalPrice(item.price, 'decrease');
					}
					else
					{
						cartContent[j].quantity = cartContent[j].quantity - 1;
						localStorage.setItem('cartContent', JSON.stringify(cartContent));
						totaprice = updateTotalPrice(item.price, 'decrease');
						input.value = item.quantity;
					}
				}
		  }
	  });
	  
	  leftArrow.innerHTML = '&#10094;';
	  
	  var rightArrow = document.createElement('button');  		//'<button id="decQuantity" onclick="decQuantity()">&#10094;</button>'; 
      rightArrow.id = "addQuantity";
	  
	  rightArrow.addEventListener('click', function() {
			for (var j = 0; j < cartContent.length; j++) {
				if (cartContent[j].name === item.name) {
				  cartContent[j].quantity = cartContent[j].quantity + 1;
				  localStorage.setItem('cartContent', JSON.stringify(cartContent));
				  totaprice = updateTotalPrice(item.price, 'increase');
				  input.value = item.quantity;
				}
		  }
	  });
	  
	  rightArrow.innerHTML = '&#10095;';
	  
      itemElement.textContent = item.name + ' - ' + item.price + ' руб.'; 
	  
      itemElement.appendChild(leftArrow); 
	  
	  //itemElement.textContent = item.quantity;
	  
	  var input = document.createElement('input');
	  
	  input.id = i;
	  input.value = item.quantity;
	  input.addEventListener('input', function() {
		  var oldQuantity = item.quantity;
		  var newQuantity = parseInt(this.value);
		  
		  for (var j = 0; j < cartContent.length; j++) 
		  {
				if (cartContent[j].name === item.name) 
				{
					if (newQuantity > 0 && oldQuantity != newQuantity && newQuantity <= 100) {
						cartContent[j].quantity = newQuantity;
						localStorage.setItem('cartContent', JSON.stringify(cartContent));
						
						if (newQuantity > oldQuantity)
						{
							var totalPrice = document.getElementById('total-price');
							var currentTotal = parseInt(totalPrice.textContent);
							totalPrice.textContent = currentTotal + (newQuantity - oldQuantity) * item.price; 
							
							var tPrice = JSON.parse(localStorage.getItem('tPrice')) || [];
							var newItem = { tprice: totalPrice.textContent };
							tPrice.push(newItem);
							localStorage.setItem('tPrice', JSON.stringify(tPrice));
						}
						else
						{
							var totalPrice = document.getElementById('total-price');
							var currentTotal = parseInt(totalPrice.textContent);
							totalPrice.textContent = currentTotal - (oldQuantity - newQuantity) * item.price; 
							
							var tPrice = JSON.parse(localStorage.getItem('tPrice')) || [];
							var newItem = { tprice: totalPrice.textContent };
							tPrice.push(newItem);
							localStorage.setItem('tPrice', JSON.stringify(tPrice));
						}
					}
					else
					{
						input.value = item.quantity;
					}
				}
		  }
	  });

	  
	  ++i;
	  
	  itemElement.appendChild(input);
	  itemElement.appendChild(rightArrow); 
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