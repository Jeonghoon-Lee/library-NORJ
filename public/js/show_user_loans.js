function show_user_loans() {
  
  const xhrObj = new XMLHttpRequest();
        xhrObj.open("POST", "http://localhost/PHP_class/project/library-NORJ/src/get_user_loans.php");
        xhrObj.send();
        //handle errors
        xhrObj.onerror = function () {
            console.error("An error has occured!");
        }
        xhrObj.onload = function (e) {
            //parse received JSON to JS object to retrieve data
            responseObj = JSON.parse(xhrObj.response);
            alert(responseObj[0].ISBN);
        }
      }
      
      // TODO - create table
      /*var container = getElementByID("user_info");
            var table = document.createElement('table');
            var thead = document.createElement('thead');
            var tbody = document.createElement('tbody');

            var theadTr = document.createElement('tr');
            for (var i = 0; i < 5; i++) {
              var theadTh = document.createElement('th');
              theadTh.innerHTML = responseObj[i];
              theadTr.appendChild(theadTh);
            }
            thead.appendChild(theadTr);
            table.appendChild(thead);

            for (j = 0; j < responseObj.length; j++) {
    var tbodyTr = document.createElement('tr');
    for (k = 0; k < 5; k++) {
      var tbodyTd = document.createElement('td');
      tbodyTd.innerHTML = responseObj[j][labels[k].toLowerCase()];
      tbodyTr.appendChild(tbodyTd);
    }
    tbody.appendChild(tbodyTr);
  }
  table.appendChild(tbody);

  container.appendChild(table);
}

            
            
            
        }*/