```php
<?php
require('../model/database.php');
require('../model/category.php');
require('../model/category_db.php');
require('../model/product.php');
require('../model/product_db.php');

// Tạo đối tượng CategoryDB và ProductDB
$categoryDB = new CategoryDB();
$productDB = new ProductDB();

// Xác định action
$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');

    if ($action == NULL) {
        $action = 'list_products';
    }
}

// Hiển thị danh sách sản phẩm
if ($action == 'list_products') {

    $category_id = filter_input(
        INPUT_GET,
        'category_id',
        FILTER_VALIDATE_INT
    );

    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }

    $current_category = $categoryDB->getCategory($category_id);

    // Nếu danh mục không tồn tại thì chuyển về danh mục 1
    if ($current_category === null) {
        $category_id = 1;
        $current_category = $categoryDB->getCategory($category_id);
    }

    $categories = $categoryDB->getCategories();

    $products = $productDB->getProductsByCategory($category_id);

    include('product_list.php');

// Xem chi tiết sản phẩm
} else if ($action == 'view_product') {

    $categories = $categoryDB->getCategories();

    $product_id = filter_input(
        INPUT_GET,
        'product_id',
        FILTER_VALIDATE_INT
    );

    if ($product_id === false ||
        $product_id === null ||
        $product_id < 1) {

        $error = 'Invalid product ID.';
        include('../errors/error.php');

    } else {

        $product = $productDB->getProduct($product_id);

        if ($product === null) {
            $error = 'Product not found.';
            include('../errors/error.php');
        } else {
            include('product_view.php');
        }
    }
}
?>
```