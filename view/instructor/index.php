<?php if ($accessible): ?>

<h1>Instructor Control Panel</h1>

<ul>
<li><a href="<?php echo BASEPATH; ?>instructor/view/courses/">Courses</a></li>
<li><a href="<?php echo BASEPATH; ?>instructor/view/rubrics/">Rubrics</a></li>
</ul>

<?php else: 
$this->RenderMsg("You do not have sufficient privileges to view this page!"); ?>
<?php endif ?>