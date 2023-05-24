<?php 
use PHPMailer\PHPMailer\PHPMailer;
require_once "../../libraries/vendor/autoload.php";
// Auth Api Function
function CreateUser($data){
    $query = "INSERT INTO users (username,email,password,status) VALUES ('$data->username','$data->email','$data->password','unblock') RETURNING id";
    $insert = pg_query($data->conn, $query);
        if($insert){
            $row = pg_fetch_row($insert);
            $last_id = $row[0];
            return array(
                "id"=>$last_id,
                "email"=>$data->email,
                "username"=>$data->username,
                "password"=>$data->password,
            );
        }
        return false;
}
function searchByEmail($data){
    $query = "SELECT * FROM users WHERE email='$data->email'";
    $result = pg_query($data->conn, $query);
    if ($result) {
        return pg_fetch_assoc($result);
    }
    return array();
    }
function searchById($data){
    $query = "SELECT * FROM users WHERE id='$data->id'";
    $result = pg_query($data->conn, $query);
    if ($result) {
        return pg_fetch_assoc($result);
    }
    return array();
    }
function GetUserStatus($data){
    $query4 = "SELECT * FROM users WHERE id='$data->id'";
    $result4 = pg_query($data->conn, $query4);
    if ($result4) {
        $row5 = pg_fetch_assoc($result4);
        $status = $row5["status"];
        if ($status == null || $status == 'active') {
            $return = "Active";
            return array(
                "status" => true,
                "user" => $return
            );
        }else {
            $return = "Inactive";
            return array(
                "status" => true,
                "user" => $return
            );
        }
        
    }
    return array();
    }
    function updatePassword($data){
        $query = "UPDATE users SET
        password = '$data->password'
        WHERE email = '$data->email'";
        $upload = pg_query($data->conn, $query);
        if($upload){
            return true;
        }
            return false;
        }
    function saveOTP($data){
        $query = "UPDATE users SET
        OTP = '$data->code'
        WHERE email = '$data->email'";
        $upload = pg_query($data->conn, $query);
        if($upload){
            return true;
        }
            return false;
        }
    function resetOTP($data){
        $query = "UPDATE users SET
        otp = null
        WHERE email = '$data->email'";
        $upload = pg_query($data->conn, $query);
        if($upload){
            return true;
        }
            return false;
        }
    function updateProfile($data){
        $query = "UPDATE users SET
        username = '$data->username',
        referral_code = '$data->referral_code',
        city = '$data->city',
        country = '$data->country'
        WHERE id = '$data->id'";
        $upload = pg_query($data->conn, $query);
        if($upload){
            return true;
        }
            return false;
        }
        function GetUsers($data){
            $query = "SELECT * FROM users";
            $result = pg_query($data->conn, $query);
            if ($result) {
                $arr = array();
                 while($r =pg_fetch_assoc($result)){
                    $arr[] = $r;
                 }
                 return $arr;
            }
            return array();
            }
            function sendMail($data){
                try {
                //SMTP Settings
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "ofertasv123@gmail.com"; //enter you email address
                $mail->Password = 'eaomaxyylcgxgbau'; //enter you email password
                $mail->Port = 465;
                $mail->SMTPSecure = "ssl";
                //Email Settings
                $mail->isHTML(true);
                $mail->setFrom("ofertasv123@gmail.com");
                $mail->addAddress($data->email); //enter you email address
                $mail->Subject = ("$data->subject");
                $mail->Body = $data->body;
                $mail->send();
            } catch (Exception $e) {
                echo $e->errorMessage(); //Pretty error messages from PHPMailer
              } catch (Exception $e) {
                echo $e->getMessage(); //Boring error messages from anything else!
              }
                 
           }
        // Promo Code
function GetPromoCode($data){
    $query = "SELECT * FROM promo_codes WHERE status = 'active'";
    $result = pg_query($data->conn, $query);
    if ($result) {
        $row = array();
        while($data = pg_fetch_assoc($result)){
            $row[] = [
                    'id'=>$data["id"],
                    'promo_code'=>$data["code"],
                    'expire_date'=>$data["expire_date"],
                    'discount'=>$data["discount"],
                    'created_at'=>$data["created_at"],
            ];
        }
        return $row;;
    }
    return array();
    }
