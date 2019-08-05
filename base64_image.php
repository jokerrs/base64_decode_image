<?php

        /**
         * @param string $image base64 image
         * @param array $AllowedFormats
         * @param null|string $format string is 'jpg'
         * @return array|bool
         */
        function base64_image($image, $AllowedFormats, $format = NULL){
            if(preg_match('/^data:image/(\w+);base64,/', $image, $type)){
                $image = substr($image, strpos($image, ',') + 1);
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

                $image = base64_decode($image);
                if($image === false){
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
