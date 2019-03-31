<?php
// Users.php
  class Users extends Controller {
    private $Users;
    private $loans;
    private $reservations;

    function __construct(){
      parent::__construct();
      // Initialize Models
      $this->Users = new UserModel($this->db);
      $this->loans = new LoanViewModel($this->db);
      $this->reservations = new ReserveViewModel($this->db);
    }

    function create_form($f3) {
      $months = array(
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December',
      );
      $min_year = 1920;
      $cur_year = date('Y');

      // clear session
      $f3->set('SESSION', array());

      $render_options = array(
        "form_action"	=> "user/create", 
        "min_year" => $min_year, 
        "cur_year" => $cur_year, 
        "months" => $months
      );
      echo $f3->get("twig")->render("create_user.html", $render_options);
    }

    function create($f3) {
      // form submitted
      $error = "";

      echo "<pre>";
      echo print_r($f3->get("POST"));
      echo "</pre>";

      if ($f3->get("POST.FirstName") == "") {
        $error = "Please fill in your first name.";
      } else if (is_numeric($f3->get("POST.FirstName"))) {
        $error = "Please enter a valid first name.";
      } else if (is_numeric($f3->get("POST.MiddleName"))) {
        $error = "Please enter a valid middle name.";
      } else if ($f3->get("POST.LastName") == "") {
        $error = "Please fill in your last name.";
      } else if (is_numeric($f3->get("POST.LastName"))) {
        $error = "Please enter a valid last name.";
      } else if ($f3->get("POST.UserName") == "") {
        $error = "Please fill in your user name.";
      } else if ($this->Users->is_exist_username($f3->get("POST.UserName")) > 0) {
        $error = "User name is already exist.";
      } else if ($f3->get("POST.Email") == "") {
        $error = "Please fill in your email.";
      } else if (!filter_var($f3->get("POST.Email"), FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a vaild email";
      } else if ($f3->get("POST.Password") == "") {
        $error = "Please enter your password.";
      } else if (strlen($f3->get("POST.Password")) < 1) {
        $error = "Password is too short.";
      } else if (strlen($f3->get("POST.Password")) > 15) {
        $error = "Password is too long.";
      } else if ($f3->get("POST.Password") != ($f3->get("POST.Password_c"))) {
        $error = "Passwords don't match.";
      } else if ($f3->get("POST.day") == "") {
        $error = "Please enter your Date of Birth.";
      } else if ($f3->get("POST.month") == "") {
        $error = "Please enter your Date of Birth.";
      } else if ($f3->get("POST.year") == "") {
        $error = "Please enter your Date of Birth.";
      }

      if ($error == '') {
        // No error
        $f3->set("POST.BirthDate", date($f3->get("POST.year") . '-' . $f3->get("POST.month") . '-' . $f3->get("POST.day")));
        $f3->set("POST.Password", md5($f3->get("POST.Password")));
        $f3->set("POST.RegisteredDate", date('Y-m-d'));
        $f3->set("POST.UserType", "user");
        
        // create new user in user table
        $this->Users->create_user();

        // reroute to login page
        $f3->reroute('/user/login');
      } else {
        echo $error;
      }

        // TO DO check if user name already exists
    }

    // create login form
    function login_form($f3) {
      $render_options = array("form_action" => "user/login");
      echo $f3->get("twig")->render("login.html", $render_options);
    }

    // check login validation
    function login($f3) {
      // for testing
      // echo '<pre>';
      // echo print_r($f3->get('POST'));
      // echo '</pre>';

      $error = "";
      if ($f3->get("POST.UserName") == "") {
        $error = "Please fill in your user name.";
      } else if ($f3->get("POST.Password") == "") {
        $error = "Please enter your password.";
      } else {
        // username and password are filled in
        //check in database for valid user
      
        $results = $this->Users->get_user_by_username($f3->get("POST.UserName"));

        // without framework
        // $results = DB::queryFirstRow("SELECT UserId, FirstName, LastName, UserType, password 
        //                         FROM users 
        //                         WHERE username = %s 
        //                         LIMIT 1", $_POST['user_name']);
        
        // check 1 row returned
        if (sizeof($results) == 0) { // number of rows returned
          $error = "User does not exist";
        } else {        
          // encrypt password to match databases
          // without framework
          // if ($results['password'] != md5($_POST['password']) ){ //check if passwords match
          if ($results[0]->Password != md5($f3->get("POST.Password"))) {
            $error = "Wrong password. Please try again.";
          } else {
            // save session
            $f3->set('SESSION.UserID', $results[0]->UserID);
            $f3->set('SESSION.FirstName', $results[0]->FirstName);
            $f3->set('SESSION.LastName', $results[0]->LastName);
            $f3->set('SESSION.UserType', $results[0]->UserType);

            // update our last_login if user found
            $this->Users->update_logintime_by_username($f3->get("POST.UserName"));

            // for testing
            // echo '<pre>';
            // echo print_r($f3->get('SESSION'));
            // echo '</pre>';

            $f3->reroute('/user/detail');

            // $render_options = array(
            //   "session" => $f3->get("SESSION")
            // );
            // echo $f3->get("twig")->render("user_account.html", $render_options);  
            // without frame work
            // DB::update('users', array('LastLoginTime'=>DB::sqleval("CURTIME()")), 'UserId=%i', $results['UserId']);
    
            // if ( DB::affectedRows() != 1 ){ // number of rows altered by query
            //   $log->error("Did not update last login");
            // }           
            // //save session
            // $_SESSION['UserId'] = $results['UserId'];
            // $_SESSION['FirstName'] = $results['FirstName'];
            // $_SESSION['LastName'] = $results['LastName'];
            // $_SESSION['UserType'] = $results['UserType'];
                         
            // header("Location: manage_account.php");
            
          }
        }
      }
      if ($error != "") {
        $render_options = array(
          "session" => $f3->get("SESSION"),
          "form_action" => "user/login", 
          "error" => $error
        );
        echo $f3->get("twig")->render("login.html", $render_options);  
      }
    }

    // get account detail from database
    // and then render user_account.html using twig engine
    function get_account_detail($f3) {
      // session check
      if ($f3->get("SESSION.UserID") != "") {
        // login success
        $charges = 0;     // need to add field in view.
        $render_options = array(
          "session" => $f3->get("SESSION"),
          "loan_amount" => $this->loans->get_loan_count_by_userid($f3->get("SESSION.UserID")),
          "res_amount" => $this->reservations->get_reserved_count_by_userid($f3->get("SESSION.UserID")),
          "charges"=> $charges
        );
        echo $f3->get("twig")->render("user_account.html", $render_options);
      } else {
        // redirect to home
        $f3->reroute("/");
      }
    }

    // log out
    function logout($f3) {
      // clear session
      $f3->set('SESSION', array());

      // redirect to home
      $f3->reroute("/");
    }

    function update_form($f3) {
      echo '<h2>Load Update User Form</h2>';      
    }

    function update($f3) {
      echo '<h2>Load Update User Form</h2>';      
    }

    function delete_account($f3) {
      echo '<h2>account was deleted successfully.</h2>';
    }
  }
?>