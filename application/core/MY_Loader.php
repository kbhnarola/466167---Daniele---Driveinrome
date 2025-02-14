<?php

    class MY_Loader extends CI_Loader{

        public function frontpage($temp_path = 'frontpages', $template_name, $vars, $return = FALSE){

            // $template = ($temp == 'admin') ? 'admin' : 'front';
            // if($template_name == 'fleetNew'){
            //     $content = $this->view('frontpages/header/header', $vars, $return);
            //     // $content .= $this->view($temp_path.'/'.$template_name, $vars, $return);
            //     return $content;
            // }
            if($template_name == 'umbriavilla'){
                $content = $this->view('frontpages/header/header', $vars, $return);
                // $content .= $this->view($temp_path.'/'.$template_name, $vars, $return);
                return $content;
            }
            if($return){                

                $content = $this->view('frontpages/header/header', $vars, $return);

                $content = $this->view('frontpages/fixed/fixed-social', $vars, $return);

                $content = $this->view('frontpages/fixed/fixed-btn', $vars, $return);

                // $content .= $this->view('frontend/admin_sidebar', $vars, $return);

                $content .= $this->view($temp_path.'/'.$template_name, $vars, $return);

                $content .= $this->view('frontpages/footer/footer', $vars, $return);

                return $content;

            }else{                

                $this->view('frontpages/header/header', $vars);

                $content = $this->view('frontpages/fixed/fixed-social', $vars, $return);

                $content = $this->view('frontpages/fixed/fixed-btn', $vars, $return);

                // $this->view('frontend/admin_sidebar', $vars);

                $this->view($temp_path.'/'.$template_name, $vars);

                $this->view('frontpages/footer/footer', $vars);

            }

        }

    }

?>