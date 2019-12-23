



<?php
		class post{
			 private $conn;
			 private $table='posts';




			 //post properties

			 public $id;
			 public $category_id;
			 public $category_name;
			 public $title;
			 public $body;
			 public $author;
			 public $created_at;


			 //Constructor with DB
			  public function __construct($db){

			  	$this->conn= $db;
			  }


			  	//Get Posts

			  public function read(){

			  	//Create Query

			  	$query=' select 
			  			c.name as category_name,
			  			p.id,
			  			p.category_id,
			  			p.title,
			  			p.body,
			  			p.author,
			  			p.created_at

			  			FROM
			  			'.$this->table.' p
			  			left join
			  			categories c on p.category_id=c.id
			  			order by
			  			p.created_at desc';


			  	//prepare statement
			  	$stmt=$this->conn->prepare($query);

			  	//Execute Query
			  	$stmt->execute();


			  	return $stmt;
			  }


			  //Get single post

			  public function read_single(){


			  	 	$query=' select 
			  			c.name as category_name,
			  			p.id,
			  			p.category_id,
			  			p.title,
			  			p.body,
			  			p.author,
			  			p.created_at

			  			FROM
			  			'.$this->table.' p
			  			left join
			  			categories c on p.category_id=c.id
			  			where p.id=?
			  			limit 0,1';


				  	//prepare statement
				  	$stmt=$this->conn->prepare($query);

				  	// Bind ID
				  	$stmt->bindParam(1,$this->id);


				  	//Execute Query
				  	$stmt->execute();

				  	$row= $stmt->fetch(PDO::FETCH_ASSOC);

				  	//set properties

				  	$this->title= $row['title'];
				  	$this->body= $row['body'];
				  	$this->author= $row['author'];
				  	$this->category_id= $row['category_id'];
				  	$this->category_name= $row['category_name'];
				  }

				  //Create post

				  public function create(){

				  	//Create Query

				  	$query='insert into '
				  	.$this->table.'
				  	set
				  	title= :title,
				  	body= :body,
				  	author= :author,
				  	category_id= :category_id';

				  	//Prepare statement

				  	$stmt=$this->conn->prepare($query);

				  	//Clean Data
				  	$this->title=htmlspecialchars(strip_tags($this->title));
				  	$this->body=htmlspecialchars(strip_tags($this->body));
				  	$this->author=htmlspecialchars(strip_tags($this->author));
				  	$this->category_id=htmlspecialchars(strip_tags($this->category_id));

				  	//Bind data

				  	$stmt->bindParam(':title',$this->title);
				  	$stmt->bindParam(':body',$this->body);
				  	$stmt->bindParam(':author',$this->author);
				  	$stmt->bindParam(':category_id',$this->category_id);

				  	//Execute query
				  	if ($stmt->execute()) {
				  		return true;
				  	}

				  
				  	//print error if something goes wrong

				  	printf("Error:%s.\n",$stmt->error);
				  	return false;

			  }

			  //Update post
			    public function update(){

				  	//Create Query

				  	$query='update '
				  	.$this->table.'
				  	set
				  	title= :title,
				  	body= :body,
				  	author= :author,
				  	category_id= :category_id
				  	where id=:id';

				  	//Prepare statement

				  	$stmt=$this->conn->prepare($query);

				  	//Clean Data
				  	$this->title=htmlspecialchars(strip_tags($this->title));
				  	$this->body=htmlspecialchars(strip_tags($this->body));
				  	$this->author=htmlspecialchars(strip_tags($this->author));
				  	$this->category_id=htmlspecialchars(strip_tags($this->category_id));
				  	$this->id=htmlspecialchars(strip_tags($this->id));


				  	//Bind data

				  	$stmt->bindParam(':title',$this->title);
				  	$stmt->bindParam(':body',$this->body);
				  	$stmt->bindParam(':author',$this->author);
				  	$stmt->bindParam(':category_id',$this->category_id);
				  	$stmt->bindParam(':id',$this->id);


				  	//Execute query
				  	if ($stmt->execute()) {
				  		return true;
				  	}

				  
				  	//print error if something goes wrong

				  	printf("Error:%s.\n",$stmt->error);
				  	return false;

			  }

			  //Delete Post
			  	 public function delete(){

				  	//Create Query

				  	$query='delete from '
				  	.$this->table.'
				  	where 
				  	id=:id';

				  	//Prepare statement

				  	$stmt=$this->conn->prepare($query);

				  	//Clean Data
				  	$this->id=htmlspecialchars(strip_tags($this->id));


				  	//Bind data
				  	$stmt->bindParam(':id',$this->id);


				  	//Execute query
				  	if ($stmt->execute()) {
				  		return true;
				  	}

				  
				  	//print error if something goes wrong

				  	printf("Error:%s.\n",$stmt->error);
				  	return false;

			  }

		}




