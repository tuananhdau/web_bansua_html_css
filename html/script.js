document.addEventListener("DOMContentLoaded", function () {
    // Lấy các phần tử từ DOM
    const emailInput = document.querySelector("input[type='email']");
    const passwordInput = document.querySelector("input[type='password']");
    const loginButton = document.getElementById("cc");

    // Xử lý sự kiện khi nhấn vào nút Đăng Nhập
    loginButton.addEventListener("click", function (event) {
        event.preventDefault(); // Ngăn form tự động submit

        const email = emailInput.value.trim();
        const password = passwordInput.value.trim();

        // Kiểm tra xem các trường có được nhập không
        if (email === "" || password === "") {
            alert("Vui lòng nhập đầy đủ email và mật khẩu!");
            return;
        }

        // Kiểm tra định dạng email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Email không hợp lệ. Vui lòng nhập đúng định dạng!");
            return;
        }

        // Kiểm tra độ dài mật khẩu
        if (password.length < 6) {
            alert("Mật khẩu phải có ít nhất 6 ký tự!");
            return;
        }

        // Giả lập đăng nhập thành công
        alert("Đăng nhập thành công!");
        window.location.href = "dashboard.html"; // Chuyển hướng sau khi đăng nhập
    });
});
