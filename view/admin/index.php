<div id="content">
<?php if ($accessible): ?>

<h1>Admin Control Panel</h1>
<ul>
<li><a href="<?php echo BASEPATH; ?>admin/view/user/">View Users</a></li>
<li><a href="<?php echo BASEPATH; ?>admin/add/user/">Add Users</a></li>
<li><a href="<?php echo BASEPATH; ?>admin/remove/user/">Remove Users</a></li>
<li><a href="<?php echo BASEPATH; ?>admin/edit/user/">Edit User Profile</a></li>
</ul>
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>

</div>