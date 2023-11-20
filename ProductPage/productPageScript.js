

var productImage = ["productPhotos/Beans.WEBP", "productPhotos/Fishes.jpg", "productPhotos/bread.jpg", "productPhotos/lettuce.AVIF",
    "productPhotos/lentils.jpg", "productPhotos/potatoes.jpg"];
var productName = ["Beans", "Fishes", "baked goods", "lettuce", "lentils", "potatoes"];
var productProviderName = ["Abdulrahman Sadeq", "Saif Hamad", "Rashid Khalil", "Meera Ali", "Nasser Omar", "Noura Talal"];
var productQuantity = [22, 7, 13, 30, 10, 15];
var productPrice = [150, 250, 100, 450, 700, 89];

var x = 0;
var numberOfProducts = (parseInt(productName.length) / 2);


for (var i = 0; i < numberOfProducts; i++) {

    document.writeln("<div class='column'>" +
        "<div class='left_product'>" +
        "<div class='pImage'><img src='" + productImage[x] + "'></div>" +
        "<div class='product_info'>" +
        "<div class='pName'>Product Name: " + productName[x] + "</div>" +
        "<div class='pProviderName'>Provider Name: " + productProviderName[x] + "</div>" +
        "<div class='pQuantity'>Product Quantity: " + productQuantity[x] + " KG</div>" +
        "<div class='pPrice'>Product Price: " + productPrice[x] + " AED</div>" +
        "<div class='buttons'><button>Request</button><button>Add to list</button>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "<div class='right_product'>" +
        "<div class='pImage'><img src='" + productImage[x + 1] + "'></div>" +
        "<div class='product_info'>" +
        "<div class='pName'>Product Name: " + productName[x + 1] + "</div>" +
        "<div class='pProviderName'>Provider Name: " + productProviderName[x + 1] + "</div>" +
        "<div class='pQuantity'>Product Quantity: " + productQuantity[x + 1] + " KG</div>" +
        "<div class='pPrice'>Product Price: " + productPrice[x + 1] + " AED</div>" +
        "<div class='buttons'><button>Request</button><button>Add to list</button>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>");

    x += 2;
}
