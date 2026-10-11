
<?php
class Product {
    private $category;
    private $id;
    private $code;
    private $name;
    private $price;

    // Constructor không có tham số
    public function __construct() {
        $this->category = null;
        $this->id = 0;
        $this->code = '';
        $this->name = '';
        $this->price = 0;
    }

    // Lấy danh mục sản phẩm
    public function getCategory() {
        return $this->category;
    }

    // Thiết lập danh mục sản phẩm
    public function setCategory($value) {
        $this->category = $value;
    }

    // Lấy mã ID sản phẩm
    public function getID() {
        return $this->id;
    }

    // Thiết lập mã ID sản phẩm
    public function setID($value) {
        $this->id = $value;
    }

    // Lấy mã sản phẩm
    public function getCode() {
        return $this->code;
    }

    // Thiết lập mã sản phẩm
    public function setCode($value) {
        $this->code = $value;
    }

    // Lấy tên sản phẩm
    public function getName() {
        return $this->name;
    }

    // Thiết lập tên sản phẩm
    public function setName($value) {
        $this->name = $value;
    }

    // Lấy giá sản phẩm
    public function getPrice() {
        return $this->price;
    }

    // Định dạng giá với hai chữ số thập phân
    public function getPriceFormatted() {
        return number_format($this->price, 2);
    }

    // Thiết lập giá sản phẩm
    public function setPrice($value) {
        $this->price = $value;
    }

    // Lấy phần trăm giảm giá
    public function getDiscountPercent() {
        return 30;
    }

    // Tính số tiền được giảm
    public function getDiscountAmount() {
        $discount_percent = $this->getDiscountPercent() / 100;
        $discount_amount = $this->price * $discount_percent;
        $discount_amount_r = round($discount_amount, 2);

        return number_format($discount_amount_r, 2);
    }

    // Tính giá sau giảm
    public function getDiscountPrice() {
        $discount_percent = $this->getDiscountPercent() / 100;
        $discount_price = $this->price * (1 - $discount_percent);

        return number_format($discount_price, 2);
    }

    // Lấy tên file ảnh
    public function getImageFilename() {
        return $this->code . '.png';
    }

    // Lấy đường dẫn ảnh
    public function getImagePath() {
        return '../images/' . $this->getImageFilename();
    }

    // Lấy nội dung mô tả ảnh
    public function getImageAltText() {
        return 'Image: ' . $this->getImageFilename();
    }
}
?>
