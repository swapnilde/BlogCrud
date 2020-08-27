<?php
	require 'classes/Database.php';
	include 'classes/Operation.php';
	include 'includes/header.php';

	$db = Database::getInstance();
	$conn = $db->getConnection();

	$operation = new Operation($conn);

	if(isset($_POST['save-post'])){
		$newTitle = $_POST['new-title'];
		$newAuthor = $_POST['new-author'];
		$newPostContent = $_POST['new-post-content'];
		$insertPostStatus = $operation->insertPosts($newTitle,$newAuthor,$newPostContent);
		echo $insertPostStatus;
	}

	if(isset($_POST['update-post'])){
		$updateId = $_POST['update-id'];
		$updateTitle = $_POST['update-title'];
		$updateAuthor = $_POST['update-author'];
		$updatePostContent = $_POST['update-post-content'];
		$updatePostStatus = $operation->updatePosts($updateId,$updateTitle,$updateAuthor,$updatePostContent);
		echo $updatePostStatus;
	}

	if(isset($_POST['d'])){

		$deleteId = $_POST['d'];
		$deletePostStatus = $operation->deletePosts($deleteId);
		echo $deletePostStatus;
	}




?>
<div class="topnav" id="myTopnav">
	<a href="/BlogApp/home.php"><button type="button" class="btn btn-primary">Home</button></a>
<!--	<a href="#news">News</a>-->
<!--	<a href="#contact">Contact</a>-->
<!--	<a href="#about">About</a>-->
		<a><button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#add-post">Add Post</button></a>
		<a href="logout.php"><button type="button" class="btn btn-light btn-sm">Logout</button></a>
		<a href="javascript:void(0);" class="icon" id="nav-tog-btn" ><i class="fa fa-bars"></i></a>
</div>
<div class="post-list-wrapper container">
	<h1> You Got to Home! </h1>

		<?php
			$posts = $operation->getPosts();
			while($row = $posts->fetch_assoc()){ ?>
<div class="card">
	<div class="card-body">
		<h5 class="card-title"><?php echo $row['title'] ?></h5>
		<p class="card-text">
			<small class="text-muted">By: <?php echo $row['author'] ?> | </small>
			<small class="text-muted"><?php echo $row['date_posted'] ?></small>
		</p>
		<p class="card-text"><?php echo $row['body'] ?></p>
	</div>
	<div class="card-footer">
		<small class="text-muted">
			<button class="badge badge-dark" data-toggle="modal" data-target="#id<?php echo $row['id'] ?>">Edit</button>
			<button id="delete-btn" class="badge badge-danger" value="<?php echo $row['id'] ?>" onclick="deleteReq(this)">Delete</button>
		</small>
	</div>
</div>
<div class="modal fade" id="id<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Update The Post</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" id="update-post-form" class="needs-validation" novalidate>
					<input type="hidden" id="update-id" name="update-id" value="<?php echo $row['id'] ?>">
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<label for="update-title">Post Title</label>
							<input type="text" class="form-control" id="update-title" name="update-title" placeholder="Title of the post" value="<?php echo $row['title'] ?>" required>
							<div class="invalid-feedback">
								Please enter a title.
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<label for="update-author">Author</label>
							<input type="text" class="form-control" id="update-author" name="update-author" placeholder="Post author's name" value="<?php echo $row['author'] ?>" required>
							<div class="invalid-feedback">
								Please enter a author name.
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<label for="update-post-content">Post Content</label>
							<input type="text" class="form-control" id="update-post-content" name="update-post-content" placeholder="Content of the post" value="<?php echo $row['body'] ?>" required>
							<div class="invalid-feedback">
								Please enter post content.
							</div>
						</div>
					</div>
					<button id="update-post" name="update-post" class="btn btn-primary" type="submit">Update Post</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
			<?php }
		?>

</div>

<div class="modal fade" id="add-post" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Add New Post</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="home.php" id="save-post-form" class="needs-validation" novalidate>
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<label for="new-title">Post Title</label>
							<input type="text" class="form-control" name="new-title" id="new-title" placeholder="Title of the post" value="" required>
							<div class="invalid-feedback">
								Please enter a title.
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<label for="new-author">Author</label>
							<input type="text" class="form-control" name="new-author" id="new-author" placeholder="Post author's name" value="" required>
							<div class="invalid-feedback">
								Please enter a author name.
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-12 mb-3">
							<label for="new-post-content">Post Content</label>
							<input class="form-control" name="new-post-content" id="new-post-content" placeholder="Content of the post" value="" required>
							<div class="invalid-feedback">
								Please enter post content.
							</div>
						</div>
					</div>
					<button id="save-post" name="save-post" class="btn btn-primary" type="submit">Save Post</button>
					<button type="reset" class="btn btn-light"> Reset</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<?php
	include 'includes/footer.php';

