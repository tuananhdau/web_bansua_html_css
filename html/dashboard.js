document.addEventListener("DOMContentLoaded", function() {
    window.showSection = function(sectionId) {
        document.querySelectorAll(".section").forEach(section => {
            section.style.display = "none";
        });
        document.getElementById(sectionId).style.display = "block";
    };
});

// Thêm sản phẩm vào danh sách
window.addProduct = function() {
    let name = document.getElementById("productName").value;
    let price = document.getElementById("productPrice").value;

    if (name.trim() === "" || price.trim() === "") {
        alert("Vui lòng nhập đầy đủ thông tin!");
        return;
    }

    let productList = document.getElementById("productList");
    let newItem = document.createElement("li");
    newItem.innerHTML = `${name} - ${price} VND <button onclick="removeProduct(this)">Xóa</button>`;
    productList.appendChild(newItem);

    // Cập nhật tổng doanh thu
    let currentRevenue = parseInt(document.getElementById("totalRevenue").innerText);
    document.getElementById("totalRevenue").innerText = currentRevenue + parseInt(price);

    // Reset input
    document.getElementById("productName").value = "";
    document.getElementById("productPrice").value = "";
};

// Xóa sản phẩm
window.removeProduct = function(button) {
    let item = button.parentElement;
    item.remove();
};
