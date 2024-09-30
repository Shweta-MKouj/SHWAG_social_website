<?php

include("classes/autoload.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['shwag_userid']);


$a["x"] = "meow";
$a["y"] = "bow";

$arr2[0] = $a;

$a["x"] = "bown";
$a["y"] = "hohoho";

$arr2[1] = $a;

$a["x"] = "groww";
$a["y"] = "hadrun";

$arr2[2] = $a;

$id = 787183;

$sql = "select likes from likes where type='post' && contentid = '$id' limit 1";
$DB = new Database();
$result = $DB->read($sql);
$likes = json_decode($result[0]['likes'],true);
//$user_ids = array_column($likes,"userid");

echo $likes;

//echo "<pre>";
//print_r($likes);
//echo "</pre>";

//$needle = 44835309441151;
//$user_ids = array_search($needle, array_column($result, "userid"));
//echo $user_ids;


			$sql = "select likes from likes where type='post' && contentid = '$id' limit 1";
			$DB = new Database();
			$result = $DB->read($sql);

			if (!empty($result)) {
				//$likess = json_decode($result,true);
				$needle = $shwag_userid;
				$user_ids = array_search($needle, array_column($result, "userid"));

				if (empty($user_ids)) {
					$arr["userid"] = $shwag_userid;
					$arr["date"] = date("Y-m-d H:i:s");
					$arr2[] = $arr;

					$like_string = json_encode($arr2);
					$sql = "update likes set likes = '$like_string' where type='post' && contentid = '$id' limit 1";
					$DB->save($sql);

					//increment the posts table for likes
					//$sql = "update posts set likes = likes + 1 where postid = '$id' limit 1";
					//$DB->save($sql);

				}else{
					return false;
				}
			}else{
				$arr["userid"] = $shwag_userid;
				$arr["date"] = date("Y-m-d H:i:s");
				$arr2[] = $arr;

				$like_string = json_encode($arr2);
				$sql = "insert into likes (type,contentid,likes) values ('$type','$id','$like_string')";
				$DB->save($sql);

				//increment the posts table for likes
				$sql = "update posts set likes = likes + 1 where postid = '$id' limit 1";
				$DB->save($sql);
			}

		}
