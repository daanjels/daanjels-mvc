<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User'); // load the user model
    }

    public function register()
    {
        // define labels
        $description = 'Please fill out this form to register with us';
        $lblname = 'Name:';
        $lblemail = 'Email:';
        $lblpassword = 'Password:';
        $lblconfirm = 'Confirm password:';
        // check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
            // sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // init data
            $data = [
                'title'         => 'Register user',
                'description'   => $description,
                'name'          => trim($_POST['name']),
                'email'         => trim($_POST['email']),
                'password'      => trim($_POST['password']),
                'confirm'       => trim($_POST['confirm']),
                'name_error'    => $lblname,
                'email_error'   => $lblemail,
                'password_error'=> $lblpassword,
                'confirm_error' => $lblconfirm,
            ];

            // validate name
            if(empty($data['name'])) {
                $data['name_error'] = 'Please enter name';
            }
            // validate email
            if(empty($data['email'])) {
                $data['email_error'] = 'Please enter email';
            } else {
                // check if the email exists
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_error'] = 'Email is already taken';
                }
            }
            // validate password
            if(empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Password must be at least 6 characters';
            }
            // validate confirm
            if(empty($data['confirm'])) {
                $data['confirm_error'] = 'Please confirm password';
            } else {
                if (($data['password']) != $data['confirm']) {
                $data['confirm_error'] = ' Passwords do not match';
                }
            }
            // make sure there are no errors (same as defined labels)
            if (
                $data['name_error'] == $lblname && 
                $data['email_error'] == $lblemail && 
                $data['password_error'] == $lblpassword && 
                $data['confirm_error'] == $lblconfirm
                ) {
                // validated
                // hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // register user
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can log in.'); // set the flash message
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }

            } else {
                // load view with errors
                $this->view('users/register', $data);
            }

        } else {
            // coming in without POST
            // init data
            $data = [
                'title'         => 'Register user',
                'description'   => $description,
                'name'          => '',
                'email'         => '',
                'password'      => '',
                'confirm'       => '',
                'name_error'    => $lblname,
                'email_error'   => $lblemail,
                'password_error'=> $lblpassword,
                'confirm_error' => $lblconfirm,
            ];

            // load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // define labels
        $lblemail = 'Email:';
        $lblpassword = 'Password:';

        // check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
            // sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // init data
            $data = [
                'title'         => 'User Login',
                'email'         => trim($_POST['email']),
                'password'      => trim($_POST['password']),
                'email_error'   => $lblemail,
                'password_error'=> $lblpassword,
            ];

            // validate email
            if(empty($data['email'])) {
                $data['email_error'] = 'Please enter email';
            }
            // if ($this->userModel->findUserByEmail($data['email'])) {
                // user found
            // } else {
            if (!$this->userModel->findUserByEmail($data['email'])) {
                // user not found
                $data['email_error'] = 'No user found with this email';
            }

            // validate password
            if(empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Password must be at least 6 characters';
            }
            // make sure errors are empty
            if (
                $data['email_error'] == $lblemail && 
                $data['password_error'] == $lblpassword
                ) {
                    // validated
                    // check and set logged in user
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                    if($loggedInUser) {
                        // if the password matches let's create a session
                        $this->createUserSession($loggedInUser);
                    } else {
                        // if the password is incorrect
                        $data['password_error'] = 'Password incorrect';
                        $this->view('users/login', $data);
                    }
            } else {
                // load view with errors
                $this->view('users/login', $data);
            }

        } else {
            // init data
            $data = [
                'title'         => 'User login',
                'email'         => '',
                'password'      => '',
                'email_error'   => $lblemail,
                'password_error'=> $lblpassword,
            ];

            // load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user) 
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('index');
    }

    public function logout() 
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}