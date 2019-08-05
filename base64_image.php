<?php
         /**
         * @param $main_image
         * @param null||jpg $format
         * @return array|bool
         */
        function base64_image($main_image, $format = NULL){
            if(preg_match('/^data:image\/(\w+);base64,/', $main_image, $type)){
                $main_image = substr($main_image, strpos($main_image, ',') + 1);
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

                $main_image = base64_decode($main_image);

                if($main_image === false){
                    $return = false;
                }

                if($return) {
                    $return = array(
                        'file' => $main_image,
                        'type' => $type
                    );
                }
            }else {
                $return = false;
            }
            return $return;
        }
