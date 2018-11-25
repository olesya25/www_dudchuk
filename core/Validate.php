<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 12/11/2018
 * Time: 22:48
 */

class Validate{
    private $passed = false, $errors =[], $success, $db =  null;
    public $fileName ='';
    public function __construct(){
        $this->db = DB::getInstance();
    }

    public function check($data, $fields =[]){
        $this->errors = [];
        foreach ($fields as $field => $rule){
            $field = Input::sanitize($field);
            $display = $rule['display'];
            foreach ($rule as $rule_name => $rule_value){
                $value = Input::sanitize(trim ($data[$field]));
               // dump_die($rule);
                if($rule_name === 'required' && empty($value)){
                       $this->addError(["{$display} is required", $field]);
                } else if(!empty($value)){

                    switch ($rule_name){

                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError(["{$display} must be a minimum of {$rule_value} characters", $field]);
                            }
                            break;

                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError(["{$display} must be a maximum of {$rule_value} characters", $field]);
                            }
                            break;

                        case 'matches':
                            if($value != $data[$rule_value]){
                                $matchDisplay = $fields[$rule_value]['display'];
                                $this->addError(["{$matchDisplay} and {$display} must match", $field]);
                            }
                            break;
                        case 'unique':
                            $check = $this->db->query("SELECT {$field} FROM {$rule_value} WHERE {$field} = ?", [$value]);
                            if($check->getCount()){
                                $this->addError(["This {$display} already exists. Please choose another {$display}", $field]);
                            }
                            break;
                        case 'unique_update':
                            $t = explode(',', $rule_value);
                            $table = $t[0];
                            $id = $t[1];
                            $checkResult = $this->db->query("SELECT * FROM {$table} WHERE id != ? AND {$field} = ?", [$id, $value]);
                            if($checkResult->getCount()){
                                $this->addError(["This {$display} already exists. Please choose another {$display}", $field]);
                            }
                            break;
                        case  'is_numeric':
                            if(!is_numeric($value)){
                                $this->addError(["{$display} should be a number, please enter the numeric value.", [$field]]);
                            }
                            break;
                        case 'valid_email':
                            if(!filter_var($value, FILTER_VALIDATE_EMAIL)){
                                $this->addError(["{$display} is not a valid email adress", $field]);
                            }
                            break;
                        case 'valid_url':
                            if(!filter_var($value, FILTER_VALIDATE_URL)){
                                $this->addError(["{$display} is not a valid", $field]);
                            }
                            break;

                    }
                }
            }
        }
        if(empty($this->errors)){
            $this->passed = true;
        }
        return $this;
    }

    public function addError($error){
        $this->errors[] = $error;
        if(empty($this->errors)){
            $this->passed = true;
        }else{
            $this->passed = false;
        }


    }

    public function passed(){
        return $this->passed;
    }

    /**
     * @return array
     */
    public function getErrors(){
        return $this->errors;
    }

    public function fileUpload(){
        if(empty($_FILES)){
            return false;
        }else{
            $this->errors = [];

            $currentDir = getcwd();
            $uploadDirectory = "/uploads/";

            $fileExtensions = ['pdf','docx','doc']; // Get all the file extensions

            $fileName = $_FILES['fileToUpload']['name'];
            $fileSize = $_FILES['fileToUpload']['size'];
            $fileTmpName  = $_FILES['fileToUpload']['tmp_name'];
            $tmp = explode('.',$fileName);
            $fileExtension = strtolower(end($tmp));

            $uploadPath = $currentDir . $uploadDirectory . basename($fileName);

            if (isset($_POST['send_cv'])) {

                if (! in_array($fileExtension,$fileExtensions)) {
                    $this->addError(["This file extension is not allowed. Please upload a PDF, DOCX or DOC file"]);
                }

                if ($fileSize > 2000000) {
                    $this->addError(["This file is more than 2MB. Sorry, it has to be less than or equal to 2MB"]);
                }

                if (empty($this->errors)) {
                    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                    if ($didUpload) {
                        $this->success = "File \" ". basename($fileName) ." \" has been uploaded";
                        $this->fileName = basename($fileName);
                        return true;
                    } else {
                        $this->addError(["An error occurred somewhere. Try again or contact the admin"]);
                        return false;
                    }
                } else {
                    return false;
                    }
                }
            }
        }



    public function displayErrors(){
        $html = '<ul class="bg-danger">';
        foreach ($this->errors as $error){
            if(is_array($error)){
                //dump_die($error);
                $html .= '<li class="text-danger">'.$error[0].'</li>';
                $html .= '<script>jQuery("document").ready(function() {jQuery("#'.$error[0].'").parent().closest("div").addClass("has-error");
  
                        });</script>';
            }else{
                $html .= '<li class="text-danger">'.$error.'</li>';
            }


        }
        $html .= '</ul>';
        return $html;
    }

    public function displaySuccess(){
        $html = '<ul class="bg-success"><li class="text-success">'.$this->success.'</li></ul>';
        return $html;
    }




}