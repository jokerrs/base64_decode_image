<?php

        /**
         * @param $Base64Image
         * @param array $AllowedFormats
         * @param int|null $Format = 1;
         * @return array|bool
         */
function base64_decode_image($Base64Image, $AllowedFormats, $Format = NULL){

            if(preg_match(/** @lang text */ '/^data:image\/(\w+);base64,/', $Base64Image, $type)) {

                $Base64Image = substr($Base64Image, strpos($Base64Image, ',') + 1);

                $type = strtolower($type[ 1 ]);

                $jpg = array( 'jpeg', 'jpe', 'jif', 'jfif', 'jfi' );
                $svg = array( 'svgz' );
                $bmp = array( 'dib' );

                if ( in_array('jpg', $AllowedFormats) )
                    $AllowedFormats = array_merge($jpg, $AllowedFormats);

                if ( in_array('svg', $AllowedFormats) )
                    $AllowedFormats = array_merge($svg, $AllowedFormats);

                if ( in_array('bmp', $AllowedFormats) )
                    $AllowedFormats = array_merge($bmp, $AllowedFormats);

                $return = true;

                if ( !in_array($type, $AllowedFormats) )
                    $return = false;

                if ( $Format != NULL ) {

                    if ( in_array($type, $jpg) )
                        $type = 'jpg';

                    if ( in_array($type, $svg) )
                        $type = 'svg';

                    if ( in_array($type, $bmp) )
                        $type = 'bmp';
                }

                $Base64Image = base64_decode($Base64Image);
                if ( $Base64Image === false )
                    $return = false;

                if ( $return )
                    $return = array( 'file' => $Base64Image, 'type' => $type );

            }else {
                $return = false;
            }
            return $return;
        }
