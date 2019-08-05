<?php

        /**
         * @param $Base64Image
         * @param array $AllowedFormats
         * @param int|null $Format = 1; 
         * @return array|bool
         */
        function base64_image($Base64Image, $AllowedFormats, $Format = NULL){
            if(preg_match('/^data:image/(\w+);base64,/', $image, $type)){
                $Base64Image = substr($Base64Image, strpos($Base64Image, ',') + 1);
                $type = strtolower($type[1]);
                $AllowedExt = $AllowedFormats;
                $return = true;
                if(!in_array($type, $AllowedExt)){
                    $return = false;
                }

                if($Format != NUll) {
                    $jpg = array( 'jpg', 'jpeg', 'jpe', 'jif', 'jfif', 'jfi' );
                    if ( in_array($type, $jpg) ) {
                        $type = 'jpg';
                    }

                    $svg = array( 'svg', 'svgz' );
                    if ( in_array($type, $svg) ) {
                        $type = 'svg';
                    }

                    $bmp = array( 'bmp', 'dib' );
                    if ( in_array($type, $bmp)  ) {
                        $type = 'bmp';
                    }
                }

                $Base64Image = base64_decode($Base64Image);
                if($Base64Image === false){
                    $return = false;
                }
                if($return) {
                    $return = array(
                        'file' => $Base64Image,
                        'type' => $type
                    );
                }
            }else {
                $return = false;
            }
            return $return;
        }
