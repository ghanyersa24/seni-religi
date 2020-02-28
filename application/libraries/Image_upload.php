<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Libraries Image_upload
 *
 * This Libraries for ...
 * 
 * @package		CodeIgniter
 * @category	Libraries
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Image_upload
{

  // ------------------------------------------------------------------------
  private $ci;
  public function __construct()
  {
    $this->ci = &get_instance();
  }

  public function to($location = null, $file_name = null)
  {
    if (!is_null($location))
      $config['upload_path'] = "./uploads/$location";
    else
      $config['upload_path'] = "./uploads/untitles/";

    if (!is_null($file_name))
      $config['file_name'] = date('Y-m-d H i') . ' ' . $file_name;
    else
      $config['encrypt_name'] = true;

    $config['allowed_types'] = 'gif|jpg|png|JPG|jpeg';

    $this->ci->load->library('upload', $config);
    $this->ci->upload->initialize($config);

    $upload_status = $this->ci->upload->do_upload('picture');
    $upload_message = strip_tags($this->ci->upload->display_errors());
    $upload_location = base_url()."uploads/$location/".$this->ci->upload->data("file_name");
      if ($upload_status)
        return $upload_location;
      else
        error($upload_message);
  }

  // ------------------------------------------------------------------------
}

/* End of file Image_upload.php */
/* Location: ./application/libraries/Image_upload.php */
