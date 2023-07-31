<?php

class Auth extends DB {
  protected static $table = 'users';
  protected static $columns = [
    'id',
    'username',
    'email',
    'hashed_password',
    'created_at',
    'email_verified_at',
    'role'
  ];
  protected $errors = [];

  /**
   * properties
   */
  public $id;
  public $username;
  public $email;
  private $hashed_password;
  private $created_at;  
  public $role;

  public static function all () {
    // does nothing overwriting method of parent class
  }

  protected function create () {
    // parent::create(); does nothing 
  }

  public static function register (Array $args=[]) {
    /*check user exists*/
    $is_registered = self::find_by_email($args["email"]);
    if ($is_registered) {
      self::$errors[] = "User is already registered, try login.";
      return false;
    }
    
    /*make required changes*/
    $args["hashed_password"] = password_hash($args["hashed_password"], PASSWORD_DEFAULT);
    $args["role"] = 2;
    
    /*save into db*/
    if (!parent::save($args)) {
      self::$errors[] = "Registeration failed, kindly try again later after some time.";
      return 0;
    }
    
    return 1;
  }

  public static function login ($args) {
    $email = $args["emails"];
    $password = $args["hashed_password"];
    
    /*
    use => password_verify($p, $hashed_password)
    */
    // is cookie available => if NOT find user
    // authenticate him/her
    // implant cookie in user's device for 1 WEEK remember

  }

  public function send_verification_email () {
    // only send email when user not verified
    // block the user if asks for more than 5-10 times email verification

  }

  public function validate () {
    /*preg_match('...', valid-string) => returns false*/
    /*preg_match('...', invalid-string) => returns true*/
    $this->errors = [];
    if (preg_match('/[^a-z_\-0-9]/i', $this->username)) {
      $this->errors[] = "Only alpha-numerics (A-Z,a-z,0-9) allowed in username";
    }
    if (preg_match('/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i', $this->email)) {
      $this->errors[] = "Invalid email address";
    }
  }
  
  protected function find_by_email (string $email) {
//    $sql = sprintf("SELECT email FROM users WHERE email=%s LIMIT 1", self::database->escape_string($email));
//    $result = self::database->query($sql);
    
    return $result;
  }

  /**
   * Create route & controller to check wheather POST request for email verification succeed or not
   * this must be different for each user like, 
   * POST user/verify/{key} 
   */

  // public function 
  
}