<?php  

class Blog extends Universal {

	protected static $db_table = "blogs";
	protected static $db_table_fields = array('id','title', 'author', 'description', 'filename', 'time_added');
	public $id;
	public $title;
	public $author;
	public $description;
	public $filename;
	public $time_added;
	
	public $tmp_path;
	public $upload_directory = "images";

	public function set_file($file) {

		if(empty($file) || !$file || !is_array($file)) {
			$this->errors[] = "There was no file uploaded here";
			return false;
		} else if($file['error'] != 0) {
			$this->errors[] = $this->upload_errors_array[$file['error']];
			return false;
		} else {
			$this->filename = basename($file['name']);
			$this->tmp_path = $file['tmp_name'];
			$this->size = $file['size'];
			$this->type = $file['type'];
		}

	}

	public function picture_path() {
		return $this->upload_directory.DS.$this->filename;
	}

	public function save() {
		
		if($this->id) {
			$this->update();
		} else {

			if(!empty($this->errors)) {
				return false;
			} 

			if(empty($this->filename) || empty($this->tmp_path)) {
				$this->errors[] = "The file was not avivable";
				return false;
			}

			$target_path = SITE_ROOT . DS . $this->upload_directory . DS . $this->filename;

			if(file_exists($target_path)) {
				$this->errors[] = "The file {$this->filename} already exsist";
			}

			if(move_uploaded_file($this->tmp_path, $target_path)) {
				if($this->create()) {
					unset($this->tmp_path);
					return true;
				}
			} else {
				$this->errors[] = "The folder probably does not have permission";
				return false;
			}

			$this->create();
		}

	}

	public function delete_photo() {

		if ($this->delete()) {
			$target_path = SITE_ROOT.DS.$this->picture_path();
			return unlink($target_path) ? true : false;
		} else {
			return false;
		}
	}

	public static function display_sidebar_data($photo_id) {
		$photo = Photo::find_by_id($photo_id);

		$output = "<a class='thumbnail' href='#'><img width='100' src='{$photo->picture_path()}'></a> ";
		$output.= "<p>{$photo->filename}</p>";
		$output.= "<p>{$photo->type}</p>";
		$output.= "<p>{$photo->size}</p>";

		echo $output;
	}

}?>