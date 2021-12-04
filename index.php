<?php

class Movie {
	
	public $movie_array = array();

	function __construct() {
		
	}

	function get($movie_array) {
		return $movie_array;
	}

	function set($data) {
		$this->movie_array[] = $data;
	}

	function display() {

		$movie_array = $this->get($this->movie_array);

		echo "<table border=1>";
		echo "<tr>";
		echo "<th>Title</th>";
		echo "<th>Picture</th>";
		echo "<th>Director</th>";
		echo "</tr>";

		for($i=0; $i<count($movie_array); $i++) {
			echo "<tr>";
			echo "<td>".$movie_array[$i]["title"]."</td>";
			echo "<td>".$movie_array[$i]["picture"]."</td>";
			echo "<td>".$movie_array[$i]["director"]."</td>";
			echo "</tr>";
		}

		echo "</table>";
	}
}

$obj = new Movie();

// Load xml file into xml_data variable
$xml_data = simplexml_load_file("xml_data.xml") or
die("Error: Object Creation failure");
// Use foreach loop to display data and for sub elements access,
// We will use children() function
foreach ($xml_data->children() as $data)
{
	$obj->set((array) $data);
}


$obj->display();




?>