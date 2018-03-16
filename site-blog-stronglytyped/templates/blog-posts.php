<?php
if($input->urlSegment1 == "rss") {
	include("rss.php");
	return;
}

include('blog-head.php');

$addSel = "";

if( preg_match('/^\d{4}-\d\d$/', $input->urlSegment1) ) {

	list($year, $month) = explode('-', $input->urlSegment1);

	$startDT = DateTime::createFromFormat('Y-m-d H:i:s', "$year-$month-01 00:00:00");
	$startTS = $startDT->getTimestamp();
	$endDT   = $startDT->add(new DateInterval("P1M"))->sub(new DateInterval("PT1S"));
	$endTS   = $endDT->getTimestamp();
	
	$addSel = "blog_date>=$startTS, blog_date<=$endTS, ";

} else if( preg_match('/^\d{4}-\d\d-\d\d$/', $input->urlSegment1) ) {

	list($year, $month, $day) = explode('-', $input->urlSegment1);

	$startTS = DateTime::createFromFormat('Y-m-d H:i:s', "$year-$month-$day 00:00:00")->getTimestamp();
	$endTS   = DateTime::createFromFormat('Y-m-d H:i:s', "$year-$month-$day 23:59:59")->getTimestamp();
	
	$addSel = "blog_date>=$startTS, blog_date<=$endTS, ";
	
}

?>

			<!-- Main -->
				<div id="main-wrapper">
					<div id="main" class="container">
						<div class="row">

<?php

if($blogSettings->blog_sidebar_right) {
	include("blog-articlelist.php");
	include("blog-sidebar.php");
} else {
	include("blog-sidebar.php");
	include("blog-articlelist.php");
}

?>
						</div>
					</div>
				</div>

<?php include('blog-footer.php'); ?>
