<?php

class Post
{
	private $error = "";
	public function create_post($userid, $data, $files)
	{
		if (!empty($data['post']) || !empty($files['file']['name'])) {
			
			$myimage = "";
			$has_image = 0;

			if (!empty($files['file']['name'])) {

				$folder = "uploads/" . $userid . "/";

				//create folder
				if (!file_exists($folder)) {
					mkdir($folder,0777,true);
					file_put_contents($folder . "index.php", "");
				}

				$image_class = new Image();
				$myimage = $folder . $image_class->generate_filename(15) . ".jpg";
				move_uploaded_file($_FILES['file']['tmp_name'], $myimage);
				$image_class->resize_image($myimage,$myimage,800,800);

				$has_image = 1;
			}

			$post = addslashes($data['post']);
			$postid = $this->create_postid();

			$query = "insert into posts (userid,postid,post,image,has_image) values ('$userid','$postid','$post','$myimage','$has_image')";
			$DB = new Database();
			$DB->save($query);

		}else{
			$this->error .= "Please type something in post!<br>";
		}
		return $this->error;
	}

	public function get_post($id)
	{
		$query = "select * from posts where userid = '$id' order by id desc";
		$DB = new Database();
		$result = $DB->read($query);

		if ($result) {
			return $result;
		}else{
			return false;
		}
	}

	private function create_postid()
	{
		$length = rand(4,19);
		$number = "";
		for ($i=0; $i < $length; $i++) { 
			$new_rand = rand(0,9);
			$number = $number . $new_rand;
		}
		return $number;
	}

	public function get_one_post($postid)
	{
		if (!is_numeric($postid)) {
			return false;
		}
		$query = "select * from posts where postid = '$postid' limit 1";
		$DB = new Database();
		$result = $DB->read($query);

		if ($result) {
			return $result[0];
		}else{
			return false;
		}
	}

	public function i_own_post($postid,$shwag_userid)
	{
		$query = "select * from posts where postid = '$postid' limit 1";
		$DB = new Database();
		$result = $DB->read($query);

		if (is_array($result)) {
			if ($result[0]['userid'] == $shwag_userid) {
				return true;
			}
		}
		return false;
	}

	public function like_post($id,$type,$shwag_userid)
	{
		if ($type = "post") {

			if ($type == "post") {

				//increment the posts table
				$DB = new Database();

				//save likes details
				$sql = "select * from likes where type='post' && contentid='$id' limit 1";
				$result = $DB->read($sql);

				if (is_array($result)) {
					$likes = json_decode($result[0]['likes'],true);

					$user_ids = array_column($likes, "userid");

					if (!in_array($shwag_userid, $user_ids)) 
					{
						$arr["userid"] = $shwag_userid;
						$arr["date"] = date("Y-m-d H:i:s");

						$likes[] = $arr;
						$likes_string = json_encode($likes);
						$sql = "update likes set likes = '$likes_string' where type = 'post' && contentid = '$id' limit 1";
						$DB->save($sql);

						$sql = "update posts set likes = likes + 1 where postid = '$id' limit 1";
						$DB->save($sql);
					}else{
						$key = array_search($shwag_userid, $user_ids);
						unset($likes[$key]);
						$likes_string = json_encode($likes);
						$sql = "update likes set likes = '$likes_string' where type = 'post' && contentid = '$id' limit 1";
						$DB->save($sql);

						$sql = "update posts set likes = likes - 1 where postid = '$id' limit 1";
						$DB->save($sql);

					}
					
				}else{

					$arr["userid"] = $shwag_userid;
					$arr["date"] = date("Y-m-d H:i:s");
					$arr2[] = $arr;

					$likes = json_encode($arr2);
					$sql = "insert into likes (type,contentid,likes) values ('$type','$id','$likes')";
					$DB->save($sql);

					$sql = "update posts set likes = likes + 1 where postid = '$id' limit 1";
					$DB->save($sql);
				}

			}
		}

	}
	
	public function get_likes($id,$type)
	{
		if ($type == "post" && is_numeric($id)) {
			$DB = new Database();

			//get like details
			$sql = "select * from likes where type='post' && contentid='$id' limit 1";
			$result = $DB->read($sql);

			if (is_array($result)) {
				$likes = json_decode($result[0]['likes'],true);
				return $likes;
			}
		}
		return false;
	}

	public function get_info($id)
	{
		$query = "select * from users where userid = '$id' limit 1";
		$DB = new Database();
		$result = $DB->read($query);

		return $result[0];
	}

	public function edit_word_post($postid, $data)
	{
		$post = addslashes($data);

		$query = "update posts set post = '$post' where postid = '$postid'";
		$DB = new Database();
		$DB->save($query);
		return;

	}

	public function edit_image_post($postid, $files, $userid)
	{
		$folder = "uploads/" . $userid . "/";

		//create folder
		if (!file_exists($folder)) {
			mkdir($folder,0777,true);
			file_put_contents($folder . "index.php", "");
		}

		$image_class = new Image();
		$myimage = $folder . $image_class->generate_filename(15) . ".jpg";
		move_uploaded_file($_FILES['file']['tmp_name'], $myimage);
		$image_class->resize_image($myimage,$myimage,800,800);

		$has_image = 1;
		$query = "update posts set image = '$myimage' where postid = '$postid'";
		$DB = new Database();
		$DB->save($query);
		return;

	}

	public function get_index_info($id)
	{
		$query = "select * from posts where userid != '$id' order by id desc";
		$DB = new Database();
		$result = $DB->read($query);

		return $result;
	}

	public function get_photos_info($id)
	{
		$query = "select * from posts where userid = '$id' order by id desc";
		$DB = new Database();
		$result = $DB->read($query);

		return $result;
	}

	public function get_profile_photos_info($id)
	{
		$query = "select * from users where userid = '$id' limit 1";
		$DB = new Database();
		$result = $DB->read($query);

		return $result[0];
	}

}