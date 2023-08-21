<div class="navbar_nav">
	<ul class="nav_links">
		<li class="links_item"><a href="?query=addDB">Create Data Base</a></li>
		<li class="links_item"><a href="?query=addUsers">Create table Users</a></li>
		<li class="links_item"><a href="?query=addAdmin">Create User Admin</a></li>
		<li class="links_item"><a href="?query=addRooms">Create table Rooms</a></li>
		<li class="links_item"><a href="?query=addBookings">Create table Bookings</a></li>
		<li class="links_item" style="background-color: orange;"><a href="/">domu</a></li>
	</ul>
</div>

<?php
include "mysqlConnect.php";
$linkdb = new mysqli($host, $name, $pass, $db);

if ($linkdb->connect_error) {
	echo 'Error: ' . $linkdb->connect_errno . '<br>';
	echo 'Error: ' . $linkdb->connect_errno . '<br>';
} else {
	echo 'Host info: ' . $linkdb->host_info . '<br>';
}

// addDB
// ================================
$createDB = function () use ($linkdb) {
	$marfDB = $linkdb->query("CREATE DATABASE IF NOT EXISTS `marf-travel`");
	if ($marfDB) {
		echo 'create DB welldone and marf-travel already exist';
	} else {
		echo 'Error creating DB: ' . $linkdb->error;
	}
};


// DRY code
// ================================
$addDB = "CREATE DATABASE `marf-travel`";
$addUsers = "CREATE TABLE Users (
	id INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL,
	password VARCHAR(32) NOT NULL,
	role ENUM('admin', 'user') NOT NULL
  )";

$addAdmin = "INSERT INTO Users (username, email, password, role) 
		VALUES ('Admin', 'admin@adminovich.marf', 'admin', 'admin')";

$addRooms = "CREATE TABLE Rooms (
	id INT PRIMARY KEY AUTO_INCREMENT,
  photo1 VARCHAR(255) NOT NULL,
  photo2 VARCHAR(255) NOT NULL,
  photo3 VARCHAR(255) NOT NULL,
  photo4 VARCHAR(255) NOT NULL,
  name VARCHAR(50) NOT NULL,
  description TEXT NOT NULL,
  room VARCHAR(50) NOT NULL,
  booking INT NULL
  )";

$addBookings = "CREATE TABLE Bookings (
	id INT PRIMARY KEY AUTO_INCREMENT,
	room_id INT NOT NULL,
	room_name VARCHAR(50) NOT NULL,
	start_date DATE NOT NULL,
	end_date DATE NOT NULL,
	nights INT NOT NULL,
	user_id INT NOT NULL,
	user_name VARCHAR(50) NOT NULL,
	FOREIGN KEY (room_id) REFERENCES Rooms(id),
	FOREIGN KEY (user_id) REFERENCES Users(id)
)";

echo '</br>=====================</br>';

if (isset($_GET['query'])) {
	$href = $_GET['query'];
	$tabName = substr($href, 3);
	$query = $$href;
} else {
	exit();
}
// echo $href . '</br>' . $tabName . '</br>' . $query . '</br>';

$createTable = function ($linkdb, $query, $tabName) {
	$query = $query;
	if ($linkdb->query($query) === TRUE) {
		echo 'create table' . $tabName . ' welldone <br>';
	} else {
		echo 'Error: ' . $linkdb->error;
	}
};

$addToDB = function ($linkdb, $query, $tabName) use ($createTable) {
	$linkdb->select_db('marf-travel');
	$table = $linkdb->query("SHOW TABLES LIKE '$tabName'");

	if ($table->num_rows == 0) {
		echo ' - there is no table like ' . $tabName . ' </br>';
		echo ' - you must create this table </br>';
		$createTable($linkdb, $query, $tabName);
	} else {
		echo 'table ' . $tabName . ' already exist';
	}
};

$createAdmin = function ($linkdb, $query) {
	$linkdb->select_db('marf-travel');
	$admin = $linkdb->query("SELECT * FROM `Users` WHERE `role` LIKE 'admin'");
	if ($admin->num_rows > 0) {
		echo 'user Admin already exist </br>';
	} elseif ($linkdb->query($query) === TRUE) {
		echo 'create user Admin welldone <br>';
	} else {
		echo 'Error: ' . $linkdb->error;
	}
};