function GetTermsAndCondition($data){
$query = "SELECT * FROM terms_conditions WHERE status='active'";
$result = pg_query($data->conn, $query);
if ($result) {
    $data = pg_fetch_assoc($result);
        $row = [
            'status'=>true,
            'TermsAndCondition'=>$data["terms_and_condition"]
        ];
    }
    return $row;;
}
function GetPrivacyPolicy($data){
$query = "SELECT * FROM privacy_policy WHERE status='active'";
$result = pg_query($data->conn, $query);
if ($result) {
    $row = array();
    while($data = pg_fetch_assoc($result)){
        $row[] = $data;
    }
    return $row;
    }
}
// cources
function createVideo($data){
    $query = "INSERT INTO videos (description,title,link) VALUES ('$data->description','$data->title','$data->link') RETURNING id";
    $insert = pg_query($data->conn, $query);
        if($insert){
            $row = pg_fetch_row($insert);
            $last_id = $row[0];
            return array(
                "id"=>$last_id,
                "title"=>$data->title,
                "link"=>$data->link,
                "description"=>$data->description
            );
        }
        return array();
}
function UpdateVideo($data){
    $query = "UPDATE videos SET
    description = '$data->description',
    title = '$data->title',
    link = '$data->link'
    WHERE id = '$data->id'";
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
        return false;
}

function GetVideos($data){
    $query = "SELECT * FROM videos";
    $result = pg_query($data->conn, $query);
    if ($result) {
        $row = array();
        
        while($data = pg_fetch_assoc($result)){
            $link=$data["link"];
            parse_str( parse_url( $link, PHP_URL_QUERY ), $my_array_of_vars );
            if (!empty($my_array_of_vars["v"])) {
                $video = $my_array_of_vars["v"];
            }else {
                $video = "";
            }
            $row[] = [
                'status'=>true,
                'data'=>[
                    'id'=>$data["id"],
                    'title'=>$data["title"],
                    'video_link'=>$data["link"],
                    'link'=>$video,
                    'description'=>$data["description"],
                    'created_at'=>$data["created_at"],
                ]
                
            ];
        }
        return $row;;
    }
    return array();
    }
