<? $extends('layouts/master.php') ?>

<? $section('content') ?>
	<p>This is the child content.</p>
	@parent
<? $end() ?>