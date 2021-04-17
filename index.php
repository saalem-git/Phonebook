   <?php
      //We inlcude our database connection
      include('conn.php');
      include('type.php');
      ?>
   <!DOCTYPE html>
   <html lang="en">
      <!-- We include our header -->
      <?php include('header.php'); ?>
      <div class="container">
         <div class="">
            </span>
            <div class="add-container">
               <a href="add.php" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New</a>
            </div>
            <table id="OurData" class="display responsive nowrap" style="width:100%">
               <thead>
                  <tr>
                     <th>Last Name</th>
                     <th>First Name</th>
                     <th>Type</th>
                     <th>Number</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     //We retreive the necessary records using the below query and bind to HTML codes
                        $query=mysqli_query($conn,"SELECT 
                        contact.contact_id,
                        category.category_name, 
                        contact.contact_fname,
                        contact.contact_lname,
                        contact.contact_number FROM contact
                        INNER JOIN category 
                        ON category.category_id = contact.category_id
                        ORDER BY contact.contact_fname DESC");
                        while($row=mysqli_fetch_array($query)){
                        //echo $row['category_name'];
                           ?>
                  <tr>
                     <td><?php echo ($row['contact_lname']); ?></td>
                     <td><?php echo ($row['contact_fname']); ?></td>
                     <td><?php echo ($row['category_name']); ?></td>
                     <td><?php echo ($row['contact_number']); ?></td>
                     <td>
                        <a href="#edit<?php echo $row['contact_id']; ?>" data-toggle="modal" class="btn btn-success ud-btn"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
                        <a href="#del<?php echo $row['contact_id']; ?>" data-toggle="modal" class="btn btn-danger ud-btn"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                     </td>
                        <!-- Delete -->
                        <div class="modal fade" id="del<?php echo $row['contact_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                 </div>
                                 <div class="modal-body">
                                    <?php
                                       $del=mysqli_query($conn,"select * from contact where contact_id='".$row['contact_id']."'");
                                       $drow=mysqli_fetch_array($del);
                                       ?>
                                    <div class="container-fluid">
                                       <h5>Are you sure to delete <strong><?php echo ucwords($drow['contact_fname'].' '.$drow['contact_lname']); ?></strong>?</h5>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                    <a href="delete.php?id=<?php echo $row['contact_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Edit -->
                        <div class="modal fade" id="edit<?php echo $row['contact_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                 </div>
                                 <div class="modal-body">
                                    <?php
                                       $edit=mysqli_query($conn,"select * from contact where contact_id='".$row['contact_id']."'");
                                       $erow=mysqli_fetch_array($edit);
                                       ?>
                                    <div class="container-fluid">
                                       <form method="POST" action="edit.php?id=<?php echo $erow['contact_id']; ?>">
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <label>First Name:</label>
                                             </div>
                                             <div class="col-lg-8">
                                                <input required="required" type="text" name="contact_fname" class="form-control" value="<?php echo $erow['contact_fname']; ?>">
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <label>Last Name:</label>
                                             </div>
                                             <div class="col-lg-8">
                                                <input required="required" type="text" name="contact_lname" class="form-control" value="<?php echo $erow['contact_lname']; ?>">
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <label>Type:</label>
                                             </div>
                                             <div class="col-lg-8">
                                                <select required="required" name="category_id" id="category_id" class="form-control">
                                                   <option value="">Select Type</option>
                                                   <?php echo $output; ?>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-lg-4">
                                                <label>Number:</label>
                                             </div>
                                             <div class="col-lg-8">
                                                <input required="required" type="text" name="number" class="form-control" value="<?php echo $erow['contact_number']; ?>">
                                             </div>
                                          </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                 <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Update</button>
                                 </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </td>
                  </tr>
                  <?php
                     }
                     ?>
               </tbody>
               <tfoot>
                  <tr>
                     <th>Last Name</th>
                     <th>First Name</th>
                     <th>Type</th>
                     <th>Number</th>
                     <th>Action</th>
                  </tr>
               </tfoot>
            </table>
         </div>
      </div>
      <!-- We include our footer -->
      <?php include('footer.php'); ?>
   </html>