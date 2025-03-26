function register(){
    var name =document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementsByClassName("password").value;
    var user={
        name: name,
        email: email,
        password: password
    };
    var json = JSON.stringify(user);
    localStorage.setItem(name,json);
    alert("Dang Ki Thanh Cong");
    window.location.href="login.html"
}
function login(){
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var mail = localStorage.getItem("email");
    var data =JSON.parse(email);
    if(email==null){
        aler("Vui long nhap pass");
    }else if(email==data.email && password==data.password){
        alert("Đăng Nhập Thành Công")
        window.location.href="./index.html"
    }
    else{
        alert("Đăng Nhập Thất Bại")
    }
}