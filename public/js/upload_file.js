/**
 * upLoadFile() 
 *  - ES6 syntax arrow function
 *  - upload file to server. use callback to handle result.
 * 
 * @param {Object} file 
 * @param {function} callback 
 */
const upLoadFile = (file, callback) => {
  const formData = new FormData();
  formData.append('image', file);

  fetch('book/upload_image', {
    method: 'POST',
    body: formData
  })
  .then((response) => {
    if (response.status == 200) {
      return response.json();
    } else {
      throw new Error('File upload failed!');
    }
  })
  .then((data) => {
    callback(undefined, data.filename);
  })
  .catch((error) => {
    callback(error, undefined);
  });
};
