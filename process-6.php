<?php
//Add certificates info:

$certificates_ids_in_wp = array(
    'AENOR' => 2251,
    'NF' => 2250,
    'CATALUNA' => 2259,
    'CE' => 2260,
    'ECO' => 2261,
    'GOOD' => 2262
);

if($value[$data_index['FILTRO_CERTIFICACION']] == 'Si'){

    $array_certificates = array();

    if($value[$data_index['CERTIFICADO_AENOR']] == 'Si'){
        array_push($array_certificates,$certificates_ids_in_wp['AENOR']);
    }
    if($value[$data_index['CERTIFICADO_NF']] == 'Si'){
        array_push($array_certificates,$certificates_ids_in_wp['NF']);
    }
    if($value[$data_index['CERTIFICADO_CATALUNA']] == 'Si'){
        array_push($array_certificates,$certificates_ids_in_wp['CATALUNA']);
    }
    if($value[$data_index['CERTIFICADO_ECO']] == 'Si'){
        array_push($array_certificates,$certificates_ids_in_wp['ECO']);
    }
    if($value[$data_index['CERTIFICADO_CE']] == 'Si'){
        array_push($array_certificates,$certificates_ids_in_wp['CE']);
    }
    if($value[$data_index['CERTIFICADO_GOOD']] == 'Si'){
        array_push($array_certificates,$certificates_ids_in_wp['GOOD']);
    }
    
    if(!empty($array_certificates)){
        $certificates = implode(',', $array_certificates);
        add_post_meta( $post_id, '_referenced_certificate_list', $certificates );
    }

}