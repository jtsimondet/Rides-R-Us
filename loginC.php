function loginC() {
    if(empty($_POST['usernameC'])) {
        $this->HandleError("Username cannot be empty");
        return false;
    }
    if(empty($_POST['passwordC'])) {
        $this->HandleError("Password cannot be empty");
        return false;
    }
    
    $username=trime($_POST['usernameC']);
    $password=trime($_POST['passwordC']);
    
    echo $username;
    echo $password;
    
    
    return true;
}
