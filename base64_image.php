<?php

/**
         * @param $base64_image
         * @param array $AllowedFormats
         * @param string = 'jpg'|null $format string is 'jpg'
         * @return array|bool
         */
        function base64_image($base64_image, $AllowedFormats, $format = NULL){
            if(preg_match('/^data:image/(\w+);base64,/', $image, $type)){
                $base64_image = substr($base64_image, strpos($base64_image, ',') + 1);
                $type = strtolower($type[1]);
                $AllowedExt = $AllowedFormats;
                $return = true;
                if(!in_array($type, $AllowedExt)){
                    $return = false;
                }

                $jpg = array('jpg', 'jpeg');
                if(in_array($type, $jpg) && $format != NULL){
                    $type = $format;
                }

                $base64_image = base64_decode($base64_image);
                if($base64_image === false){
                    $return = false;
                }
                if($return) {
                    $return = array(
                        'file' => $image,
                        'type' => $type
                    );
                }
            }else {
                $return = false;
            }
            return $return;
        }