function GetVideoById($data){
    $query = "SELECT * FROM videos WHERE id =$data->id";
    $result = pg_query($data->conn, $query);
    if ($result) {
        $data = pg_fetch_assoc($result);
        $link=$data["link"];
            parse_str( parse_url( $link, PHP_URL_QUERY ), $my_array_of_vars );
            if (!empty($my_array_of_vars["v"])) {
                $video = $my_array_of_vars["v"];
            }else {
                $video = "";
            }
        $row = [
            'status'=>true,
            'data'=>[
                'id'=>$data["id"],
                'title'=>$data["title"],
                'video_link'=>$data["link"],
                'link'=>$video,
                'description'=>$data["description"],
                'created_at'=>$data["created_at"],
            ]
        ];
        }
        return $row;;
    }
    function searchVideo($data){
        $query = "SELECT * FROM videos WHERE description LIKE '%" .$data->search. "%' OR title LIKE '" .$data->search. "%' ";
        $result = pg_query($data->conn, $query);
        if ($result) {
            $row = array();
            while($data = pg_fetch_assoc($result)){
                $link=$data["link"];
            parse_str( parse_url( $link, PHP_URL_QUERY ), $my_array_of_vars );
            if (!empty($my_array_of_vars["v"])) {
                $video = $my_array_of_vars["v"];
            }else {
                $video = "";
            }
                $row[] = [
                        'id'=>$data["id"],
                        'title'=>$data["title"],
                        'video_link'=>$data["link"],
                        'link'=>$video,
                        'description'=>$data["description"],
                        'created_at'=>$data["created_at"],
                ];
            }
            return $row;;
            }
            return array();
        }
    function deleteVideo($data){
        $query = "DELETE FROM videos WHERE id =" . $data->id;
        $upload = pg_query($data->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    function SaveVideo($data){
        $query = "INSERT INTO saved_videos (user_id,video_id) VALUES ('$data->user_id','$data->video_id') RETURNING id";
        $insert = pg_query($data->conn, $query);
            if($insert){
                $row = pg_fetch_row($insert);
                $last_id = $row[0];
                return array(
                    "id"=>$last_id,
                    "user_id"=>$data->user_id,
                    "video_id"=>$data->video_id,
                );
            }
            return array();
    }
    function UnsaveVideo($data){
        $query = "DELETE FROM saved_videos WHERE user_id =" . $data->user_id . " AND video_id = ".$data->video_id;
        $upload = pg_query($data->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    function GetSavedVideo($data){
        $query = "SELECT * FROM saved_videos WHERE user_id =$data->user_id";
        $result = pg_query($data->conn, $query);
        $row =array();
        while($data2 = pg_fetch_assoc($result)){
            if (!empty($data2)) {
                # code...
                $id = $data2["video_id"];
        $query2 = "SELECT * FROM videos WHERE id =$id";
        $result2 = pg_query($data->conn, $query2);
        if ($result2) {
            $data3 = pg_fetch_assoc($result2);
            if (!empty($data3)) {
                # code...
                $link=$data3["link"];
            parse_str( parse_url( $link, PHP_URL_QUERY ), $my_array_of_vars );
            if (!empty($my_array_of_vars["v"])) {
                $video = $my_array_of_vars["v"];
            }else {
                $video = "";
            }
                $row[] = [
                    'id'=>$data3["id"],
                    'title'=>$data3["title"],
                    'video_link'=>$data3["link"],
                    'link'=>$video,
                    'description'=>$data3["description"],
                    'created_at'=>$data3["created_at"],
            ];
            }
            }
            }
        
        }
        return $row;
            
        }
    function GetSavedStatus($data){
        $query = "SELECT * FROM videos";
        $result = pg_query($data->conn, $query);
        if ($result) {
            $row = array();
            while($data2 = pg_fetch_assoc($result)){
                $id = $data2["id"];
                $user = $data->user_id;
                $query2 = "SELECT * FROM saved_videos WHERE user_id =$user  AND video_id =$id";
                $result2 = pg_query($data->conn, $query2);
                if (pg_num_rows($result2) > 0) {
                    $status = "saved";
                }else{
                    $status = "not_saved";
                }
                $link=$data2["link"];
                parse_str( parse_url( $link, PHP_URL_QUERY ), $my_array_of_vars );
                if (!empty($my_array_of_vars["v"])) {
                    $video = $my_array_of_vars["v"];
                }else {
                    $video = "";
                }
                $row[] = [
                    'status'=>true,
                    'data'=>[
                        'id'=>$data2["id"],
                        'title'=>$data2["title"],
                        'video_link'=>$data2["link"],
                        'link'=>$video,
                        'description'=>$data2["description"],
                        'status'=>$status,
                        'created_at'=>$data2["created_at"],
                    ]
                    
                ];
            }
            return $row;;
        }
        return array();
        }
    // payments
function payament($data){
$query = "INSERT INTO payment (user_id,amount,token) VALUES ('$data->user_id','$data->amount','$data->token')";
$insert = pg_query($data->conn, $query);
if($insert){
    return true;
}
    return false;
}
function createSUbscription($data){
$query = "INSERT INTO subscriptions (user_id,customer_id,client_secret,secret,amount,currency) VALUES ('$data->user_id','$data->customer_id','$data->client_secret','$data->secret','$data->amount','$data->currency')";
$insert = pg_query($data->conn, $query);
if($insert){
    $query2 = "UPDATE users SET
    subscription = 'subscribed'
    WHERE id = '$data->user_id'";
    $upload2 = pg_query($data->conn, $query2);
    if($upload2){
        return true;
    }
}
return false;
}
function CreatePromoCode($data){
$query = "INSERT INTO promo_codes (code,expire_date,discount,status) VALUES ('$data->code','$data->expire_date','$data->discount','active')";
$insert = pg_query($data->conn, $query);
if($insert){
    return true;
}
return false;
}
// recommendation
function createRecommendation($data){
    $query = "INSERT INTO recommendation (description) VALUES ('$data->description') RETURNING id";
    $insert = pg_query($data->conn, $query);
        if($insert){
            $row = pg_fetch_row($insert);
            $last_id = $row[0];
            return array(
                "id"=>$last_id,
                "description"=>$data->description
            );
        }
        return array();
}
function updateRecommendation($data){
    $query2 = "UPDATE recommendation SET
    description = '$data->description'
    WHERE id = '$data->id'";
    $upload2 = pg_query($data->conn, $query2);
    if($upload2){
        return true;
    }
    }
    function DeleteRecomendation($data){
        $query = "DELETE FROM recommendation WHERE id =" . $data->id;
        $upload = pg_query($data->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    function GetRecommendationById($data){
        $query = "SELECT * FROM recommendation WHERE id = $data->id";
        $result = pg_query($data->conn, $query);
        if ($result) {
            $data = pg_fetch_assoc($result);
                $row = [
                    'status'=>true,
                    'data'=>$data
                ];
            }
            return $row;;
        }
    function GetAllRecomendation($data){
        $query = "SELECT * FROM recommendation";
        $result = pg_query($data->conn, $query);
        if ($result) {
            $row=array();
            while($data = pg_fetch_assoc($result)){
                $row[] =$data;
            }
            return $row;
            }
        }
    function GetLicence($data){
        $query = "SELECT * FROM licence WHERE status='active'";
        $result = pg_query($data->conn, $query);
        if ($result) {
            $data = pg_fetch_assoc($result);
                $row = [
                    'status'=>true,
                    'licence'=>$data
                ];
            }
            return $row;;
        }
 
?>