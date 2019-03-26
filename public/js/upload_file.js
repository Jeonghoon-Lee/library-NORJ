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

  fetch('upload_image.php', {
    method: 'POST',
    body: formData
  })
  .then((response) => {
    if (response.status == 200) {
      return response.json();
    } else {
      if (response.status == 400)
        throw new Error(response.json().message);
      else 
        throw new Error(response.statusText);
    }
  })
  .then((data) => {
    callback(undefined, data.filename);
  })
  .catch((error) => {
    callback(error, undefined);
  });
};
