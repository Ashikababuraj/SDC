<?php
include "../config/db.php";

$category_id = $_POST['category_id'];

$result = mysqli_query($conn,
    "SELECT * FROM subcategories 
     WHERE category_id='$category_id' AND status=1"
);

echo '<option value="">Select Subcategory</option>';

while($row = mysqli_fetch_assoc($result)){
    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
}
