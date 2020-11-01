<span style="color: green;"><?php echo $this->session->flashdata('success'); ?></span>
<table class="table table-striped table-bordered">
   <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Phone</th>
      <th>Date of Birth</th>
      <th>Country</th>
      <th>Email</th>
      <th>Status</th>
      <th align="center" colspan="2">Action</th>
   </tr>
   <?php foreach ($data as $usr) {
      ?>
   <tr>
      <td><?php echo $usr->firstname; ?></td>
      <td><?php echo $usr->lastname; ?></td>
      <td><?php echo $usr->phone; ?></td>
      <td><?php echo $usr->dob; ?></td>
      <td><?php echo $usr->country; ?></td>
      <td><?php echo $usr->email; ?></td>
      <td>
         <?php if($usr->status==1){?>
            <b class="text-success">Active</b>
         <?php } else {?>
            <b class="text-warning">Pending</b>
         <?php } ?>
      </td>
      <td><a href="<?php echo base_url('welcome/edituser/'.$usr->id); ?>">Edit</a></td>
      <td><a href="<?php echo base_url('welcome/deluser/'.$usr->id); ?>" onclick="return confirm('Delete ?')">Delete</a></td>
   </tr>
   <?php } ?>
</table>
<ul class="pagination">
   <?php echo $this->pagination->create_links();?>
</ul>
