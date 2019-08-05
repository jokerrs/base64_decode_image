<?php

         /**
         * @param $Base64Image
         * @param array $AllowedFormats
         * @param string = 'jpg'|null $Format string is 'jpg'
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

                $jpg = array('jpg', 'jpeg');
                if(in_array($type, $jpg) && $Format != NULL){
                    $type = $Format;
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
