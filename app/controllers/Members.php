<?php
// members.php
  class Members extends Controller {
    private $members;
    private $loans;
    private $reservations;

    function __construct(){
      parent::__construct();
      // Initialize Models
      $this->members = new MemberModel($this->db);
      $this->loans = new LoanViewModel($this->db);
      $this->reservations = new ReserveViewModel($this->db);
    }

    function create_form($f3) {
      echo '<h2>Load Register User Form</h2>';
    }

    function create($f3) {
      echo '<h2>DB update and Create Account Done</h2>';
    }

    // create login form
    function login_form($f3) {
      $render_options = array("form_action" => "member/login");
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
      
        $results = $this->members->get_member_by_username($f3->get("POST.UserName"));

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
            $this->members->update_logintime_by_username($f3->get("POST.UserName"));

            // for testing
            // echo '<pre>';
            // echo print_r($f3->get('SESSION'));
            // echo '</pre>';

            $f3->reroute('/member/detail');

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
          "form_action" => "member/login", 
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