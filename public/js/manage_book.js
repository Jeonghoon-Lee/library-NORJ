const inputFileBtn = document.querySelector('#book-img');

inputFileBtn.addEventListener('change', () => {
  if (inputFileBtn.files.length > 0) {
    console.log(inputFileBtn.files[0]);
    if (inputFileBtn.files[0].size < 2 * 1024 * 1024) {   
      // 2MB
      upLoadFile(inputFileBtn.files[0], (error, data) => {
        if (error) {
          // display error message;
          alert(error);
        } else {
          const IMAGE_PATH = 'public/img/';
          if (document.querySelector('.book-image').childElementCount == 0) {
            // create image tag for book
            const imageElement = document.createElement('img');

            imageElement.src = IMAGE_PATH + data;
            imageElement.alt = 'book image';
            document.querySelector('.book-image').appendChild(imageElement);
          } else {
            document.querySelector('.book-image img').src = IMAGE_PATH + data;
          }
          // set filename value: 
          document.querySelector('[name="BookImage"]').value = data;
        }
      });
    } else {
      // display error message;
      alert('File is too big. Maximum file size is 2MB.');
    }
  }
});
