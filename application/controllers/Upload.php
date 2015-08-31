<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Upload extends CI_Controller
    {
      public function json_get_uploadprogress()
      {
             $data = array();
             if($this->input->post('upload_id'))
             {
                 $uploadKey = $this->input->post('upload_id');
                 $status = false;
                 $percentage = 0;
                 $result = "INITIALISING UPLOAD";
                 $data["percentage"] = $percentage;
                 $data["result"] = $result;
                 if (function_exists('apc_fetch'))
                 {
                    $status = apc_fetch('upload_'.$uploadKey);
                 }
                 if (is_array($status))
                 {
                    log_message("error", "STATUS: ".print_r($status,TRUE));
                    if (array_key_exists("total", $status) && array_key_exists("current", $status))
                    {
                        $percentage = round((($status['current'] / $status['total']) * 100),2);
                          if ($status['current'] >= $status['total'])
                          {
                              $percentage = 100;
                              $result = "UPLOAD COMPLETE";
                          }
                          else
                          {
                              $bytes = array('B','KB','MB','GB','TB');
                              foreach($bytes as $val)
                              {
                                    if($status["total"]  > 1024)
                                    {
                                        $status["total"] = $status["total"] / 1024;
                                        $status["current"] = $status["current"] / 1024;
                                    }
                                    else
                                    {
                                        break;
                                    }
                              }
                              $result =  $percentage."% (".round($status["current"], 2)." ";
                              $result.= $val." of ".round($status["total"], 2)." ".$val.")";
                          }
                          $data["percentage"] = $percentage;
                          $data["result"] = $result;
                      }

              }
              $this->load->view('json/json_response_view',array("array" => $data));
            }
      }

      public function upload_file()
      {
         $path_file = $this->config->item('FOLUP');

         /*if(!is_dir($path_file))
         {
           mkdir($path_file);
         }*/

         $config['upload_path'] = $path_file;
         $config['allowed_types'] = $this->config->item('ALLTY');
         $tam_gigas = 1.5; //Tamanyo maximo del archivo en gigas
         $config['max_size'] = $tam_gigas * 1048576; //
         $this->load->library('upload');
         $this->upload->initialize($config);
         $div_start = "<div>";
         $div_end = "</div>";

         if (!$this->upload->do_upload('uploadedFile'))
         {
             $this->data["params"] = array('success_msg' => $this->upload->display_errors());
             log_message('error','El error: '.$this->upload->display_errors());
         }
         else
         {
             $uploaded_file = $this->upload->data();
             $this->load->view("ajax/generic_response_view",array("resp" => $div_start."The file has been uploaded successfully.".$div_end));
             return;
         }
      }
  }
?>
