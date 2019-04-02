<?php
// Users.php
  class Users extends Controller {
    private $Users;
    private $loans;
    private $reservations;
    private $messages;

    private $month;
    private $min_year;
    private $max_year;

    function __construct(){
      parent::__construct();

      // Initialize Models
      $this->Users = new UserModel($this->db);
      $this->loans = new LoanViewModel($this->db);
      $this->reservations = new ReserveViewModel($this->db);
      $this->messages = new ContactMessageModel($this->db);

      $this->months = array(
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December",
      );
      $this->min_year = 1920;
      $this->cur_year = date("Y");
    }

    // create user form
    function create_form($f3) {
      if ($f3->get("SESSION.UserType") != "admin") {
        // clear session
        $f3->set("SESSION", array());
      }

      $render_options = array(
        "form_action"	=> "user/create", 
        "session" => $f3->get("SESSION"),
        "min_year" => $this->min_year, 
        "cur_year" => $this->cur_year, 
        "months" => $this->months
      );
      echo $f3->get("twig")->render("create_user.html", $render_options);
    }


    // check validation for create and update user
    function check_validation($f3, $create_mode) {
      $error = '';

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
      } else if ($create_mode && $this->Users->is_exist_username($f3->get("POST.UserName")) > 0) {
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

      return $error;
    }

    function create($f3) {
      // form submitted
      $error = $this->check_validation($f3, true);

      if ($error == "") {
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
        // clear session
        $f3->set("SESSION", array());
  
        $render_options = array(
          "form_action"	=> "user/create", 
          "min_year" => $this->min_year, 
          "cur_year" => $this->cur_year, 
          "months" => $this->months,
          "error" => $error
        );
        echo $f3->get("twig")->render("create_user.html", $render_options);
      }
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
            $f3->set('SESSION.UserName', $results[0]->UserName);
            $f3->set('SESSION.FirstName', $results[0]->FirstName);
            $f3->set('SESSION.LastName', $results[0]->LastName);
            $f3->set('SESSION.UserType', $results[0]->UserType);

            // update our last_login if user found
            $this->Users->update_logintime_by_username($f3->get("POST.UserName"));

            // for testing
            // echo '<pre>';
            // echo print_r($f3->get('SESSION'));
            // echo '</pre>';

            if ($f3->get('SESSION.UserType') == 'user') {
              // user page
              $f3->reroute('/user/detail');
            } else {
              // admin page
              $f3->reroute('/admin/home');
            }
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
      $f3->set("SESSION", array());

      // redirect to home
      $f3->reroute("/");
    }

    function update_form($f3) {
      if ($f3->get('SESSION.UserName') != '') {
        $render_options = array(
          "form_action"	=> "user/update/" . $f3->get("PARAMS.id"), 
          "min_year" => $this->min_year, 
          "cur_year" => $this->cur_year, 
          "months" => $this->months,
          "session" => $f3->get("SESSION"),
          "user" => $this->Users->get_user_by_userid($f3->get("PARAMS.id"))[0]
        );
        echo $f3->get("twig")->render("create_user.html", $render_options);
      }
    }

    function update($f3) {
      // form submitted
      $error = $this->check_validation($f3, false);

      if ($error == "") {
        // No error
        $f3->set("POST.BirthDate", date($f3->get("POST.year") . '-' . $f3->get("POST.month") . '-' . $f3->get("POST.day")));
        $f3->set("POST.Password", md5($f3->get("POST.Password")));
        
        // update user information
        $this->Users->update_user_by_id($f3->get("POST.UserID"));

        // reroute to login page
        if ($f3->get("SESSION.UserType") == "admin") {
          $f3->reroute("/admin/user_list");
        } else {
          $f3->reroute('/user/detail');
        }
      } else { 
        if ($f3->get('SESSION.UserName') != '') {
          $render_options = array(
            "form_action"	=> "user/update/" . $f3->get("PARAMS.id"), 
            "min_year" => $this->min_year, 
            "cur_year" => $this->cur_year, 
            "months" => $this->months,
            "session" => $f3->get("SESSION"),
            "user" => $this->Users->get_user_by_userid($f3->get("PARAMS.id"))[0],
            "error" => $error
          );
          echo $f3->get("twig")->render("create_user.html", $render_options);
        }
      }
    }

    function delete_account($f3) {
      if ($f3->get("PARMS.id") == $f3->get("SESSION.UserID")) {
        $this->books->delete_user_by_userid($f3->get('PARAMS.id'));
        // session clear
        $f3->set("SESSION", array());
        $f3->reroute("/");
      } else if ($f3->get("SESSION.UserType") == "admin") {
        $this->books->delete_user_by_userid($f3->get('PARAMS.id'));
        $f3->reroute("admin/home");
      }
    }

    // create contact form
    function contact_form($f3) {
      $render_option = array(
        "session" => $f3->get("SESSION")
      );  
      echo $f3->get("twig")->render("contact.html", $render_option);
    }
    
    // save contact to database
    function contact($f3) {
      $error = "";
      if ($f3->get("POST.Email") == "") {
        $error = "Please fill in your email.";
      } else if (!filter_var($f3->get("POST.Email"), FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a vaild email";
      } else if ($f3->get("POST.Subject") == "") {
        $error = "Please enter Subject.";
      } else if ($f3->get("POST.Message") == "") {
        $error = "Please enter Message.";
      } else if ($f3->get("POST.Name") == "") {
        $error = "Please enter Contact Name.";
      } else if (is_numeric($f3->get("POST.Name"))) {
        $error = "Please enter a valid Contact Name.";
      }

      if ($error == "") {
        // successfully posted
        $this->messages->add_message();
        $f3->reroute("/");
      } else {
        $render_option = array(
          "session" => $f3->get("SESSION"),
          "error" => $error
        );  
        echo $f3->get("twig")->render("contact.html", $render_option);
      }
    }

    function update_message($f3) {
      if ($f3->get("SESSION.UserType") == "admin") {
        if ($f3->get("POST.completed") == "Completed") {
          $this->messages->completed_message_by_id($f3->get("POST.MsgID"));
        } else if ($f3->get("POST.delete") == "Delete") {
          $this->messages->delete_message_by_id($f3->get("POST.MsgID"));
        }
        $f3->reroute('/admin/message_list');
      } else {
        $f3->reroute("/");
      }
    }

    function get_user_loans($f3) {
      //get array of user's loans (array of arrays)
      $loans = $this->loans->get_user_loans_by_id($f3->get("SESSION.UserID"));

      echo json_encode($loans);
    }

    function get_user_reservations($f3) {
      //get array of user's reservations (array of arrays)
      $res = $this->reservations->get_user_reservation_by_id($f3->get("SESSION.UserID"));

      echo json_encode($res);  
    }
  }
?>