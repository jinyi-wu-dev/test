    document.addEventListener("DOMContentLoaded", function() {
      loadCartStorage();
      for(let item_id in lending_cart) {
        addCart(
          item_id,
          lending_cart[item_id][0],
          lending_cart[item_id][1],
          lending_cart[item_id][2]
        );
      }
      
      document.querySelectorAll(".lending-request-button").forEach(function(btn) {
        if (inCartItem(btn.getAttribute("item_id"))) {
          btn.classList.add('is-active');
        }
        btn.addEventListener('click', function() {
          if (btn.classList.contains('is-active')) {
            removeCartItem(btn.getAttribute("item_id"));
            removeCart(btn.getAttribute("item_id"));
            btn.classList.remove('is-active');
          } else {
            addCartItem(
              btn.getAttribute("item_id"),
              1,
              btn.getAttribute("item_name1"),
              btn.getAttribute("item_url")
            );
            addCart(
              btn.getAttribute("item_id"),
              1,
              btn.getAttribute("item_name1"),
              btn.getAttribute("item_name2"),
              btn.getAttribute("item_url")
            );
            btn.classList.add('is-active');
          }
        });
      });
    });

    /* Cart storage */
    var lending_cart;
    function loadCartStorage() {
      json = localStorage.getItem('lending_cart');
      if (!json) {
        lending_cart = {};
      } else {
        lending_cart = JSON.parse(json)
      }
    }
    function saveCartStorage() {
      localStorage.setItem('lending_cart', JSON.stringify(lending_cart));
    }

    /* Edit cart item */
    function addCartItem(item_id, num, name, image_url) {
      lending_cart[item_id] = [num, name, image_url];
      saveCartStorage();
    }
    function removeCartItem(item_id) {
      delete lending_cart[item_id];
      saveCartStorage();
    }
    function inCartItem(item_id) {
      return (item_id in lending_cart);
    }
    function numOfCartItem() {
      return Object.keys(lending_cart).length;
    }
    function setNumOfCartItem(item_id, num) {
      if (lending_cart[item_id]) {
        lending_cart[item_id][0] = num;
        saveCartStorage();
      }
    }

    /* Cart event */
    function incrementCartEvent(e) {
      item = e.target.closest('.lending-list__item');
      input = e.target.parentNode.querySelector('.counter-input');
      if (Number(input.value)<99) {
        input.value =  Number(input.value)+1;
      }
      setNumOfCartItem(item.getAttribute('item_id'), input.value);

      return false;
    }
    function decrementCartEvent(e) {
      item = e.target.closest('.lending-list__item');
      input = e.target.parentNode.querySelector('.counter-input');
      if (Number(input.value)>1) {
        input.value =  Number(input.value)-1;
      }
      setNumOfCartItem(item.getAttribute('item_id'), input.value);

      return false;
    }
    function removeCartEvent(e) {
      item = e.target.closest('.lending-list__item');
      item_id = item.getAttribute('item_id');

      removeCart(item_id);
      removeCartItem(item_id);
      item.remove();

      document.querySelectorAll(".lending-request-button").forEach(function(btn) {
        if (btn.getAttribute('item_id')==item_id) {
          btn.classList.remove('is-active');
        }
      });
      document.querySelector('.cart-num').textContent = numOfCartItem();
    }

    function addCart(item_id, num_of_item, item_name1, item_name2, item_url) {
      document.querySelectorAll('.lending-list').forEach(function(elm) {
        var new_item = document.getElementById('lending_item_sample');
        new_item = new_item.children[0].cloneNode(true);
        new_item.classList.add('cart_item_'+item_id);
        new_item.setAttribute('item_id', item_id);
        new_item.querySelector('input[name=items\\[\\]]').value = item_id;
        new_item.querySelector('.lending-text__name').textContent = item_name1;
        new_item.querySelector('.counter-input').setAttribute('value', num_of_item);
        new_item.querySelector('.increment').addEventListener('click', incrementCartEvent);
        new_item.querySelector('.decrement2').addEventListener('click', decrementCartEvent);
        new_item.querySelector('.lending-delete-button').addEventListener('click', removeCartEvent);
        elm.appendChild(new_item);
      });

      document.querySelector('.cart-num').textContent = numOfCartItem();
    }
    function removeCart(item_id) {
      document.querySelectorAll('.cart_item_'+item_id).forEach(function(elm) {
        elm.remove();
      });

      document.querySelector('.cart-num').textContent = numOfCartItem();
    }
