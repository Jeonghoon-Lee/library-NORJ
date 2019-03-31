function show_user_loans() {
  var info_container = document.getElementById("user_info");
  
  //var img = document.getElementById("img_disappear");
  //img.style.display = "none";

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
    console.log(JSON.stringify(responseObj));
    //info_container.innerHTML = JSON.stringify(responseObj);

    //table
    var labels = ['Book Title', 'Loan Date', 'Due Date']; 
    var keys = ['Title', 'DateOut', 'DateDue'];
    var table = document.createElement('table');
    var thead = document.createElement('thead');
    var tbody = document.createElement('tbody');

    var theadTr = document.createElement('tr');
      for (var i = 0; i < labels.length; i++) {
        var theadTh = document.createElement('th');
        theadTh.innerHTML = labels[i];
        theadTr.appendChild(theadTh);
      }
  
    thead.appendChild(theadTr);
    table.appendChild(thead);

    for (j = 0; j < responseObj.length; j++) {
      var tbodyTr = document.createElement('tr');
      for (k = 0; k < keys.length; k++) {
        var tbodyTd = document.createElement('td');
        tbodyTd.innerHTML = responseObj[j][keys[k]];
        tbodyTr.appendChild(tbodyTd);
      }
      tbody.appendChild(tbodyTr);
    }
    table.appendChild(tbody);
    info_container.innerHTML = "";
    info_container.appendChild(table);
    var loan_table = info_container.getElementsByTagName("table")[0];
    info_container.classList.add('table-responsive');
    loan_table.classList.add('table');
  }
}
            

function show_user_res() {
  var info_container = document.getElementById("user_info");
  //var img = document.getElementById("img_disappear");
  //img.style.display = "none";

  const xhrObj = new XMLHttpRequest();
        xhrObj.open("POST", "http://localhost/PHP_class/project/library-NORJ/src/get_user_reservations.php");
        xhrObj.send();
        //handle errors
        xhrObj.onerror = function () {
            console.error("An error has occured!");
        }
        xhrObj.onload = function (e) {
            //parse received JSON to JS object to retrieve data
            responseObj = JSON.parse(xhrObj.response);
            console.log(responseObj);
            
           // ReservID, Title, ReservDate, ReservStatus
          
      //table
    var labels = ['No.', 'Book Title', 'Date', 'Status']; 
    var keys = ['ReservID', 'Title', 'ReservDate', 'ReservStatus'];
    var table = document.createElement('table');
    var thead = document.createElement('thead');
    var tbody = document.createElement('tbody');

    var theadTr = document.createElement('tr');
      for (var i = 0; i < labels.length; i++) {
        var theadTh = document.createElement('th');
        theadTh.innerHTML = labels[i];
        theadTr.appendChild(theadTh);
      }
  
    thead.appendChild(theadTr);
    table.appendChild(thead);

    for (j = 0; j < responseObj.length; j++) {
      var tbodyTr = document.createElement('tr');
      for (k = 0; k < keys.length; k++) {
        var tbodyTd = document.createElement('td');
        tbodyTd.innerHTML = responseObj[j][keys[k]];
        tbodyTr.appendChild(tbodyTd);
      }
      tbody.appendChild(tbodyTr);
    }
    table.appendChild(tbody);
    info_container.innerHTML = "";
    info_container.appendChild(table);
    var loan_table = info_container.getElementsByTagName("table")[0];
    info_container.classList.add('table-responsive');
    loan_table.classList.add('table');
  }
}