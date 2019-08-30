<?php
/**
 * @author Jeremic Nemanja nemanja@joker.rs
 * @license GNU
 * @version 0.1.0
 */

/**
 * @param string $Base64Image
 * @param array $AllowedFormats
 * @param int|null $Format
 * @return array|null
 */
function base64_decode_image(string $Base64Image,array $AllowedFormats,?int $Format = NULL): ?array
{

    if(preg_match('/^data:image\/(\w+);base64,/', $Base64Image, $type)) {

        $Base64Image = substr($Base64Image, strpos($Base64Image, ',') + 1);

        $type = strtolower($type[ 1 ]);

        $jpg = array( 'jpeg', 'jpe', 'jif', 'jfif', 'jfi' );
        $svg = array( 'svgz' );
        $bmp = array( 'dib' );

        if ( in_array('jpg', $AllowedFormats, true) ) {
            $AllowedFormats = array_merge($jpg, $AllowedFormats);
        }

        if ( in_array('svg', $AllowedFormats, true) ) {
            $AllowedFormats = array_merge($svg, $AllowedFormats);
        }

        if ( in_array('bmp', $AllowedFormats, true) ) {
            $AllowedFormats = array_merge($bmp, $AllowedFormats);
        }

        $return = true;

        if ( !in_array($type, $AllowedFormats, true) ) {
            $return = false;
        }

        if ( $Format !== NULL ) {

            if ( in_array($type, $jpg, true) ) {
                $type = 'jpg';
            }

            if ( in_array($type, $svg, true) ) {
                $type = 'svg';
            }

            if ( in_array($type, $bmp, true) ) {
                $type = 'bmp';
            }
        }

        $Base64Image = base64_decode($Base64Image);
        if ( $Base64Image === false ) {
            $return = null;
        }

        if ( $return ) {
            $return = array( 'file' => $Base64Image, 'type' => $type );
        }

    }else {
        $return = null;
    }
    return $return;
}