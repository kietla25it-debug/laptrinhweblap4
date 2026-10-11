<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sửa Thể Loại</title>
</head>
<body>
<?php 
include("../connect.php");

// 1. Lấy dữ liệu cũ theo idTL nhận từ URL ($_GET)
if (isset($_GET['idTL'])) {
    $idTL = $_GET['idTL'];
    $sl = "SELECT * FROM theloai WHERE idTL = " . $idTL;
    $results = mysqli_query($connect, $sl);
    $d = mysqli_fetch_array($results);
}
?>

<form action="" method="post" enctype="multipart/form-data" name="form1">
<table align="left" width="400" border="1">
<tr>
    <td align="right">Ten The Loai</td>
    <td><input type="text" name="TenTL" value="<?php echo isset($d['TenTL']) ? $d['TenTL'] : ''; ?>" /></td>
</tr>
<tr>
    <td align="right">Thu Tu</td>
    <td><input type="text" name="ThuTu" value="<?php echo isset($d['ThuTu']) ? $d['ThuTu'] : '0'; ?>" /></td>
</tr>
<tr>
    <td align="right">An Hien</td>
    <td>
        <select name="AnHien">
            <option value="0" <?php if (isset($d['AnHien']) && $d['AnHien'] == 0) echo "selected"; ?>>An</option>
            <option value="1" <?php if (isset($d['AnHien']) && $d['AnHien'] == 1) echo "selected"; ?>>Hien</option>
        </select>
    </td>
</tr>
<tr>
    <td align="right">icon hiện tại</td>
    <td>
        <?php if (!empty($d['icon']) && file_exists("../image/" . $d['icon'])) { ?>
            <img src="../image/<?php echo $d['icon']; ?>" width="40" height="40" />
        <?php } else { echo "Chưa có ảnh"; } ?>
    </td>
</tr>
<tr>
    <td align="right">Chọn icon mới</td>
    <td>
        <input type="file" name="image" id="image" />
        <input type="hidden" name="ten_anh" value="<?php echo isset($d['icon']) ? $d['icon'] : ''; ?>" />
    </td>
</tr>
<tr>
    <td align="right">
        <input type="hidden" name="idTL" value="<?php echo isset($_GET['idTL']) ? $_GET['idTL'] : ''; ?>" />
        <input type="submit" name="Sua" value="Sua" />
    </td>
    <td><input type="reset" name="Huy" value="Huy" /></td>
</tr>
</table>
</form>

<?php
// 2. Xử lý khi nhấn nút "Sua"
if (isset($_POST['Sua'])) {
    $theloai = $_POST['TenTL'];
    $thutu = $_POST['ThuTu'];
    $an = $_POST['AnHien'];
    $key = $_POST['idTL'];

    $ten_file_tai_len = "";
    if (isset($_FILES["image"]["name"])) {
        $ten_file_tai_len = $_FILES["image"]["name"];
    }

    if ($ten_file_tai_len != "") {                  
        $icon = $ten_file_tai_len;
    } else {
        $icon = $_POST['ten_anh'];
    }

    // Cập nhật CSDL
    $sl_update = "UPDATE theloai SET TenTL='$theloai', ThuTu='$thutu', AnHien='$an', icon='$icon' WHERE idTL='$key'";
    
    // Nếu upload ảnh mới -> di chuyển file mới và xóa ảnh cũ
    if ($ten_file_tai_len != "") {
        move_uploaded_file($_FILES['image']['tmp_name'], "../image/" . $ten_file_tai_len);
        $duong_dan_anh_cu = "../image/" . $_POST['ten_anh'];
        if (!empty($_POST['ten_anh']) && file_exists($duong_dan_anh_cu)) {
            unlink($duong_dan_anh_cu);
        }
    }

    if (mysqli_query($connect, $sl_update)) {
        echo "<script language='javascript'>alert('Sửa thành công');";
        echo "location.href='theloai.php';</script>";
    } else {
        echo "Lỗi: " . mysqli_error($connect);
    }
}
?>
</body>
</html>