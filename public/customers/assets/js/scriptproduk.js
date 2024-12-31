function showDetails(productName, productPrice, productDescription) {
    const modal = document.getElementById('product-modal');
    const title = document.getElementById('modal-title');
    const price = document.getElementById('modal-price');
    const description = document.getElementById('modal-description');
  
    title.innerText = productName;
    price.innerText = productPrice;
    description.innerText = productDescription;
  
    modal.classList.remove('hidden');
  }
  
  function closeDetails() {
    const modal = document.getElementById('product-modal');
    modal.classList.add('hidden');
  }
  