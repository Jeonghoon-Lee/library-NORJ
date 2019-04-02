const reserveBtn = document.querySelector('[title="Reservation"]');

if (reserveBtn != null) {
  reserveBtn.addEventListener('click', ()=> {
    const response = confirm('Do you want to reserve a book?');
    
    if (response) {
      // send message to reserve.
      const bookID = document.querySelector('#ISBN').value;
      console.log(bookID);

      const formData = new FormData();
      formData.append('ISBN', bookID);
    
      fetch('book/reserve', {
        method: 'POST',
        body: formData
      })
      .then((response) => {
        console.log(response);
        if (response.status == 200) {
          return response.json();
        } else {
          throw new Error('File upload failed!');
        }
      })
      .then((data) => {
        console.log(data);
        window.location.href = 'user/detail';
      }).catch((error) => {
        console.error(error);
        alert('Your request was failed!');
      });
    }
  });
}

document.querySelector('[title="Print"]').addEventListener('click', ()=> {
  alert('Sorry! Print is not available now.');
});
