<?php

class Post{
    
    private $conn;

    public $id;
    public $fetch_id;
    public $group_id;
    public $title;
    public $email;
    public $img;
    public $pass;
    public $first_name;
    public $last_name;
    public $nick_name;
    public $gender;
    public $countrt;
    public $city;
    public $bio;
    public $mobile_number;
    public $dc_adress;
    public $has_approved_terms;
    public $g_id;
    public $g_title;
    public $g_sub_title;
    public $g_creator_id;
    public $g_description;
    public $g_email;
    public $g_country;
    public $g_city;
    public $g_telegram;
    public $g_dc_adress;
    public $g_insta_adress;
    public $g_ts_adress;
    public $g_skype_adress;
    public $g_group_platform;
    public $g_categories;
    public $g_member_count;
    public $platform;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT * from CATEGORY';

        $stmt = $this->conn->prepare($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->img = $row['img'];
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT p.id,p.title FROM CATEGORY p WHERE p.id = ? LIMIT 1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];

        return $stmt;
    }
    public function logged(){
        $query = 'SELECT
         p.id,
         p.first_name,
         p.last_name,
         p.nick_name,
         p.gender,
         p.country,
         p.city,
         p.bio,
         p.mobile_number,
         p.email,
         p.dc_adress,
         p.has_approved_terms FROM USER p WHERE p.email = :email LIMIT 1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->email);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->nick_name = $row['nick_name'];
        $this->gender = $row['gender'];
        $this->country = $row['country'];
        $this->city = $row['city'];
        $this->bio = $row['bio'];
        $this->mobile_number = $row['mobile_number'];
        $this->email = $row['email'];
        $this->dc_adress = $row['dc_adress'];
        $this->has_approved_terms = $row['has_approved_terms'];

        return $stmt;
    }
    public function get_group_from_group_id($f_id){
        $query = "SELECT
         p.id,
         p.title,
         p.sub_title,
         p.creator_id,
         p.description,
         p.email,
         p.country,
         p.city,
         p.telegram,
         p.dc_adress,
         p.insta_adress,
         p.ts_adress,
         p.skype_adress,
         p.group_platform,
         p.categories,
         p.member_count FROM GROUPS p WHERE p.id = '$f_id'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();
        //echo "$num";
        $gr = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->g_id = $gr['id'];
        $this->g_title = $gr['title'];
        $this->g_sub_title = $gr['sub_title'];
        $this->g_creator_id = $gr['creator_id'];
        $this->g_description = $gr['description'];
        $this->g_email = $gr['email'];
        $this->g_country = $gr['country'];
        $this->g_city = $gr['city'];
        $this->g_telegram = $gr['telegram'];
        $this->g_dc_adress = $gr['dc_adress'];
        $this->g_insta_adress = $gr['insta_adress'];
        $this->g_ts_adress = $gr['ts_adress'];
        $this->g_skype_adress = $gr['skype_adress'];
        $this->g_group_platform = $gr['group_platform'];
        $this->g_categories = $gr['categories'];
        $this->g_member_count = $gr['member_count'];
        
        return $stmt;
    }

    public function create(){
        //create query
        $query = 'INSERT INTO CATEGORY SET title = :title';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->title= htmlspecialchars(strip_tags($this->title));
        //binding of parameters
        $stmt->bindParam(':title', $this->title);
        if($stmt->execute()){
            return true;
        }
    
        printf("Error %s. \n", $stmt->error);
        return false;
    }
    public function update(){
        //create query
        $query = 'UPDATE CATEGORY SET title= :title WHERE id = :id';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //clean data
        
        $this->id= htmlspecialchars(strip_tags($this->id));
        $this->title= htmlspecialchars(strip_tags($this->title));
        //binding of parameters
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':title', $this->title);
        if($stmt->execute()){
            return true;
        }
    
        printf("Error %s. \n", $stmt->error);
        return false;
    }
    public function read_img(){
        $query = 'SELECT * from IMG_CATEGORY';

        $stmt = $this->conn->prepare($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->img = $row['img'];
        $this->platform = $row['platform'];

        $stmt->execute();

        return $stmt;
    }
    public function read_user(){
        $query = 'SELECT * from USER';

        $stmt = $this->conn->prepare($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->email = $row['email'];
        $this->pass = $row['password'];

        $stmt->execute();

        return $stmt;
    }
    public function login($email,$pass){
        $query = "SELECT * from USER WHERE email= '$email' AND password= '$pass' ";
        $stmt = $this->conn->prepare($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->execute();
        $num = $stmt->rowCount();
        if($num > 0) {
            $json['result'] = true;
            $json['messages'] = array();
            $json['messages'] = 'Successfull';

            echo json_encode($json);
            // LOGGED ACTIVITY TRIGGER
        } else {
            $json['result'] = false;
            $json['messages'] = array('No match email,password');
            $json['data'] = array();
            echo json_encode($json);
        }
    }
    public function register($email,$pass){
        $query = "SELECT * from USER WHERE email= '$email'";
        $stmt = $this->conn->prepare($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->execute();
        $num = $stmt->rowCount();
        if($num > 0) {
            $json['error'] = ' Choose different email ';
            echo json_encode($json);
        } else {
            $query = "INSERT INTO USER(email,password,first_name,last_name,nick_name,gender,country,city,bio,mobile_number,dc_adress,has_approved_terms)
            VALUES ('$email', '$pass','','','','','','','','','','')";
            $is_insert = $this->conn->prepare($query);
            $is_insert->execute();
            if($is_insert == 1){
            $json['success'] = ' Account created, welcome ' .$email;
            // LOGGED ACTIVITY TRIGGER
            } else {
                $json['error'] = ' Somethings wrong ';
            }
            echo json_encode($json);
            $is_insert->close();
        }
        $stmt->close();
    }
    public function fetch_group($g_id){
        $query = "SELECT p.id
        FROM GROUPS_MEMBERS p WHERE p.m1 = '$g_id' OR p.m2 = '$g_id' OR p.m3 = '$g_id' OR p.m4 = '$g_id' OR p.m5 = '$g_id'";

        $stmt = $this->conn->prepare($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->execute();

        return $stmt;
    }

    public function feed($f_category){
        $query = "SELECT * from POST p WHERE p.category = '$f_category'";

        $stmt = $this->conn->prepare($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->execute();

        return $stmt;
    }
    public function fetch_category($f_platform){
        $query = "SELECT * from CATEGORY p WHERE p.platform = '$f_platform'";

        $stmt = $this->conn->prepare($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->execute();

        return $stmt;
    }
    public function fetch_group_member($f_mem){
        $query = "SELECT
        p.id,
        p.first_name,
        p.last_name,
        p.nick_name,
        p.gender,
        p.country,
        p.city,
        p.bio,
        p.mobile_number,
        p.email,
        p.dc_adress,
        p.has_approved_terms FROM USER p WHERE p.id IN ((SELECT g.m1 FROM GROUPS_MEMBERS g WHERE g.id = '$f_mem'),(SELECT g.m2 FROM GROUPS_MEMBERS g WHERE g.id = '$f_mem'),(SELECT g.m3 FROM GROUPS_MEMBERS g WHERE g.id = '$f_mem'),(SELECT g.m4 FROM GROUPS_MEMBERS g WHERE g.id = '$f_mem'),(SELECT g.m5 FROM GROUPS_MEMBERS g WHERE g.id = '$f_mem'))";

        $stmt = $this->conn->prepare($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->execute();
        return $stmt;
    }
}
?>