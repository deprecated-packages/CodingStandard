<?php // lint >= 5.5

if ($count === 2) {
	return 3;
} elseif ($count === 3) {
	return 4;
}



try {
	return 1;
} catch (Exception $e) {
	return 2;


} finally {
	return $i++;
}