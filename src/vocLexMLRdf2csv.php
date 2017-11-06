<?php
/**
 * Converte STDIN em CSV conforme XPath esperado de RDF do vocabulário LexML.
 * Lembrar que a radução para JSON-LD será feita por SQL a partir destes dados, mas não aqui.
 * Exemplos de uso no terminal:
 *   php vocLexMLRdf2csv.php < autoridade.rdf.xml > autoridade.csv
 *   php vocLexMLRdf2csv.php http://www.lexml.gov.br/vocabulario/autoridade.rdf.xml | more
 */

// Configs:
$out = 'csv'; // or json-ld
$NS0 = 'http://www.w3.org/2008/05/skos#';
$useId=true;  $useLang=true;  $useInSch=false; // options
$xpathsToGet = [ // keys will be the output-CSV column names.
	'id'         => '@rdf:id', // usa
	'about'      => '@rdf:about',
	'prefLabel'  => 'skos:prefLabel//text()',
	'lang'       => 'skos:prefLabel/@xml:lang',  // usando...
	'altLabel'   => 'skos:altLabel//text()',
	'broader'    => 'skos:broader/@rdf:resource',
	'facetaAcronimo' => 'skos:prefLabel/@lexml:facetaAcronimo',
	'faceta'     => 'skos:prefLabel/@lexml:faceta',

	'prefNodeId' => 'skos:prefLabel/@rdf:nodeID', // sem uso
	'inSchRes'   => 'skos:prefLabel/skos:inScheme/@rdf:resource',  // nao usa, redundante
];

// IO
if ($argc<2) $url = 'php://stdin';
else $url = $argv[1];


// Inits:
if (!$useId)    unset($xpathsToGet['id']);
if (!$useLang)  unset($xpathsToGet['lang']);
if (!$useInSch) unset($xpathsToGet['inSchRes']);
$xps = array_values($xpathsToGet);

$dom = new DOMDocument;
$dom->preserveWhiteSpace = false;
$dom->load($url);
$xpath = new DOMXPath($dom);

// Gerando CSV:
fputcsv(STDOUT, array_keys($xpathsToGet) );
foreach ( $dom->getElementsByTagNameNS($NS0,'Concept')  as  $e )
	fputcsv(STDOUT, xqGetStr($xps,$e) );


// // // //
// LIB

function xqGetStr($xpaths,$e) {
	global  $xpath;
	$ret = [];
	foreach($xpaths as $xp) $ret[] = $xpath->evaluate("string($xp)",$e); // reune //text() ou quebra em array?
	return $ret;
}
