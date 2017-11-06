<?php
/**
 * Converte todos os arquivos da pasta data em versão normalizada.
 * Se não houverem alteração, não sobrescreve.
 *   php src/csv_normalize.php
 */

$here = dirname(__FILE__);
fwrite(STDERR, "\n-------------\n BEGIN of check CSV files");

foreach (glob("$here/../data/*.csv") as $f) {
	fwrite(STDERR, "\n $f " . round(filesize($f)/1024,1) . "kb" );
	csv_normalize($f);
}

fwrite(STDERR, "\n END\n");


///////////////////

/**
 * Standard "get array from CSV", file or CSV-string.
 * CSV conventions by default options of the build-in str_getcsv() function.
 * @param $f string file (.csv) with path or CSV string (with more tham 1 line).
 * @return array of arrays.
 */
function getCsv($f) {
	return array_map(  'str_getcsv', file($f)  );
}

/**
 * Check CSV file and overwrite by a normalized one when need.
 */
function csv_normalize($f) {
	$f2 = "/tmp/testCsv_".rand();
	$h = fopen($f2, 'w');
	foreach( getCsv($f) as $r)
		fputcsv($h,$r);
	fclose($h);
	if (file_get_contents($f)==file_get_contents($f2)) {
		fwrite(STDERR, "\n\tWas good, CSV normalized." );
		unlink($f2);
	} else {
		fwrite(STDERR, "\n\tOverwriting CSV! by a normalized one.");
		if (!rename($f2, $f)) die("\n Failed to rename $f2 to $f\n");
	}
}