if ($href) {
	if ($href == 'addDB') {
		$createDB();
	} elseif ($href == 'addAdmin') {
		$createAdmin($linkdb, $query);
	} else {
		$addToDB($linkdb, $query, $tabName);
	}
}

$linkdb->close();
?>

<!-- Archive my functions -->
<!-- ============================================ -->
<!-- 

$createDB = function () use ($linkdb) {
	// $marfTravel = $linkdb->select_db('marf-travel');
	// if (!$marfTravel) {
	// 	echo 'Error selecting DB: ' . $linkdb->error;
	// 	$linkdb->query("CREATE DATABASE `marf-travel`");
	// } else {
	// 	echo 'DB already exist';
	// }
};

// addUsers
// ================================
$createTableUsers = function ($linkdb) {
	$query = "CREATE TABLE Users (
	  id INT PRIMARY KEY AUTO_INCREMENT,
	  username VARCHAR(50) NOT NULL,
	  email VARCHAR(50) NOT NULL,
	  password VARCHAR(32) NOT NULL,
	  role ENUM('admin', 'user') NOT NULL
	)";

	$addUser = "INSERT INTO Users (username, email, password, role) 
		VALUES ('Admin', 'admin@adminovich', 'admin', 'admin')";

	if ($linkdb->query($query) === TRUE) {
		$linkdb->query($addUser);
		echo "create Users welldone <br>";
	} else {
		echo "Error: " . $linkdb->error;
	}
};

$addUsers = function ($linkdb) use ($createTableUsers) {
	$linkdb->select_db('marf-travel');
	$tabUsers = $linkdb->query("SHOW TABLES LIKE 'Users'");

	if ($tabUsers->num_rows == 0) {
		echo ' - there is no table like Users </br>';
		echo ' - you must create this table </br>';
		$createTableUsers($linkdb);
	} else {
		echo 'Users already exist';
	}
};

// addRooms
// ================================
$createTableRooms = function ($linkdb) {
	$query = "CREATE TABLE Rooms (
	  id INT PRIMARY KEY AUTO_INCREMENT,
    photo1 VARCHAR(255) NOT NULL,
    photo2 VARCHAR(255) NOT NULL,
    photo3 VARCHAR(255) NOT NULL,
    photo4 VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    booking BOOLEAN DEFAULT FALSE
	)";

	if ($linkdb->query($query) === TRUE) {
		echo "create Rooms welldone <br>";
	} else {
		echo "Error: " . $linkdb->error;
	}
};

$addRooms = function ($linkdb) use ($createTableRooms) {
	$linkdb->select_db('marf-travel');
	$tabRooms = $linkdb->query("SHOW TABLES LIKE 'Rooms'");

	if ($tabRooms->num_rows == 0) {
		echo ' - there is no table like Rooms </br>';
		echo ' - you must create this table </br>';
		$createTableRooms($linkdb);
	} else {
		echo 'Rooms already exist';
	}
};

// addBookings
// ================================
$createTableBookings = function ($linkdb) {
	$query = "CREATE TABLE Bookings (
		id INT PRIMARY KEY AUTO_INCREMENT,
		room_id INT NOT NULL,
		room_name VARCHAR(50) NOT NULL,
		start_date DATE NOT NULL,
		end_date DATE NOT NULL,
		nights INT NOT NULL,
		user_id INT NOT NULL,
		user_name VARCHAR(50) NOT NULL,
		FOREIGN KEY (room_id) REFERENCES Rooms(id),
		FOREIGN KEY (user_id) REFERENCES Users(id)
	)";

	if ($linkdb->query($query) === TRUE) {
		echo "create Bookings welldone <br>";
	} else {
		echo "Error: " . $linkdb->error;
	}
};

$addBookings = function ($linkdb) use ($createTableBookings) {
	$linkdb->select_db('marf-travel');
	$tabBookings = $linkdb->query("SHOW TABLES LIKE 'Bookings'");

	if ($tabBookings->num_rows == 0) {
		echo ' - there is no table like Bookings </br>';
		echo ' - you must create this table </br>';
		$createTableBookings($linkdb);
	} else {
		echo 'Bookings already exist';
	}
};

switch ($href) {
	case 'addDB':
		$addDB();
		break;
	case 'addUsers':
		$addUsers($linkdb);
		break;
	case 'addRooms':
		$addRooms($linkdb);
		break;
	case 'addBookings':
		$addBookings($linkdb);
		break;
}

 -->