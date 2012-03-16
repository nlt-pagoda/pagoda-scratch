<?php if ($accessible): ?>

<h1>Student Control Panel</h1>

<h2>Courses</h2>
<ul>
<li><a href="<?php echo BASEPATH; ?>student/view/courses/">My Courses</a></li>
</ul>

<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>