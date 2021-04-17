    <?php
    // The below lines code block is to retrieve the category names to be used in inserting in table
    $query = "SELECT * FROM category";
    $result = mysqli_query($conn, $query);
    $output = '';
    while ($row = mysqli_fetch_array($result))
    {
        $output .= '<option value="' . $row["category_id"] . '">' . $row["category_name"] . '</option>';
    }
?>