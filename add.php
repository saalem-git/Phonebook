<?php
include ('conn.php');
include('type.php');

//This stores the form fields that failed validation. Initially empty.
$fname = $lname = $number = $category = "";
//This stores all the field names to be processed
$errors = array(
    'fname' => '',
    'lname' => '',
    'number' => '',
    'category' => ''
);

//Below code block is to check if post have vlaue.
if (isset($_POST['submit']))
{

    // Check First Name
    if (empty($_POST['contact_fname']))
    {
        $errors['fname'] = 'First name is required';
    }
    else
    {
        $fname = $_POST['contact_fname'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $fname))
        {
            $errors['fname'] = 'First name is only letter and space';
        }
    }

    // Check Last Name
    if (empty($_POST['contact_lname']))
    {
        $errors['lname'] = 'Last name is required';
    }
    else
    {
        $lname = $_POST['contact_lname'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $lname))
        {
            $errors['lname'] = 'Last name is only letter and space';
        }

        // escape sql chars
        $fname = mysqli_real_escape_string($conn, $_POST['contact_fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['contact_lname']);
        $number = mysqli_real_escape_string($conn, $_POST['contact_number']);
        $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

        // create sql
        $sql = "INSERT INTO contact (category_id, contact_fname, contact_lname, contact_number) values ('$category_id', '$fname', '$lname', '$number')";

        // save to db and check
        if (mysqli_query($conn, $sql))
        {
            // success
            header('Location: index.php');
        }
        else
        {
            echo 'query error: ' . mysqli_error($conn);
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en">
   <?php include('header.php'); ?>
   <div class="container add">
      <form class="white" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
         <div class="form-group">
            <label>First Name</label>
            <input class="form-control" type="text" name="contact_fname" value="<?php echo htmlspecialchars($fname) ?>">
            <div class="err-text"><?php echo $errors['fname']; ?></div>
         </div>
         <div class="form-group">
            <label>Last Name</label>
            <input class="form-control" type="text" name="contact_lname" value="<?php echo htmlspecialchars($lname) ?>">
            <div class="err-text"><?php echo $errors['lname']; ?></div>
         </div>
         <label>Phone Number</label>
         <input required="required" class="form-control" type="number" name="contact_number" value="<?php echo htmlspecialchars($number) ?>">
         <div class="err-text"><?php echo $errors['number']; ?></div>
         <label>Category</label>
         <select required="required"  name="category_id" id="category_id" class="form-control">
            <option value="">Select Category</option>
            <?php echo $output; ?>
         </select>
         <div class="err-text"><?php echo $errors['category']; ?></div>
         <div class="submit-btn">
            <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
         </div>
      </form>
   </div>
   <?php include('footer.php'); ?>
   </body>
</html>