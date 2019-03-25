const inputFileBtn = document.querySelector('#book-img');

inputFileBtn.addEventListener('change', () => {
  if (inputFileBtn.files.length > 0) {
    if (inputFileBtn.files[0].size < 2000000) {   
      // 2MB
      upLoadFile(inputFileBtn.files[0], (error, data) => {
        if (error) {
          // display error message;
          alert(error);
        } else {
          if (document.querySelector('.book-image').childElementCount == 0) {
            // create image tag for book
            const imageElement = document.createElement('img');

            imageElement.src = data;
            imageElement.alt = 'book image';
            document.querySelector('.book-image').appendChild(imageElement);
          } else {
            document.querySelector('.book-image img').src = '../public/img/file.name';
          }
        }
      });
    } else {
      // display error message;
      alert('File is too big. Maximum file size is 2MB.');
    }
  }
});
