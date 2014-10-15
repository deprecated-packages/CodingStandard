<?php

if (1 === 2) {
	return 3;
} elseif (2 === 3) {
	return 4;
}



try {
	return 1;
} catch (Exception $e) {
	return 2;


} finally {
	return $i++;
}
