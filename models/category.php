



<?php
		class category{
			 private $conn;
			 private $table='categories';




			 //post properties

			 public $id;
			 public $name;
			 public $created_at;


			 //Constructor with DB
			  public function __construct($db){

			  	$this->conn= $db;
			  }


			  	//Get Posts

			  public function read(){

			  	//Create Query

			  	$query=' select 
			  			id,
			  			name,
			  			created_at
			  			from
			  			'.$this->table .'
			  			order by
			  			created_at desc';


			  	//prepare statement
			  	$stmt=$this->conn->prepare($query);

			  	//Execute Query
			  	$stmt->execute();


			  	return $stmt;
			  }


			  //Get single post

			  public function read_single(){


			  	 $query=' select 
			  			id,
			  			name,
			  			created_at
			  			from
			  			'.$this->table .'
			  			where
			  			id=?';



				  	//prepare statement
				  	$stmt=$this->conn->prepare($query);

				  	// Bind ID
				  	$stmt->bindParam(1,$this->id);


				  	//Execute Query
				  	$stmt->execute();

				  	$row= $stmt->fetch(PDO::FETCH_ASSOC);

				  	//set properties

				  	$this->name= $row['name'];
				  	$this->created_at= $row['created_at'];

				  	
				  }

				  //Create post

				  public function create(){

				  	//Create Query

				  	$query='insert into '
				  	.$this->table.'
				  	set
				  	name= :name';

				  	//Prepare statement

				  	$stmt=$this->conn->prepare($query);

				  	//Clean Data
				  	$this->name=htmlspecialchars(strip_tags($this->name));
				  	//Bind data

				  	$stmt->bindParam(':name',$this->name);
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
				  	name= :name
				  	where id=:id';

				  	//Prepare statement

				  	$stmt=$this->conn->prepare($query);

				  	//Clean Data
				  	$this->name=htmlspecialchars(strip_tags($this->name));

				  	$this->id=htmlspecialchars(strip_tags($this->id));


				  	//Bind data

				  	$stmt->bindParam(':name',$this->name);
				  	
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




