<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Review_model extends MY_Model
{
    protected $_table = TBL_REVIEW;
    /**
     * Constructor for the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->table = TBL_REVIEW;
        // Set orderable column fields
        $this->column_order = array(null, TBL_REVIEW . '.title', TBL_REVIEW . '.created_at', null);
        // Set searchable column fields
        $this->column_search = array(TBL_REVIEW . '.title', TBL_REVIEW . '.username', TBL_REVIEW . '.city', TBL_REVIEW . '.country', TBL_REVIEW . '.review_date', TBL_TOUR . '.title');
        // Set default order
        $this->order = array(TBL_REVIEW . '.created_at' => 'desc');
    }
    public function getRows($postData)
    {
        $this->_get_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result();
    }
    public function countFiltered($postData)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    private function _get_datatables_query($postData)
    {

        $this->db->select(TBL_REVIEW . '.*,' . TBL_TOUR . '.title as tour_name');
        $this->db->from($this->table);
        //$this->db->join(TBL_USERS, TBL_USERS.'.id = '.TBL_REVIEW.'.user_id');
        $this->db->join(TBL_TOUR, TBL_TOUR . '.id = ' . TBL_REVIEW . '.tour_id', 'left');
        $i = 0;

        // loop searchable columns
        foreach ($this->column_search as $item) {
            // if datatable send POST for search
            if ($postData['search']['value']) {
                // first loop
                if ($i === 0) {
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }

                // last loop
                if (count($this->column_search) - 1 == $i) {
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($postData['order'])) {
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_review_details($slug)
    {

        $this->db->select('*');
        $this->db->from(TBL_REVIEW);
        $this->db->join(TBL_REVIEW_GALLERY_IMAGES, TBL_REVIEW_GALLERY_IMAGES . '.review_id = ' . TBL_REVIEW . '.id', 'left');
        $this->db->where(TBL_REVIEW . '.slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_review_id($slug)
    {

        $this->db->select('id,tour_id');
        $this->db->from(TBL_REVIEW);
        $this->db->where(TBL_REVIEW . '.slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_all_reviews()
    {

        //$this->db->select(TBL_REVIEW.'.*,GROUP_CONCAT('.TBL_REVIEW_GALLERY_IMAGES.'.gallery_image_name SEPARATOR ",") as gallery_image');
        $this->db->select('*');
        $this->db->from(TBL_REVIEW);
        $this->db->where(TBL_REVIEW . '.is_draft', 0);
        $this->db->order_by(TBL_REVIEW . '.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_tour_title($slug)
    {
        $this->db->select('id,title');
        $this->db->from(TBL_TOUR);
        $this->db->where(TBL_TOUR . '.slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_previous_review($review_id, $tour_id)
    {
        // $sql="Select * from my_table where 1";    
        // $query = $this->db->query($SQL);
        // return $query->result_array();
        $query = $this->db->query('select slug,tour_id from ' . TBL_REVIEW . ' where id = (select min(id) from ' . TBL_REVIEW . ' where id > ' . $review_id . ' and is_draft=0 and tour_id = ' . $tour_id . ')');
        return $query->row_array();
    }
    public function get_previous_landing_page_review($review_id)
    {
        $query = $this->db->query('select slug,tour_id from ' . TBL_REVIEW . ' where id = (select min(id) from ' . TBL_REVIEW . ' where id > ' . $review_id . ' and is_draft=0 and tour_id = "")');
        return $query->row_array();
    }
    public function get_next_landing_page_review($review_id)
    {
        $query = $this->db->query('select slug,tour_id from ' . TBL_REVIEW . ' where id = (select max(id) from ' . TBL_REVIEW . ' where id < ' . $review_id . ' and is_draft=0 and tour_id = "")');
        return $query->row_array();
    }

    public function get_next_review($review_id, $tour_id)
    {
        $query = $this->db->query('select slug,tour_id from ' . TBL_REVIEW . ' where id = (select max(id) from ' . TBL_REVIEW . ' where id < ' . $review_id . ' and is_draft=0 and tour_id = ' . $tour_id . ')');
        return $query->row_array();
    }

    public function get_tour_review($where)
    {

        $this->db->select('*');
        $this->db->from(TBL_REVIEW);
        $this->db->where($where);
        $this->db->order_by(TBL_REVIEW . '.id', 'DESC');
        $this->db->limit(3, 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function get_all_tour_review($where) {

    //     $this->db->select('*');
    //     $this->db->from(TBL_REVIEW);
    //     $this->db->where($where);
    //     $this->db->order_by(TBL_REVIEW.'.id','DESC');
    //     //$this->db->limit(3, 0);
    //     $query=$this->db->get();
    //     return $query->result_array();

    // } 
    public function get_all_tour_review($where, $limit, $start)
    {

        $this->db->select('*');
        $this->db->from(TBL_REVIEW);
        $this->db->where($where);
        $this->db->order_by(TBL_REVIEW . '.title', 'ASC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_all_landing_page_review($where, $limit, $start)
    {

        $this->db->select('*');
        $this->db->from(TBL_REVIEW);
        $this->db->where($where);
        $this->db->order_by(TBL_REVIEW . '.id', 'DESC');
        if ($limit)
            $this->db->limit($limit, $start);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_landing_page_title($where)
    {
        $this->db->select('page_title, slug');
        $this->db->from(TBL_CMS_PAGES);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row_array();
    }
}
