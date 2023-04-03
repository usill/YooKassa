let paymentItems = document.querySelectorAll(".main__tr");
let modals = document.querySelectorAll(".modal");
let modalCloseButtons = document.querySelectorAll(".modal__close");

for(let modal of modals) {
  modal.addEventListener('click', (e) => {
    e.currentTarget.style.display = 'none';
  })
  modal.firstElementChild.addEventListener('click', (e) => {
    e.stopPropagation();
  })
}

for(let button of modalCloseButtons) {
  button.addEventListener('click', (e) => {
    e.target.parentElement.parentElement.style.display = 'none';
  }) 
}

for(let paymentRow of paymentItems) {
  paymentRow.addEventListener('mouseover', (e) => {
    e.currentTarget.style.backgroundColor = "#eeeeee"
  })

  paymentRow.addEventListener('mouseout', (e) => {
    e.currentTarget.style.backgroundColor = "#fff"
  })

  paymentRow.addEventListener('click', (e) => {
    for(item of modals) {
      if(e.currentTarget.dataset.id === item.dataset.id) {
        item.style.display = 'block';
      }
    }
  })
}

