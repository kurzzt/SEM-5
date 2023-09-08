<html>

<head>
	<title>Hello World</title>
</head>

<body>
	<?php
	$array_mhs = array(
		'Abdul' => array(89, 90, 54),
		'Budi' => array(78, 60, 64),
		'Nina' => array(67, 56, 84),
		'Budi' => array(87, 69, 50),
		'Budi' => array(98, 65, 74)
	);

	function hitung_rata($array){
		$rata = array_sum($array) / count($array);
		return $rata;
	}

	function print_mhs($array_mhs){
		foreach ($array_mhs as $nama => $nilai){
			$rata = hitung_rata($nilai);
			echo "<tr>
            <td>$nama</td>
            <td>$nilai[0]</td>
            <td>$nilai[1]</td>
            <td>$nilai[2]</td>
            <td>$rata</td>
       	 </tr>";
		}
	}
	echo '<table border="1">';
	echo '<tr>
	<td>Nama</td>
	<td>Nilai 1</td>
	<td>Nilai 2</td>
	<td>Nilai 3</td>
	<td>Rata2</td>
	</tr>';

	print_mhs($array_mhs);
	
	echo '<table>';
	?>
</body>

</html>