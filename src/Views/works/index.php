

<br />
<h2 align="center"><a href="#">My Work</a></h2>
<br />
<?php if (isset($_GET['msg'])) {
    if(strcmp($_GET['msg'], 'del') == 0) {
        echo "<p align=\"center\" style='color : #342eff'> Delete success</p>";
    }
}  ?>
<div class="container">
    <button type="button"><a href="<?php echo URL; ?>works/add">Add work<a/></button>
    <br />
    <div id="calendar"></div>
</div>



