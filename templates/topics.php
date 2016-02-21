<?php include 'includes/header.php'; ?>

<ul id="topics">
	<?php if(isset($topics)) : ?>
	<?php foreach($topics as $topic) : ?>
	<li class="topic">
			<div class="row">
			<div class="col-md-2">
				<img class="avatar pull-left" src="images/<?php print urlFormat($topic->profile); ?>" />
			</div>
			<div class="col-md-10">
				<div class="topic-content pull-right">
					<h3><a href="topic.php?id=<?php print urlFormat($topic->id); ?>"><?php print $topic->title; ?></a></h3>
					<div class="topic-info">
						<a href="category.php?category=<?php print urlFormat($topic->category_id); ?>"><?php print $topic->name; ?></a> > 
						<a href="topics.php?user=<?php print urlFormat($topic->user_id); ?>"><?php print $topic->username; ?></a> > 
						Posted on: <?php print formatDate($topic->create_date); ?>
						<span class="badge pull-right"><?php print replyCount($topic->id); ?></span>
					</div>
				</div>
			</div>
		</div>
	</li>
	<?php endforeach ; ?>
	<?php else : ?>
	<h1>No Topics have been found :(</h1>
	<?php endif; ?>
</ul>
<h3>Forum Statistics</h3>
<ul>
	<li>Total Number of Users: <strong>52</strong></li>
	<li>Total Number of Topics: <strong><?php print $totalTopics; ?></strong></li>
	<li>Total Number of Categories: <strong><?php print $totalCategories; ?></strong></li>
</ul>

<?php include 'includes/footer.php'; ?>