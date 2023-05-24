<?php 
function searchByEmail($data){
$query = "SELECT * FROM admin WHERE email='$data->email'";
$result = pg_query($data->conn, $query);
if ($result) {
    return pg_fetch_assoc($result);
}
return array();
}
function resetPassword($data){
$query = "UPDATE admin SET
password = '$data->password'
WHERE email = '$data->email'";
$upload = pg_query($data->conn, $query);
if($upload){
    return true;
}
    return false;
}
function CreateTermsAndCondition($data){
    if ($data->status == 'active') {
        $select = "SELECT * FROM terms_conditions WHERE status = 'active'";
        $upload2 = pg_query($data->conn, $select);
        $TOTAL = pg_num_rows($upload2);
        if ($TOTAL == 1){
            $check =pg_fetch_assoc($upload2);
        $active =$check["id"];
        $query = "UPDATE terms_conditions SET
        status = 'inactive'
        WHERE id = '$active'";
        $upload = pg_query($data->conn, $query);
            if($upload){
                $query = "INSERT INTO terms_conditions (terms_and_condition,status) VALUES ('$data->terms_and_condition','active')";
                $insert = pg_query($data->conn, $query);
                    if($insert){
                        return true;
                    }
            }
        }else {
            $query = "INSERT INTO terms_conditions (terms_and_condition,status) VALUES ('$data->terms_and_condition','active')";
            $insert = pg_query($data->conn, $query);
                if($insert){
                    return true;
                }
        }
    }else {
        $query = "INSERT INTO terms_conditions (terms_and_condition,status) VALUES ('$data->terms_and_condition','inactive')";
        $insert = pg_query($data->conn, $query);
            if($insert){
                return true;
            }
            return false;
    }
    return false;
}
function CreateLicense($data){
    if ($data->status == 'active') {
        $select = "SELECT * FROM licence WHERE status = 'active'";
        $upload2 = pg_query($data->conn, $select);
        $TOTAL = pg_num_rows($upload2);
        if ($TOTAL == 1){
            $check =pg_fetch_assoc($upload2);
        $active =$check["id"];
        $query = "UPDATE licence SET
        status = 'inactive'
        WHERE id = '$active'";
        $upload = pg_query($data->conn, $query);
            if($upload){
                $query = "INSERT INTO licence (agreement,status) VALUES ('$data->terms_and_condition','active')";
                $insert = pg_query($data->conn, $query);
                    if($insert){
                        return true;
                    }
            }
        }else {
            $query = "INSERT INTO licence (agreement,status) VALUES ('$data->terms_and_condition','active')";
            $insert = pg_query($data->conn, $query);
                if($insert){
                    return true;
                }
        }
    }else {
        $query = "INSERT INTO licence (agreement,status) VALUES ('$data->terms_and_condition','inactive')";
        $insert = pg_query($data->conn, $query);
            if($insert){
                return true;
            }
            return false;
    }
    return false;
}
function updateTermsAndCondition($data){
    $query = "INSERT INTO terms_conditions (terms_and_condition,status) VALUES ('$data->terms_and_condition','inactive')";
    $insert = pg_query($data->conn, $query);
        if($insert){
            return true;
        }
        return false;
}
function updateTermsAndCondition2($data){
    if ($data->status == 'active') {
        $select = "SELECT * FROM terms_conditions WHERE status = 'active'";
        $upload2 = pg_query($data->conn, $select);
        $TOTAL = pg_num_rows($upload2);
        $check =pg_fetch_assoc($upload2);
        $active =$check["id"];
        if ($TOTAL == 1 &&  $active == $data->id){
            $query = "UPDATE terms_conditions SET
        terms_and_condition = '$data->terms_and_condition'
        WHERE id = '$data->id'";
        $upload = pg_query($data->conn, $query);
            if($upload){
                return true;
            }
        }else {
            $query = "UPDATE terms_conditions SET
        status = 'inactive'
        WHERE id = ' $active'";
        $upload = pg_query($data->conn, $query);
            if($upload){
                $query3 = "UPDATE terms_conditions SET
                terms_and_condition = '$data->terms_and_condition',
                status = 'active'
                WHERE id = '$data->id'";
                $upload3 = pg_query($data->conn, $query3);
                    if($upload3){
                        return true;
                    }
            }
            # code...
        }
    }else {
        $query3 = "UPDATE terms_conditions SET
        terms_and_condition = '$data->terms_and_condition'
        WHERE id = '$data->id'";
        $upload3 = pg_query($data->conn, $query3);
            if($upload3){
                return true;
            }
    }
    return false;
}
function updateLicense($data){
    if ($data->status == 'active') {
        $select = "SELECT * FROM licence WHERE status = 'active'";
        $upload2 = pg_query($data->conn, $select);
        $TOTAL = pg_num_rows($upload2);
        $check =pg_fetch_assoc($upload2);
        $active =$check["id"];
        if ($TOTAL == 1 &&  $active == $data->id){
            $query = "UPDATE licence SET
        agreement = '$data->terms_and_condition'
        WHERE id = '$data->id'";
        $upload = pg_query($data->conn, $query);
            if($upload){
                return true;
            }
        }else {
            $query = "UPDATE licence SET
        status = 'inactive'
        WHERE id = ' $active'";
        $upload = pg_query($data->conn, $query);
            if($upload){
                $query3 = "UPDATE licence SET
                agreement = '$data->terms_and_condition',
                status = 'active'
                WHERE id = '$data->id'";
                $upload3 = pg_query($data->conn, $query3);
                    if($upload3){
                        return true;
                    }
            }
        }
    }else {
        $query3 = "UPDATE licence SET
        agreement = '$data->terms_and_condition'
        WHERE id = '$data->id'";
        $upload3 = pg_query($data->conn, $query3);
            if($upload3){
                return true;
            }
    }
    return false;
}
function deleteTermsAndCondition($data){
    $query = "DELETE FROM terms_conditions WHERE id =" . $data->id;
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
    return false;
}
function deleteAgreement($data){
    $query = "DELETE FROM licence WHERE id =" . $data->id;
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
    return false;
}
function createPrivacyPolicy($data){
    if ($data->status == 'active') {
        $select = "SELECT * FROM privacy_policy WHERE status = 'active'";
        $upload2 = pg_query($data->conn, $select);
        $TOTAL = pg_num_rows($upload2);
        if ($TOTAL == 1){
            $check =pg_fetch_assoc($upload2);
        $active =$check["id"];
        $query = "UPDATE privacy_policy SET
        status = 'inactive'
        WHERE id = '$active'";
        $upload = pg_query($data->conn, $query);
            if($upload){
                $query = "INSERT INTO privacy_policy (policy,status) VALUES ('$data->terms_and_condition','active')";
                $insert = pg_query($data->conn, $query);
                    if($insert){
                        return true;
                    }
            }
        }else {
            $query = "INSERT INTO privacy_policy (policy,status) VALUES ('$data->terms_and_condition','active')";
            $insert = pg_query($data->conn, $query);
                if($insert){
                    return true;
                }
        }
    }else {
        $query = "INSERT INTO privacy_policy (policy,status) VALUES ('$data->terms_and_condition','inactive')";
        $insert = pg_query($data->conn, $query);
            if($insert){
                return true;
            }
            return false;
    }
    return false;
}
function updatePolicy($data){
    if ($data->status == 'active') {
        $select = "SELECT * FROM privacy_policy WHERE status = 'active'";
        $upload2 = pg_query($data->conn, $select);
        $TOTAL = pg_num_rows($upload2);
        $check =pg_fetch_assoc($upload2);
        $active =$check["id"];
        if ($TOTAL == 1 &&  $active == $data->id){
            $query = "UPDATE privacy_policy SET
        policy = '$data->terms_and_condition'
        WHERE id = '$data->id'";
        $upload = pg_query($data->conn, $query);
            if($upload){
                return true;
            }
        }else {
            $query = "UPDATE privacy_policy SET
        status = 'inactive'
        WHERE id = ' $active'";
        $upload = pg_query($data->conn, $query);
            if($upload){
                $query3 = "UPDATE privacy_policy SET
                policy = '$data->terms_and_condition',
                status = 'active'
                WHERE id = '$data->id'";
                $upload3 = pg_query($data->conn, $query3);
                    if($upload3){
                        return true;
                    }
            }
        }
    }else {
        $query3 = "UPDATE privacy_policy SET
        policy = '$data->terms_and_condition'
        WHERE id = '$data->id'";
        $upload3 = pg_query($data->conn, $query3);
            if($upload3){
                return true;
            }
    }
    return false;
}
function deletePrivacy($data){
    $query = "DELETE FROM privacy_policy WHERE id =" . $data->id;
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
    return false;
}
function createVideo($data){
    $query = "INSERT INTO videos (description,title,link) VALUES ('$data->description','$data->title','$data->link')";
    $insert = pg_query($data->conn, $query);
        if($insert){
            return true;
        }
        return false;
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
function deleteVideo($data){
    $query = "DELETE FROM videos WHERE id =" . $data->id;
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
    return false;
}
// Manage User
function createUser($data){
    $query = "INSERT INTO users (email,password,city,country,referral_code) VALUES ('$data->email','$data->password','$data->city','$data->country','$data->referral_code')";
    $insert = pg_query($data->conn, $query);
        if($insert){
            return true;
        }
        return false;
}
function UpdateUser($data){
    $query = "UPDATE admin SET
    email = '$data->email',
    nameuser = '$data->username',
    dob = '$data->dob',
    gender = '$data->gender'
    WHERE id = '$data->id'";
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
        return false;
}
function deleteUser($data){
    $query = "DELETE FROM users WHERE id =" . $data->id;
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
    return false;
}
function blockUser($data){
    $query = "UPDATE users SET
    status = 'block'
    WHERE id = '$data->id'";
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
        return false;
}
function activeUser($data){
    $query = "UPDATE users SET
    status = 'unblock'
    WHERE id = '$data->id'";
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
        return false;
}
// promo code
function createPromo($data){
    $query = "INSERT INTO promo_codes (code,expire_date,discount,status) VALUES ('$data->code','$data->date','$data->discount','active')";
    $insert = pg_query($data->conn, $query);
        if($insert){
            return true;
        }
        return false;
}
function EditPromo($data){
    $query = "UPDATE promo_codes SET
    code = '$data->code',
    expire_date = '$data->date',
    discount = '$data->discount'
    WHERE id = '$data->id'";
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
        return false;
}
function blockPromo($data){
    $query = "UPDATE promo_codes SET
    status = 'block'
    WHERE id = '$data->id'";
    $upload = pg_query($data->conn, $query);
    if($upload){
        return true;
    }
        return false;
}
?>