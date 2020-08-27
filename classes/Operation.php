<?php


	class Operation {

		private $conn;

		public function __construct($db){
			$this->conn = $db;
		}

		public function getPosts(){
			$sql = "SELECT * FROM posts";
			$posts = $this->conn->query($sql);
			return $posts;
		}

		public function insertPosts($newTitle, $newAuthor, $newPostContent){
			$sql = "INSERT INTO `posts` (`title`,`author`,`body`) VALUES ('$newTitle','$newAuthor','$newPostContent')";
			$inserted = $this->conn->query($sql);
			if($inserted == 1){
				return 'Post Saved';
			}else{
				return 'Post not saved: '. $this->conn->error;
			}

		}

		public function updatePosts($updateId,$updateTitle,$updateAuthor,$updatePostContent){
			$sql = "UPDATE `posts` SET `title` = '$updateTitle', `author` = '$updateAuthor', `body` = '$updatePostContent' WHERE `id` = $updateId";
			$updated = $this->conn->query($sql);
			if($updated == 1){
				return 'Post Updated';
			}else{
				return 'Post not updated: '. $this->conn->error;
			}
		}

		public function deletePosts($deleteId){
			$sql = "DELETE FROM `posts` WHERE `id`=$deleteId";
			$deleted = $this->conn->query($sql);
			if($deleted == 1){
				return 'Post deleted';
			}else{
				return 'Post not deleted: '. $this->conn->error;
			}

		}

	}