
function validateData() {

    let username = document.forms["loginForm"]["username"].value;
    let password = document.forms["loginForm"]["password"].value;
    if (username === ''){
        alert('Username is required');
        return false;
    }
    if (password === '' || password.length < 8){
        alert('Password is required and shouldn\'t be less than 8 chars ');
        return false;
    }
    return true;

}