<?php if ($accessible): ?>

<h1>Admin Control Panel</h1>

<h2>Users</h2>
<ul>
<li><a href="<?php echo BASEPATH; ?>admin/view/user/">View Users</a></li>
<li><a href="<?php echo BASEPATH; ?>admin/add/user/">Add Users</a></li>
<li><a href="<?php echo BASEPATH; ?>admin/edit/user/">Edit User Profile</a></li>
<li><a href="<?php echo BASEPATH; ?>admin/remove/user/">Remove Users</a></li>
</ul>

<h2>Students</h2>
<ul>
<li><a href="<?php echo BASEPATH; ?>admin/add/student/">Enroll Students in courses</a></li>
</ul>

<h2>Courses</h2>
<ul>
<li><a href="<?php echo BASEPATH; ?>admin/view/courses/">View Courses</a></li>
<li><a href="<?php echo BASEPATH; ?>admin/add/course/">Add Courses</a></li>
<li><a href="<?php echo BASEPATH; ?>admin/edit/course/">Edit Course Info</a></li>
<li><a href="<?php echo BASEPATH; ?>admin/remove/course/">Remove Courses</a></li>
</ul>

<h2>Headlines/Announcements</h2>
<ul>
<li><a href="<?php echo BASEPATH; ?>admin/add/department/">Add Department</a></li>
</ul>

<h2>Headlines/Announcements</h2>
<ul>
<li><a href="<?php echo BASEPATH; ?>main/view/headlines/">View Headlines</a></li>
<li><a href="<?php echo BASEPATH; ?>admin/add/announcement/">Add Headline To Main Page</a></li>
</ul>
	
<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>