<?php
         /**
         * @param $image
         * @param null||jpg $format
         * @return array|bool
         */
        function base64_image($image, $format = NULL){
            if(preg_match('/^data:image\/(\w+);base64,/', $image, $type)){
                $image = substr($image, strpos($image, ',') + 1);
                $type = strtolower($type[1]);
                $AllowedExt = array('jpg', 'jpeg', 'gif', 'png');

                $return = true;

                if(!in_array($type, $AllowedExt)){
                    $return = false;
                }

                $jpg = array('jpg', 'jpeg');
                if(in_array($type, $jpg) && $format == 'jpg'){
                    $type = 'jpg';
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
